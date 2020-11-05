<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\AdminPostsCreateRequest;
use App\Models\Admin\Category;
use App\Models\Admin\Post;
use App\Repositories\Admin\PostRepository;
use Illuminate\Http\Request;
use MetaTag;

class PostController extends AdminBaseController
{

    private $postRepository;

    public function __construct()
    {
        parent::__construct();
        $this->postRepository = app(PostRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perpage = 10;

        $getAllPosts = $this->postRepository->getAllPosts($perpage);

        $count = $this->postRepository->getCountPosts();

        MetaTag::setTags(['title' => 'Список постов']);
        return view('blog.admin.post.index', compact('getAllPosts', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Post();

        MetaTag::setTags(['title' => 'Создание нового поста']);
        return view('blog.admin.post.create', [
            'categories' => Category::with('children')
                ->where('parent_id', 0)
                ->get(),
            'delimiter' => '-',
            'item' => $item
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminPostsCreateRequest $request)
    {
        $data = $request->input();

        $post = (new Post())->create($data);

        $id = $post->id;

        $post->status = $request->status ? '1' : '0';
        $post->recommend = $request->recommend ? '1' : '0';
        $post->category_id = $request->category_id ?? '0';
        $this->postRepository->getImg($post);
        $save = $post->save();
        if ($save) {
            return redirect()
                ->route('blog.admin.posts.edit', [$post->id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->postRepository->getId($id);
if (!$post) {
    abort('404');
}
        $id =$post->id;

        MetaTag::setTags(['title' => "Редактирование поста № $id"]);
        return view('blog.admin.post.edit', compact('post'), [
            'categories' => Category::with('children')
                ->where('parent_id', 0)
                ->get(),
            'delimiter' => '-',
            'item' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminPostsCreateRequest $request, $id)
    {
        $post = $this->postRepository->getId($id);
        if (empty($post)) {
            return back()
                ->withErrors(['msg' => "Запись = [{$id}] не найдена"])
                ->withInput();
        }
        $data = $request->all();
        $result = $post->update($data);
        $post->status = $request->status ? '1' : '0';
        $post->recommend = $request->recommend ? '1' : '0';

        $post->category_id = $post->parent_id ?? $post->category_id;
        $this->postRepository->getImg($post);

        $save = $post->save();
        if ($result && $save) {
            return redirect()
                ->route('blog.admin.posts.edit', [$post->id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    public function returnStatus($id)
    {
        if ($id) {
            $st = $this->postRepository->returnStatusOne($id);
            if ($st) {
                return redirect()
                    ->route('blog.admin.posts.index')
                    ->with(['success' => 'Статус изменен']);
            } else {
                return back()
                    ->withErrors(['msg' => 'Произошла ошибка при изменении статуса'])
                    ->withInput();
            }

        }
    }

    public function deleteStatus($id)
    {
        if ($id) {
            $st = $this->postRepository->deleteStatusOne($id);
            if ($st) {
                return redirect()
                    ->route('blog.admin.posts.index')
                    ->with(['success' => 'Статус изменен']);
            } else {
                return back()
                    ->withErrors(['msg' => 'Произошла ошибка при изменении статуса'])
                    ->withInput();
            }
        }
    }

    public function ajaxImage(Request $request)
    {

        if ($request->isMethod('get')) {
            return view('blog.admin.product.include.image_single_edit');
        } else {
            $validator = \Validator::make($request->all(),
                [
                    'file' => 'image|max:5000'
                ],
                [
                    'file.image' => 'Файл должен быть картинкой (jpeg, png, gif, or svg)',
                    'file.max' => 'Ошибка! Максимальный размер картинки - 5 мб!'
                ]
            );
            if ($validator->fails()) {

                return array (
                    'fail' => true,
                    'errors' => $validator->errors()
                );
            }
            $path = $request->file('file')->store('image','public');
            \Session::put('single', $path);

            return $path;
        }
    }

    public function deletePost($id)
    {

        if ($id) {
            $db = $this->postRepository->deleteFromDB($id);
            if ($db) {
                return redirect()
                    ->route('blog.admin.posts.index')
                    ->with(['success' => 'Успешно удалено']);
            } else {
                return back()
                    ->withErrors(['msg' => 'Ошибка удаления'])
                    ->withInput();
            }

        }
    }

    public function uploader(Request $request)
    {

        $file = $request->file('file')->store('image', 'public');

        echo $file;

    }

    public function delete_img(Request $request)
    {
        $src = $request->post('file');
        \Storage::deleteDirectory($src);

//        if(@unlink($path))
//        {
//            echo 'File Delete Successfully';
//        }

    }
}

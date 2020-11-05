<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Blog\BaseController;
use App\Models\Category;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use MetaTag;

class HomeController extends BaseController
{

    private $postRepository;

    public function __construct()
    {
        $this->postRepository = app(PostRepository::class);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $perpage = 7;

        $getAllPosts = $this->postRepository->getAllPosts($perpage);
        $count = $this->postRepository->getCountPosts();

        $title = 'Блог о Oneplus';
        $description = 'Новости и обзоры по теме Oneplus';
        $keywords = 'oneplus, блог, новости о oneplus';

        self::meta($title, $description, $keywords);
        return view('home', compact('getAllPosts'));

    }

    public function category($alias) {

        $category = Category::where('alias', $alias)->first();

        return view('pages.category', compact('category'));
    }

    public function show($category, $alias)
    {
        $item = $this->postRepository->getIdByAlias($alias);
        if(empty($item)) {
            abort('404');
        }

        self::meta($item->title, $item->description, $item->keywords);
        return view('pages.single', compact('item'));
    }

    public static function meta($title = null, $description = null, $keywords = null)
    {
        MetaTag::setTags(['title' => $title]);
        MetaTag::setTags(['description' => $description]);
        MetaTag::setTags(['keywords' => $keywords]);
    }


}

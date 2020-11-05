<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Models\Post;
use MetaTag;

class SearchController extends BaseController
{

    public function index(Request $request)
    {
        $query = !empty(trim($request->search)) ? trim($request->search) : null;

        $posts = Post::where('title', 'LIKE', '%' . $query . '%')
            ->with('category')
            ->latest()
            ->limit(3)
            ->paginate(3)
            ->withPath('?' . $request->getQueryString());

        MetaTag::setTags(['title' => 'Результаты поиска']);
        return view('pages.search-result', compact('query', 'posts'));
    }

    public function search(Request $request)
    {
        $search = $request->get('term');

        $result = \DB::table('posts')
            ->select('title')
            ->where('title', 'LIKE', '%' . $search . '%')
            ->pluck('title');
        return response()->json($result);

    }
}

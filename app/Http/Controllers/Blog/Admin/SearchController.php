<?php

namespace App\Http\Controllers\Blog\Admin;

use Illuminate\Http\Request;
use MetaTag;

class SearchController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $query = !empty(trim($request->search)) ? trim($request->search) : null;

        $posts = \DB::table('posts')
            ->where('title', 'LIKE', '%' . $query . '%')
            ->latest()
            ->get()
            ->all();

        MetaTag::setTags(['title' => 'Результаты поиска']);
        return view('blog.admin.search.result', compact('query', 'posts'));
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

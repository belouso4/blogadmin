<?php

namespace App\Http\Controllers\Blog\Admin;

use Illuminate\Http\Request;
use MetaTag;

class SettingController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $setting = \DB::table('settings')->first();

        MetaTag::setTags(['title' => 'Настройка сайта']);
        return view('blog.admin.setting.index', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $data = array();
        $data['title'] = $request->title;
        $data['description'] = $request->description;

        $result = \DB::table('settings')->where('id', $id)->update($data);

        if ($result) {
            return redirect()
                ->route('blog.admin.settings.index', [$id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

}

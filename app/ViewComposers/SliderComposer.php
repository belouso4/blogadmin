<?php


namespace App\ViewComposers;


use App\Models\Post;
use Illuminate\View\View;

class SliderComposer
{
    public function compose(View $view)
    {
        $slider = Post::get()->where('recommend', '1')->random();
        $view->with('slider', $slider);
    }
}

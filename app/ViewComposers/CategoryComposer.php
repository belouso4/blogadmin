<?php


namespace App\ViewComposers;


use App\Models\Category;
use Illuminate\View\View;
use Menu as LavMenu;

class CategoryComposer
{
    public function compose(View $view)
    {
        $arrMenu = Category::all();

        $menu = $this->buildMenu($arrMenu);

        $view->with('menu', $menu);
    }

    public function buildMenu($arrMenu)
    {
        $mBuilder = LavMenu::make('MyMenu', function ($m) use ($arrMenu) {
            foreach ($arrMenu as $item) {
                if ($item->parent_id == 0) {
                    $m->add($item->title, ['nickname' => $item->alias])
                        ->id($item->id);
                } else {
                    if ($m->find($item->parent_id)) {
                        $m->find($item->parent_id)
                            ->add($item->title, ['nickname' => $item->alias] )
                            ->id($item->id);
                    }
                }
            }

        });
        return $mBuilder;
    }
}

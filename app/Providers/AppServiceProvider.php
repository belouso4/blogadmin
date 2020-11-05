<?php

namespace App\Providers;

use App\Models\Admin\Category;
use App\Models\Admin\Post;
use App\Observers\AdminCategoryObserver;
use App\Observers\AdminPostObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Category::observe(AdminCategoryObserver::class);
        Post::observe(AdminPostObserver::class);
    }
}

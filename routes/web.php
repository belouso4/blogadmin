<?php

use Illuminate\Support\Facades\Route;



Auth::routes();

//admin=======
Route::get('admin', 'Blog\Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Blog\Admin\LoginController@login');

Route::group(['middleware' => ['auth.admin', 'auth']], function() {
    $groupData = [
        'namespace' => 'Blog\Admin',
        'prefix' => 'admin',
    ];

    Route::group($groupData, function () {
        Route::resource('home', 'MainController')
            ->names('admin.home');

        Route::get('/categories/mydel', 'CategoryController@mydel')
            ->name('blog.admin.categories.mydel');
        Route::resource('categories', 'CategoryController')
            ->names('blog.admin.categories');

        Route::get('/posts/return-status/{id}', 'PostController@returnStatus')
            ->name('blog.admin.posts.returnstatus');
        Route::get('/posts/delete-status/{id}', 'PostController@deleteStatus')
            ->name('blog.admin.posts.deletestatus');

        Route::match(['get', 'post'], 'posts/ajax-image-upload', 'PostController@ajaxImage');

        Route::get('posts/delete-post/{id}', 'PostController@deletePost')
            ->name('blog.admin.posts.deletepost');

        Route::resource('settings', 'SettingController')
            ->names('blog.admin.settings')->only([
            'index', 'update'
        ]);;

        Route::get('/search/result', 'SearchController@index');
        Route::get('/autocomplete', 'SearchController@search');

        Route::post('/upload-summernote', 'PostController@uploader');
        Route::post('/remove-summernote', 'PostController@delete_img');

        Route::resource('posts', 'PostController')
            ->names('blog.admin.posts');

    });
});

Route::get('/', 'Blog\HomeController@index')->name('home');
Route::get('/{category}', 'Blog\HomeController@category')->name('blog.post.category');
Route::get('/search/result', 'Blog\SearchController@index');
Route::get('/{category}/{post}', 'Blog\HomeController@show')->name('blog.post.show');

Route::get('/autocomplete', 'Blog\SearchController@search');



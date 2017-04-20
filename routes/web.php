<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Web后台
Route::group(['domain' => 'admin.leon.com'], function () {
    Route::group(['middleware' => 'loginAuth'], function () {
        Route::get('/', 'Web\Backend\Index@index');
        Route::get('/index_v1', function () {
            return view('web.backend.index_v1');
        }); // 首页
        Route::get('/book/{id?}', 'Web\Backend\Book\Book@index')->where('id', '[0-9]+'); // 文章撰稿页
        Route::post('/book/up', 'Web\Backend\Book\Book@update'); // 更新文章
        Route::post('/book/news', 'Web\Backend\Book\Book@news'); // 发布动态
        Route::get('/book/list', 'Web\Backend\Book\Book@lists'); // 文章列表
        Route::post('/book/del', 'Web\Backend\Book\Book@del'); // 删除文章
        Route::post('/book/recommend', 'Web\Backend\Book\Book@recommend'); // 设置推荐
        Route::get('/tags', 'Web\Backend\Site@tags'); // 设置标签
    });

    Route::post('/signin', 'Web\Backend\Login@signIn'); //登陆验证
    Route::get('/login', 'Web\Backend\Login@index'); // 登录页

});



// Web前台
Route::group(['prefix' => '/'], function () {
    Route::get('/', 'Web\Frontend\Index@index');
    Route::get('page/{id?}', 'Web\Frontend\Index@index');
    Route::get('t/{menu?}/{id?}', 'Web\Frontend\Article\Content@index');
    Route::get('{menu?}/{page?}/{num?}', 'Web\Frontend\Article\Index@lists');
});



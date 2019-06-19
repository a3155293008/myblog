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



// 后台首页的路由( 加载登录页面 )
Route::get('admins','Admin\IndexController@login')->name('admin_login');

// 后台 执行 验证
Route::post('admins/dologin','Admin\IndexController@dologin');

// 退出登录, 清除session, 跳转
Route::get('admins/logout','Admin\IndexController@logout');

Route::group(['prefix'=>'admins','middleware'=>'login'],function(){
	// 后台 用户 列表 
	Route::get('users/index','Admin\UsersController@index');

	// 后台 用户 添加 
	Route::get('users/create','Admin\UsersController@create');

	// 后台 执行 用户 添加
	Route::post('users/store','Admin\UsersController@store');

	//修改密码路由
	// Route::post('users/password/{id}/{token}','Admin\UserController@password');

	// //修改头像路由
	// Route::post('users/uface/{id}','Admin\UserController@uface');


	Route::get('users/destroy','Admin\UsersController@destroy');

	// 后台 用户修改
	Route::get('users/edit/{id}/{token}','Admin\UsersController@edit');

	// 执行 用户 修改
	Route::post('users/update/{id}','Admin\UsersController@update');




	// 后台 栏目 列表
	Route::get('cates/index','Admin\CatesController@index');
	// 后台 栏目 添加
	Route::get('cates/create','Admin\CatesController@create');
	// 后台 执行 操作
	Route::post('cates/store','Admin\CatesController@store');


	
	// 后台 轮播 列表
	Route::get('banners/index','Admin\BannersController@index');

	// 后台 轮播 添加
	Route::get('banners/create','Admin\BannersController@create');

	// 后台 执行 添加
	Route::post('banners/store','Admin\BannersController@store');

	// 后台 删除
	Route::get('banners/destroy','Admin\BannersController@destroy');

	// 后台 修改
	Route::get('banners/edit/{id}','Admin\BannersController@edit');

	Route::post('banners/update/{id}','Admin\BannersController@update');

	// 修改状态
	Route::get('banners/changeStatus','Admin\BannersController@changeStatus');

	

	// 后台 标签云 列表
	Route::get('tagnames/index','Admin\TagnamesController@index');

	// 后台 标签云 添加
	Route::get('tagnames/create','Admin\TagnamesController@create');

	// 后台 标签云 执行 添加
	Route::post('tagnames/store','Admin\TagnamesController@store');

	Route::get('tagnames/destroy','Admin\TagnamesController@destroy');


	

	// 后台 文章 列表
	Route::get('articles/index','Admin\ArticlesController@index');

	// 后台 文章 添加
	Route::get('articles/create','Admin\ArticlesController@create');

	// 后台 文章 执行 添加
	Route::post('articles/store','Admin\ArticlesController@store');

	// 后台 文章 执行 删除
	Route::get('articles/destroy','Admin\ArticlesController@destroy');

	Route::get('articles/edit/{id}','Admin\ArticlesController@edit');

	Route::post('articles/update/{id}','Admin\ArticlesController@update');
});


Route::get('/','Home\IndexController@index');


// 前台路由
Route::group(['prefix'=>'home'],function(){

	// 前台 登录 路由
	Route::get('login/login','Home\LoginController@login');

	// 验证登录路由
	Route::post('login/dologin','Home\LoginController@dologin');

	// 退出
	Route::get('login/logout','Home\LoginController@logout');

	// 前台 首页
	Route::get('index/index','Home\IndexController@index');
	
	// 前台 列表页
	Route::get('lists/index','Home\ListsController@index');

	// 前台 内容 详情页
	Route::get('detail/index','Home\DetailController@index');

	// 前台 文章 点赞
	Route::get('detail/goodnum','Home\DetailController@goodnum');

	// 前台 文章 评论
	Route::get('detail/pinglun','Home\DetailController@pinglun');


	// 前台 注册
	Route::get('register/index','Home\RegisterController@index');

	Route::post('register/store','Home\RegisterController@store');
});


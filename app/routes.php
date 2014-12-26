<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function(){
	// return View::make('hello');
	// return View::make('user.mail')->withTitle('邮件');
	// showbug(Movie::with('')->get());
});

/**
 * [用户相关路由]
 */
Route::group(['prefix'=>'user'], function(){
	Route::get('/signup', "UserController@signUpView");
	Route::post('/signup', "UserController@signUpDeal");
	Route::get('/sendMail', "UserController@sendEmailView");
	Route::get('/checkUnique/{unique}', "UserController@checkUnique"); // 验证激活码过期
	Route::get('/login', "UserController@loginView");
	Route::post('/login', "UserController@loginDeal");
	Route::get('/logout', "UserController@logout");
	Route::get('/prefect', ['before'=>'auth', 'uses'=>"UserController@prefectView"]); // 完善信息视图渲染
	Route::post('/prefect', ['before'=>'auth', 'uses'=>"UserController@prefectDeal"]); // 完善信息视图渲染
});

/**
 * [后台管理路由]
 */
Route::group(['prefix'=>'admin'], function(){
	Route::get('/index', "AdminController@indexView");
	Route::get('/add', "AdminController@addMovieView");
	Route::post('/add', "AdminController@addMovieDeal");
	Route::get('/edit/{mid}', ['before'=>'edit', 'uses'=>"AdminController@editMovieView"]);
	Route::post('/edit', "AdminController@editMovieDeal");
	Route::post('/delete', "AdminController@deleteMovieDeal");
	Route::get('/uppic', "AdminController@upPicView");	 
});

/**
 * [电影页面路由]
 */
Route::group(['prefix'=>'movie'], function(){
	Route::get('/index', ['as'=>'index', 'uses'=>"MovieController@indexView"]);
	Route::get('/detail/{mid}',['before'=>'detail', 'uses'=>"MovieController@movieDetail"]);
	Route::post('/talk', "MovieController@movieTalk");
});








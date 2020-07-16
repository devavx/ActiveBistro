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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'FrontendController@index')->name('index');
Route::get('/login', 'FrontendController@login')->name('login');
Route::get('/signup', 'FrontendController@signup')->name('signup');
Route::get('/ourmenu', 'FrontendController@our-menu')->name('ourmenu');
Route::get('/home', 'HomeController@index')->name('home');

//Backend URLS
Route::group(['as'=>'admin.','middleware'=>['auth','admin','verified'],'prefix'=>'admin' ], function(){
	Route::get('/', 'Admin\AdminController@index')->name('admin.dashboard');

});

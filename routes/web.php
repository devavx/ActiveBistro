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
Route::get('/sign-in', 'FrontendController@login')->name('sign-in');
Route::get('/signup', 'FrontendController@signup')->name('signup');
Route::get('/ourmenu', 'FrontendController@ourmenu')->name('ourmenu');
Route::get('/home', 'HomeController@index')->name('home');

//Backend URLS
Route::group(['as'=>'admin.','middleware'=>['auth','admin','verified'],'prefix'=>'admin' ], function(){
	Route::get('/', 'Admin\AdminController@index')->name('admin.dashboard');
	Route::get('/profile', 'Admin\AdminController@profile')->name('admin.profile')->middleware(['password.confirm']);
	Route::post('/profile', 'Admin\AdminController@updateProfile')->name('admin.update.profile');
	Route::post('/change-password', 'Admin\AdminController@chnagePassword')->name('admin.chnage.password');

	Route::get('/customers', 'Admin\AdminController@customerList')->name('customer.list');
	Route::get('/meals', 'Admin\MealPlanController@index')->name('meal.index');
	Route::get('/meals/delete/{id}', 'Admin\MealPlanController@delete')->name('meal.delete');
	Route::get('/meals/create', 'Admin\MealPlanController@create')->name('meal.create');


	Route::resource('/meals', 'Admin\MealPlanController');

});

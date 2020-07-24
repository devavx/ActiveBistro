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
Route::get('/sign-up', 'FrontendController@signup')->name('signup');
Route::get('/ourmenu', 'FrontendController@ourmenu')->name('ourmenu');

Route::get('/how_it_work', 'FrontendController@howItWork')->name('how_it_work');
Route::get('/faq', 'FrontendController@getFaq')->name('faq');
Route::get('/term_condition', 'FrontendController@termCondition')->name('term_condition');
Route::get('/privacy_policy', 'FrontendController@privacyPolicy')->name('privacy_policy');
Route::get('/about', 'FrontendController@about')->name('about');
Route::get('/contact', 'FrontendController@contact')->name('contact');

Route::get('/home', 'HomeController@index')->name('home');

//Backend URLS
Route::group(['as'=>'admin.','middleware'=>['auth','admin','verified'],'prefix'=>'admin' ], function(){
	Route::get('/', 'Admin\AdminController@index')->name('admin.dashboard');
	Route::get('/profile', 'Admin\AdminController@profile')->name('admin.profile')->middleware(['password.confirm']);
	Route::post('/profile', 'Admin\AdminController@updateProfile')->name('admin.update.profile');
	Route::post('/change-password', 'Admin\AdminController@chnagePassword')->name('admin.chnage.password');

	Route::get('/customers', 'Admin\AdminController@customerList')->name('customer.list');

	// MealPlanController URI
	Route::get('/meals', 'Admin\MealPlanController@index')->name('meal.index');
	Route::get('/meals/delete/{id}', 'Admin\MealPlanController@delete')->name('meal.delete');
	Route::get('/meals/create', 'Admin\MealPlanController@create')->name('meal.create');

	// IngredientController URI
	Route::get('/ingredient/delete/{id}', 'Admin\IngredientController@delete')->name('meal.delete');

	// ItemController URI
	Route::get('/items/delete/{id}', 'ItemController@delete')->name('items.delete');
	// ItemController URI
	Route::get('/orders', 'ItemController@orders')->name('items.orders');


	// SettingController URI 

	Route::get('sliders/fetch', 'SliderSettingController@fetch')->name('sliders.fetch');

	Route::get('/sliders/delete/{id}', 'SliderSettingController@delete')->name('setting.slider.delete');
	
	Route::get('/how_it_works/delete/{id}', 'HowItWorkController@delete')->name('setting.how_it_work.delete');

	Route::get('/faqs/delete/{id}', 'Admin\FaqController@delete')->name('setting.faqs.delete');

	Route::get('/postal_codes/delete/{id}', 'Admin\PostalCodeController@delete')->name('setting.postal_codes.delete');

	Route::get('/category/delete/{id}', 'CategoryController@delete')->name('category.delete');
	Route::get('/item_type/delete/{id}', 'ItemTypeController@delete')->name('item_type.delete');

	
 

	Route::get('/term_conditions/delete/{id}', 'TermConditionController@delete')->name('setting.term_conditions.delete');

	Route::get('/privacy_policy/delete/{id}', 'PrivacyPolicyController@delete')->name('setting.privacy_policy.delete');

	Route::get('/contact_us', 'Admin\SettingController@contactUs')->name('setting.contactus');


	Route::resource('/faqs',        'Admin\FaqController');
	Route::resource('/postal_codes','Admin\PostalCodeController');
	Route::resource('/meals',       'Admin\MealPlanController');
	Route::resource('/ingredient',  'Admin\IngredientController');

	Route::resource('/items',          'ItemController');	
	Route::resource('/how_it_works',   'HowItWorkController');
	Route::resource('/privacy_policy', 'PrivacyPolicyController');
	Route::resource('/term_conditions','TermConditionController');
	Route::resource('/sliders',        'SliderSettingController');
	Route::resource('/category',       'CategoryController');
	Route::resource('/item_type',      'ItemTypeController');

});

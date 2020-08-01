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
Route::get('/sign-in', 'FrontendController@login')->middleware('guest')->name('sign-in');
Route::get('/sign-up', 'FrontendController@signup')->middleware('guest')->name('signup');
Route::get('/tailor_plan', 'FrontendController@tailorPlan')->name('tailor_plan');
Route::post('/tailorplan', 'FrontendController@saveTailorPlan')->name('save_tailor_plan');
Route::get('/recommended_meal', 'FrontendController@recommendedMeal')->name('recommended_meal');



	// AUTH USER Route
Route::group(['middleware'=>['auth'] ], function(){
	Route::post('/update_user', 'UserProfileController@updateUserDetail')->name('update_user');
	Route::post('/change_password', 'UserProfileController@updatePassword')->name('update_password');
	Route::get('/my_order', 'UserProfileController@getAllOrder')->name('my_order');
});




Route::get('/ourmenu', 'FrontendController@ourmenu')->name('ourmenu');

Route::get('/how_it_work', 'FrontendController@howItWork')->name('how_it_work');
Route::get('/faq', 'FrontendController@getFaq')->name('faq');
Route::get('/term_condition', 'FrontendController@termCondition')->name('term_condition');
Route::get('/privacy_policy', 'FrontendController@privacyPolicy')->name('privacy_policy');
Route::get('/about', 'FrontendController@about')->name('about');
Route::get('/contact', 'FrontendController@contact')->name('contact');
Route::get('/items', 'FrontendController@getAllItem')->name('all_items');
Route::get('/meals', 'FrontendController@getAllMeal')->name('all_meals');

Route::get('/home', 'HomeController@index')->name('home');

//Backend URLS
Route::group(['as'=>'admin.','middleware'=>['auth','admin','verified'],'prefix'=>'admin' ], function(){
	Route::get('/', 'Admin\AdminController@index')->name('admin.dashboard');
	Route::get('/profile', 'Admin\AdminController@profile')->name('admin.profile')->middleware(['password.confirm']);
	Route::post('/profile', 'Admin\AdminController@updateProfile')->name('admin.update.profile');
	Route::post('/change-password', 'Admin\AdminController@chnagePassword')->name('admin.chnage.password');

	Route::get('/customers/{id?}', 'Admin\AdminController@customerList')->name('customer.list');
	Route::get('/customer/delete/{id}', 'Admin\AdminController@customerDelete')->name('customer.list');
	Route::post('/update_customer', 'Admin\AdminController@updateCustomerDetail')->name('update_customer_details');

	// MealPlanController URI 
	Route::get('/meals/delete/{id}', 'Admin\MealPlanController@delete')->name('meal.delete');
	Route::get('/meals/change_status/{id}', 'Admin\MealPlanController@changeStatus')->name('meal.change_status'); 

	// IngredientController URI
	Route::get('/ingredient/delete/{id}', 'Admin\IngredientController@delete')->name('meal.delete');
	Route::get('/ingredient/change_status/{id}', 'Admin\IngredientController@changeStatus')->name('ingredient.change_status');

	// ItemController URI
	Route::get('/items/delete/{id}', 'ItemController@delete')->name('items.delete');
	Route::get('/items/change_status/{id}', 'ItemController@changeStatus')->name('items.chnage_status');
	// ItemController URI
	Route::get('/orders', 'ItemController@orders')->name('items.orders');


	// SettingController URI 

	Route::get('sliders/fetch', 'SliderSettingController@fetch')->name('sliders.fetch');

	Route::get('/sliders/delete/{id}', 'SliderSettingController@delete')->name('setting.slider.delete');
	Route::get('/sliders/change_status/{id}', 'SliderSettingController@changeStatus')->name('setting.slider.change_status');
	
	Route::get('/how_it_works/delete/{id}', 'HowItWorkController@delete')->name('setting.how_it_work.delete');
	Route::get('/how_it_works/change_status/{id}', 'HowItWorkController@changeStatus')->name('setting.how_it_work.change_status');

	Route::get('/faqs/delete/{id}', 'Admin\FaqController@delete')->name('setting.faqs.delete');
	Route::get('/faqs/chnage_status/{id}', 'Admin\FaqController@changeStatus')->name('setting.faqs.change_status');


	Route::get('/postal_codes/delete/{id}', 'Admin\PostalCodeController@delete')->name('setting.postal_codes.delete');
	Route::get('/postal_codes/change_status/{id}', 'Admin\PostalCodeController@changeStatus')->name('postal_codes.change_status');


	Route::get('/category/delete/{id}', 'CategoryController@delete')->name('category.delete');
	Route::get('/category/change_status/{id}', 'CategoryController@changeStatus')->name('category.chnage_status');


	Route::get('/item_type/delete/{id}', 'ItemTypeController@delete')->name('item_type.delete');
	Route::get('/item_type/change_status/{id}', 'ItemTypeController@changeStatus')->name('item_type.change_status');
 

	Route::get('/term_conditions/delete/{id}', 'TermConditionController@delete')->name('setting.term_conditions.delete');
	Route::get('/term_conditions/change_status/{id}', 'TermConditionController@changeStatus')->name('setting.term_conditions.change_status');


	Route::get('/privacy_policy/delete/{id}', 'PrivacyPolicyController@delete')->name('setting.privacy_policy.delete');
	Route::get('/privacy_policy/change_status/{id}', 'PrivacyPolicyController@changeStatus')->name('setting.privacy_policy.change_status');


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

<?php

use App\Core\Primitives\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['as' => 'admin.', 'middleware' => ['auth', 'admin', 'verified'], 'prefix' => 'admin'], function () {
	Route::get('/', 'Admin\AdminController@index')->name('admin.dashboard');
	Route::get('/profile', 'Admin\AdminController@profile')->name('admin.profile')->middleware(['password.confirm']);
	Route::post('/profile', 'Admin\AdminController@updateProfile')->name('admin.update.profile');
	Route::post('/change-password', 'Admin\AdminController@chnagePassword')->name('admin.chnage.password');

	Route::get('/customers/{id?}', 'Admin\AdminController@customerList')->name('customer.list');
	Route::get('/customer/delete/{id}', 'Admin\AdminController@customerDelete')->name('customer.list');
	Route::delete('/customer/delete', 'Admin\AdminController@customerDeleteBulk')->name('customer.bulk_delete');
	Route::post('/update_customer', 'Admin\AdminController@updateCustomerDetail')->name('update_customer_details');

	Route::get('/allergy/delete/{id}', 'Admin\AllergyController@delete')->name('allergy.delete');
	Route::delete('/allergy/delete', 'Admin\AllergyController@deleteBulk')->name('allergy.delete');
	Route::get('/allergy/change_status/{id}', 'Admin\AllergyController@changeStatus')->name('allergy.change_status');
	Route::get('/allergy/details/', 'Admin\AllergyController@getAllergyDetails')->name('allergy.allergy_details');

	// IngredientController URI
	Route::get('/ingredient/delete/{id}', 'Admin\IngredientController@delete')->name('meal.delete');
	Route::delete('/ingredient/delete', 'Admin\IngredientController@deleteBulk')->name('meal.delete');
	Route::get('/ingredient/change_status/{id}', 'Admin\IngredientController@changeStatus')->name('ingredient.change_status');

	// ItemController URI
	Route::get('/items/delete/{id}', 'ItemController@delete')->name('items.delete');
	Route::get('/items/show/{id}', 'ItemController@show')->name('items.show');
	Route::delete('/items/delete', 'ItemController@deleteBulk')->name('items.delete');
	Route::get('/items/change_status/{id}', 'ItemController@changeStatus')->name('items.chnage_status');
	// OrderController URI
	Route::get('/orders', 'Admin\OrderController@index')->name('orders.index');
	Route::get('/orders/show/{key}', 'Admin\OrderController@show')->name('orders.show');
	Route::get('orders/delete/{key}', 'Admin\OrderController@delete')->name('orders.delete');
	Route::delete('orders/delete', 'Admin\OrderController@deleteBulk')->name('orders.delete');

	// HomeSettingController URI
	Route::get('/home_setting/delete/{id}', 'Admin\HomeSettingController@delete')->name('home_setting.delete');
	Route::get('/home_setting/change_status/{id}', 'Admin\HomeSettingController@changeStatus')->name('home_setting.change_status');

	// Route::get('/home_setting','HomeSettingController@index')->name('home_setting.index');

	// SettingController URI

	Route::get('sliders/fetch', 'SliderSettingController@fetch')->name('sliders.fetch');

	Route::get('/sliders/delete/{id}', 'SliderSettingController@delete')->name('setting.slider.delete');
	Route::get('/sliders/change_status/{id}', 'SliderSettingController@changeStatus')->name('setting.slider.change_status');

	Route::get('/how_it_works/delete/{id}', 'HowItWorkController@delete')->name('setting.how_it_work.delete');
	Route::delete('/how_it_works/delete', 'HowItWorkController@deleteBulk')->name('setting.how_it_work.delete');
	Route::get('/how_it_works/change_status/{id}', 'HowItWorkController@changeStatus')->name('setting.how_it_work.change_status');

	Route::get('/faqs/delete/{id}', 'Admin\FaqController@delete')->name('setting.faqs.delete');
	Route::get('/faqs/change_status/{id}', 'Admin\FaqController@changeStatus')->name('setting.faqs.change_status');

	Route::get('/postal_codes/delete/{id}', 'Admin\PostalCodeController@delete')->name('setting.postal_codes.delete');
	Route::get('/postal_codes/change_status/{id}', 'Admin\PostalCodeController@changeStatus')->name('postal_codes.change_status');

	Route::get('/category/delete/{id}', 'CategoryController@delete')->name('category.delete');
	Route::delete('/category/delete', 'CategoryController@deleteBulk')->name('category.delete');
	Route::get('/category/change_status/{id}', 'CategoryController@changeStatus')->name('category.change_status');

	Route::get('/item_type/delete/{id}', 'ItemTypeController@delete')->name('item_type.delete');
	Route::delete('/item_type/delete', 'ItemTypeController@delete')->name('item_type.delete');
	Route::get('/item_type/change_status/{id}', 'ItemTypeController@changeStatus')->name('item_type.change_status');

	Route::get('/term_conditions/delete/{id}', 'TermConditionController@delete')->name('setting.term_conditions.delete');
	Route::get('/term_conditions/change_status/{id}', 'TermConditionController@changeStatus')->name('setting.term_conditions.change_status');

	Route::get('/privacy_policy/delete/{id}', 'PrivacyPolicyController@delete')->name('setting.privacy_policy.delete');
	Route::get('/privacy_policy/change_status/{id}', 'PrivacyPolicyController@changeStatus')->name('setting.privacy_policy.change_status');

	Route::get('/contact_us', 'Admin\SettingController@contactUs')->name('setting.contactus');
	Route::post('/contact_us/save', 'Admin\SettingController@saveContactUs')->name('setting.save_contactus');

	Route::resource('/faqs', 'Admin\FaqController');
	Route::resource('/postal_codes', 'Admin\PostalCodeController');
	Route::resource('/ingredient', 'Admin\IngredientController');
	Route::resource('/allergy', 'Admin\AllergyController');

	Route::resource('/items', 'ItemController');
	Route::resource('/how_it_works', 'HowItWorkController');
	Route::resource('/privacy_policy', 'PrivacyPolicyController');
	Route::resource('/term_conditions', 'TermConditionController');
	Route::resource('/bottom_section', 'BottomSectionController');
	Route::resource('/delivery_deadline', 'DeliveryDeadlineController');
	Route::resource('/sliders', 'SliderSettingController');
	Route::resource('/category', 'CategoryController');
	Route::resource('/item_type', 'ItemTypeController');
	Route::resource('/home_setting', 'Admin\HomeSettingController');

	/*
	|--------------------------------------------------------------------------
	| Daily Meal Plans Namespace Route(s)
	|--------------------------------------------------------------------------
	|
	*/
	Route::prefix('daily-meals')->group(static function () {
		Route::get('delete/{id}', 'Admin\DailyMealPlanController@delete')->name('daily-meals.delete');
		Route::delete('delete', 'Admin\DailyMealPlanController@deleteBulk')->name('daily-meals.delete');
		Route::get('change_status/{id}', 'Admin\DailyMealPlanController@changeStatus')->name('daily-meals.change_status');
		Route::get('images/{id}/{field}', 'Admin\DailyMealPlanController@removeImages');
		Route::get('show/{id}', 'Admin\DailyMealPlanController@show');
	});
	Route::resource('daily-meals', 'Admin\DailyMealPlanController');

	/*
	|--------------------------------------------------------------------------
	| Meal Plans Namespace Route(s)
	|--------------------------------------------------------------------------
	|
	*/
	Route::prefix('meals')->group(static function () {
		Route::get('delete/{id}', 'Admin\MealPlanController@delete')->name('meal.delete');
		Route::delete('delete', 'Admin\MealPlanController@deleteBulk')->name('meal.delete');
		Route::get('change_status/{id}', 'Admin\MealPlanController@changeStatus')->name('meal.change_status');
		Route::get('images/{id}/{field}', 'Admin\MealPlanController@removeImages');
		Route::get('show/{id}', 'Admin\MealPlanController@show');
	});
	Route::resource('meals', 'Admin\MealPlanController');

	/*
	|--------------------------------------------------------------------------
	| Coupons Namespace Route(s)
	|--------------------------------------------------------------------------
	|
	*/
	Route::prefix('coupons')->group(static function () {
		Route::get(Str::Empty, 'Admin\CouponController@index')->name('coupons.index');
		Route::get('create', 'Admin\CouponController@create')->name('coupons.create');
		Route::get('{id}/edit', 'Admin\CouponController@edit')->name('coupons.edit');
		Route::post(Str::Empty, 'Admin\CouponController@store')->name('coupons.store');
		Route::get('change_status/{id}', 'Admin\CouponController@changeStatus')->name('coupons.update.status');
		Route::get('change_promotion/{id}', 'Admin\CouponController@changePromotion')->name('coupons.update.promotion');
		Route::get('delete/{id}', 'Admin\CouponController@delete')->name('coupons.delete');
		Route::delete('delete', 'Admin\CouponController@deleteBulk')->name('coupons.delete.bulk');
	});

	/*
	|--------------------------------------------------------------------------
	| FAQ Categories Namespace Route(s)
	|--------------------------------------------------------------------------
	|
	*/
	Route::prefix('faq-categories')->group(static function () {
		Route::get(Str::Root, 'Admin\FaqCategoryController@index')->name('faq-categories.index');
		Route::get(Str::Create, 'Admin\FaqCategoryController@create')->name('faq-categories.create');
		Route::get(Str::Edit, 'Admin\FaqCategoryController@edit')->name('faq-categories.edit');
		Route::post(Str::Root, 'Admin\FaqCategoryController@store')->name('faq-categories.store');
		Route::post(Str::Update, 'Admin\FaqCategoryController@update')->name('faq-categories.update');
		Route::get('change_status/{id}', 'Admin\FaqCategoryController@changeStatus')->name('faq-categories.update.status');
		Route::get('delete/{id}', 'Admin\FaqCategoryController@delete')->name('faq-categories.delete');
		Route::delete('delete', 'Admin\FaqCategoryController@deleteBulk')->name('faq-categories.delete.bulk');
	});
});

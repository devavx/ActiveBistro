<?php

use App\Core\Primitives\Str;
use Illuminate\Support\Facades\Route;

Route::get('/', 'FrontendController@index')->name('index');
Route::get('/login', 'FrontendController@login')->middleware('guest')->name('login');
Route::get('/sign-in', 'FrontendController@login')->middleware('guest')->name('sign-in');
Route::get('/sign-up', 'FrontendController@signup')->middleware('guest')->name('signup');
Route::get('/tailor_plan', 'FrontendController@tailorPlan')->name('tailor_plan');
Route::post('/tailorplan', 'FrontendController@saveTailorPlan')->name('save_tailor_plan');
Route::get('/recommended_meal', 'FrontendController@recommendedMeal')->name('recommended_meal');
Route::get('options', 'FrontendController@options')->name('profile_options');
Route::post('options/save', 'FrontendController@saveOptions')->name('profile_options.save');

// AUTH USER Route
Route::group(['middleware' => ['auth']], function () {
	Route::post('/update_user', 'UserProfileController@updateUserDetail')->name('update_user');
	Route::post('/change_password', 'UserProfileController@updatePassword')->name('update_password');
	Route::get('/my_order', 'OrderController@index')->name('my_order');
	Route::get('/my_order/show/{key}', 'OrderController@show')->name('my_order.show');
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

/*
|--------------------------------------------------------------------------
| Cart Namespace Route(s)
|--------------------------------------------------------------------------
|
*/
Route::prefix('cart')->middleware('auth')->group(static function () {
	Route::get(Str::Root, [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
	Route::get('items/{day?}', [\App\Http\Controllers\CartController::class, 'items'])->name('cart.items.list');
	Route::get('items/add/{day}/{itemId}', [\App\Http\Controllers\CartController::class, 'addItem'])->name('cart.items.list.add');
	Route::get('items/remove/{day}/{itemId}', [\App\Http\Controllers\CartController::class, 'decreaseItem'])->name('cart.items.list.remove');
	Route::get('items/delete/{day}/{itemId}', [\App\Http\Controllers\CartController::class, 'deleteItem'])->name('cart.items.list.delete');
	Route::get('replace/{day}/{slab}/{mealId}/{itemId}', [\App\Http\Controllers\CartController::class, 'replaceItem']);
	Route::prefix('quantity/{day}/{mealId}')->group(static function () {
		Route::get('clone', [\App\Http\Controllers\CartController::class, 'cloneMealPlan'])->name('cart.meals.clone');
		Route::get('delete', [\App\Http\Controllers\CartController::class, 'deleteMealPlan'])->name('cart.meals.delete');
	});

	Route::prefix('checkout')->group(static function () {
		Route::post(Str::Root, [\App\Http\Controllers\CheckoutController::class, 'index'])->name('cart.checkout.index');
		Route::post('store', [\App\Http\Controllers\CheckoutController::class, 'store'])->name('cart.checkout.store');
	});
});

/*
|--------------------------------------------------------------------------
| Payments Namespace Route(s)
|--------------------------------------------------------------------------
|
*/
Route::prefix('payment')->middleware('auth')->group(static function () {
	Route::get('initiate', [\App\Http\Controllers\PaymentController::class, 'initiate'])->name('payments.initiate');
	Route::get('completed', [\App\Http\Controllers\PaymentController::class, 'completed'])->name('payments.completed');
	Route::get('cancelled', [\App\Http\Controllers\PaymentController::class, 'cancelled'])->name('payments.cancelled');
	Route::get('confirmed', [\App\Http\Controllers\PaymentController::class, 'confirmed'])->name('payments.confirmed');
	Route::get('failed', [\App\Http\Controllers\PaymentController::class, 'failed'])->name('payments.failed');
});

/*
|--------------------------------------------------------------------------
| OrderNow Namespace Route(s)
|--------------------------------------------------------------------------
|
*/
Route::prefix('order-now')->middleware('auth')->group(static function () {
	Route::get(Str::Root, [\App\Http\Controllers\OrderNowController::class, 'index'])->name('order-now.index');
});
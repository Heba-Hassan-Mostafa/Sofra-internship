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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::group(
    ['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
    function(){


Route::group(['middleware'=>['auth','auto-check-permission'] , 'prefix' => 'admin'],function() {


    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('city', 'WebController\CityController');
    Route::resource('city.district', 'WebController\CityDistrictController');
    Route::resource('category', 'WebController\CategoryController');
    Route::get('client/activate/{id}', 'WebController\ClientController@activate')->name('client.activate');
    Route::get('client/daActivate/{id}', 'WebController\ClientController@deActivate')->name('client.deactivate');
    Route::resource('client', 'WebController\ClientController');
    Route::get('restaurant/activate/{id}', 'WebController\RestaurantController@activate')->name('restaurant.activate');
    Route::get('restaurant/daActivate/{id}', 'WebController\RestaurantController@deActivate')->name('restaurant.deactivate');
    Route::resource('restaurant', 'WebController\RestaurantController');
    Route::resource('restaurant.meal', 'WebController\RestaurantMealController');
    Route::resource('payments', 'WebController\PaymentsController');
    Route::resource('offer', 'WebController\OfferController');
    Route::resource('contact', 'WebController\ContactController');
    Route::resource('setting', 'WebController\SettingController');
    Route::resource('order', 'WebController\OrderController');
    Route::resource('role', 'WebController\RoleController');


    //user reset password
    Route::get('user/change-password', 'WebController\UserController@changePassword')->name('user.change-password');
    Route::post('user/change-password', 'WebController\UserController@changePasswordSave');
    Route::resource('user', 'WebController\UserController');


});



});

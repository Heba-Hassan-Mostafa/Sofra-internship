<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

        //General Api

Route::group(['prefix'=>'v1','namespace'=>'Api'],function (){
    Route::get('cities','MainController@cities');
    Route::get('districts','MainController@districts');
    Route::get('restaurants','MainController@restaurants');
    Route::get('meal-restaurant','MainController@mealRestaurant');
    Route::get('restaurant-info','MainController@restaurantInfo');
    Route::get('list-offer','MainController@listOffer');
    Route::get('settings','MainController@settings');
    Route::get('list-comments','MainController@listComments');
    Route::get('categories','MainController@categories');





    //Clients Auth Cycle
    Route::group(['prefix'=>'client','namespace'=>'Client'],function (){

        Route::post('register','AuthController@register');
        Route::post('login','AuthController@login');
        Route::post('reset-password','AuthController@resetPassword');
        Route::post('new-password','AuthController@newPassword');

        // Client Middleware
        Route::group(['middleware'=>'auth:client'],function (){

            Route::post('profile','AuthController@profile');
            Route::post('register-token','AuthController@registerToken');
            Route::post('remove-token','AuthController@removeToken');


            //Client Orders
            Route::post('create-order','OrderController@createOrder');
            Route::get('new-order','OrderController@newOrder');
            Route::get('accept','OrderController@accept');
            Route::get('decline-order','OrderController@declineOrder');
            Route::get('previous-order','OrderController@previousOrder');
            Route::get('order-detail','OrderController@orderDetail');


            Route::post('contacts', 'GeneralController@contacts');
            Route::post('comment', 'GeneralController@comment');
            Route::get('list-notification','GeneralController@listNotification');
            Route::get('count','GeneralController@count');


        });
    });

    //Restaurant Auth Cycle

    Route::group(['prefix'=>'restaurant','namespace'=>'Restaurant'],function (){

        Route::post('register','AuthController@register');
        Route::post('login','AuthController@login');
        Route::post('reset-password','AuthController@resetPassword');
        Route::post('new-password','AuthController@newPassword');

        // Restaurant Middleware
        Route::group(['middleware'=>'auth:restaurant'],function (){

            Route::post('profile','AuthController@profile');
            Route::post('register-token','AuthController@registerToken');
            Route::post('remove-token','AuthController@removeToken');
            Route::post('contacts', 'AuthController@contacts');



            // Food Items Cycle Api
            Route::get('list-meal','MealController@listMeal');
            Route::post('create-meal','MealController@createMeal');
            Route::post('update-meal','MealController@updateMeal');
            Route::get('delete-meal','MealController@deleteMeal');

            // Offers Cycle Api
            Route::get('list-offer','OfferController@listOffer');
            Route::post('create-offer','OfferController@createOffer');
            Route::post('update-offer','OfferController@updateOffer');
            Route::get('delete-offer','OfferController@deleteOffer');


            //Restaurant Orders
            Route::get('new-order','OrderController@newOrder');
            Route::get('accept-order','OrderController@acceptOrder');
            Route::get('reject-order','OrderController@rejectOrder');
            Route::get('delivery-order','OrderController@deliveryOrder');
            Route::get('list-accept','OrderController@listAccept');
            Route::get('list-reject','OrderController@listReject');
            Route::get('commission','OrderController@commission');
            Route::post('change-status','OrderController@changeStatus');



            //Notifications
            Route::get('list-notification','OrderController@listNotification');
            Route::get('count','OrderController@count');


        });

    });


});



<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::group(['namespace' => 'Api','prefix'=> 'v1' ],function ()
{

    Route::post('register','AuthController@register');
    Route::post('login','AuthController@login');
  
    Route::group(['middleware' => 'auth:api'],function () {
        Route::get('home','MainController@index');
        Route::get('orderdetails','MainController@orderdetails');
        Route::get('orders/{order}', 'MainController@getOrderDetails');
        Route::post('contact','MainController@contacts');
        Route::get('about','MainController@about');
        Route::get('discounts','MainController@discounts');
    });


    });


    //first

    // Route::post('send-pin-code', 'AuthController@clientSendPinCode');
    // Route::post('check-pin-code','AuthController@checkCode');
    
    // Route::post('new-password','AuthController@newPassword');
    // Route::post('reset-password','AuthController@resetpassword') ;
    // Route::get('home-out-auth','MainController@index');


    //two

    // Route::get('client-profile', 'AuthController@showProfile');
    // Route::post('update-profile', 'AuthController@updateProfile');
    // Route::post('change-password', 'AuthController@changePassword');
    // Route::post('logout', 'AuthController@logOut');

    
    // Route::get('certificate','MainController@certificate');
    // Route::post('is_certificate','MainController@is_certificate');

    // Route::post('serviceDetails','MainController@serviceDetails');

    // Route::get('notifications','MainController@notifications');
    // Route::post('read-notification','MainController@readNotification');
    // Route::post('delete-notification','MainController@deleteNotification');

    // Route::get('addresses','MainController@addresses');
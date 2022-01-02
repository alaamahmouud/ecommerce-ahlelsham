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

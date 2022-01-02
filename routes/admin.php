<?php

use Illuminate\Routing\Router;

Route::group(['middleware' => ['guest:admin']], function () {
    Route::get('/login', 'AuthController@viewLogin')->name('admin.login');
    Route::post('/login', 'AuthController@login');
});

    Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('/', 'HomeController@index');
    Route::get('home', 'HomeController@index');

    Route::get('routes', function () {
        $routes = app('router')->getRoutes();
        return  $arrays=(array) $routes;
    });
    Route::post('admin-logout', 'AuthController@adminLogout')->name('admin.logout');

    Route::resource('governorates', 'GovernoratController');
    Route::get('governorate/toggle-boolean/{id}/{action}', 'GovernoratController@toggleBoolean')->name('governorate.toggleBoolean');

    Route::resource('products','ProductController');
    Route::get('products/toggle-boolean/{id}/{action}', 'ProductController@toggleBoolean')->name('products.toggleBoolean');

    Route::resource('photo', 'PhotoController');


    Route::resource('cities', 'CityController');
    Route::get('city/toggle-boolean/{id}/{action}', 'CityController@toggleBoolean')->name('city.toggleBoolean');


    Route::get('settings', 'SettingController@view');
    Route::post('settings', 'SettingController@update');
    Route::resource('developer/setting', 'DeveloperSetting');
    Route::resource('developer/settings/categories', 'SettingCategoryController');


    Route::resource('users', 'UserController');
    Route::get('users/toggle-boolean/{id}/{action}', 'UserController@toggleBoolean')->name('facilities.users.toggleBoolean');
    Route::resource('roles', 'RoleController');

    ///////////////////////////
    
    /// client area
    Route::resource('clients', 'ClientController');

    /// end client
    Route::resource('categories', 'CategoryController');
    Route::get('category/toggle-boolean/{id}/{action}', 'CategoryController@toggleBoolean')->name('category.toggleBoolean');

    Route::resource('advertisements','AdvertisementController');
    Route::get('advertisements/toggle-boolean/{id}/{action}', 'AdvertisementController@toggleBoolean')->name('advertisements.toggleBoolean');

    Route::resource('orders','OrderController');
    Route::get('orders/toggle-boolean/{id}/{action}', 'OrderController@toggleBoolean')->name('orders.toggleBoolean');

    Route::resource('contacts','ContactController');
    Route::get('contacts/toggle-boolean/{id}/{action}', 'ContactController@toggleBoolean')->name('contacts.toggleBoolean');

    Route::get('certificates','CertificateController@index');
    Route::get('certificates/{id}','CertificateController@update')->name('certificates.update');
    Route::put('certificates/{id}','CertificateController@edit');

    Route::resource('services','ServiceController');
    Route::resource('details','DetailsController');
    Route::resource('about-us','AboutUsController');

    Route::resource('notifications', 'NotificationController');


});

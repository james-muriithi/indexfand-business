<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Product Categories
    Route::post('product-categories/media', 'ProductCategoryApiController@storeMedia')->name('product-categories.storeMedia');
    Route::apiResource('product-categories', 'ProductCategoryApiController');

    // Product Tags
    Route::apiResource('product-tags', 'ProductTagApiController');

    // Products
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Orders
    Route::apiResource('orders', 'OrdersApiController');

    // Shops
    Route::apiResource('shops', 'ShopApiController');

    // Customers
    Route::apiResource('customers', 'CustomerApiController', ['except' => ['create']]);
});

Route::group(['as' => 'api.b2c', 'namespace' => 'Api\V1\Admin'], function (){
    Route::post('b2c_response/{token}', 'CallbackApiController@response')->name('response');

    Route::post('timeout', 'CallbackApiController@timeout')->name('timeout');
});

// payment api
Route::group(['prefix' => 'v1', 'as' => 'api.c2b.', 'namespace' => 'Api\V1\Payment'], function () {

    Route::group(['middleware' => []], function (){
        Route::get('/', 'HomeApiController@index');
        Route::post('initiate', 'PaymentApiController@initiate');
    });

    Route::post('c2b_response/{token}', 'PaymentApiController@callback')->name('callback');
});

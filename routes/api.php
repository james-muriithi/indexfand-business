<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => []], function () {
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
    Route::apiResource('orders', 'OrdersApiController', ['except' => ['create']]);

    // Shops
    Route::apiResource('shops', 'ShopApiController');

    // Customers
    Route::apiResource('customers', 'CustomerApiController', ['except' => ['create']]);
});

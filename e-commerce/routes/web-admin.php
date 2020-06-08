<?php
Route::middleware(['init'])->group(function () {
Auth::routes();
Route::middleware(['checkLogin'])->group(function () {
    Route::get('login', 'AdminAuthController@login');
});
Route::middleware(['adminAuth'])->group(function () {
    Route::get('/dashboard', 'AdminDashboardController@dashboard');
    Route::resource('category','CategoryController');
    Route::resource('product','ProductController');
    Route::resource('auction','AuctionController');
    Route::resource('sales','SalesController');
    Route::resource('customer','CustomerController');
    Route::resource('shipping-cost','ShippingCostController');
    Route::resource('promotion','PromotionController');
    Route::resource('package','PackageController');
    Route::resource('cms','CmsController');
    Route::get('/show-product/{id}','ProductController@showProduct');
    Route::get('/show-auction/{id}','AuctionController@showAuction');
    Route::get('/manage-auto-bid','AutoBidController@manageAutoBid');
    Route::get('/manage-bid-history','BidController@manageBid');
    Route::get('/update-order-status/{orderId}/{status}','SalesController@updateOrderStatus');
});

});


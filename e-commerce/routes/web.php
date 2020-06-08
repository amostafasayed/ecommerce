<?php
use Illuminate\Contracts\Session\Session;

Route::middleware(['init'])->group(function () {
    Route::redirect('/home', '/user-home')->name('home');
    Route::get('/', 'HomeDataController@index')->name('mainHome');
    Route::resource('/bid', 'BidController');
    Route::post('/auto-bid-auto', 'BidController@autoBid');
    Route::resource('/auto-bid', 'AutoBidController');
    Route::get('product/details/{id}/{name}', 'ProductController@show');
    Route::get('auction/details/{id}/{name}', 'AuctionController@show');
    Route::get('/auction-buy/{id}', 'PaymentController@auctionPaymentConfirmation');
    Route::post('add-to-cart','CartController@addToCart');
    Route::get('/delete/cart-item/{id}','CartController@deleteCartItem');
    Route::get('/update/cart-item/{id}/{quantity}','CartController@updateCartItem');


    Route::post('/auction/update-status','AuctionController@updateStatus');
    Route::get('/auction-data','AuctionController@getAuctionData');
    Route::get('/fire-event/{id}','AuctionController@fireEvent');
    Route::get('/auction-single-data/{id}','AuctionController@getSingleAuctionData');

Route::middleware(['auth'])->group(function () {

    Route::get('/user-home', 'UserHomeController@index');
    Route::redirect('/user-details','/user-details/my-information');
    Route::get('/user-details/my-information','UserHomeController@show');
    Route::get('/user-details/statistic', 'UserHomeController@statistic');
    Route::get('/user-details/settings', 'UserHomeController@settings');
    Route::get('/user-details/referral', 'UserHomeController@referral');
    Route::get('/user-details/referral-friend', 'UserHomeController@referralFriend');
    Route::post('/user-details/referral-send-email', 'UserHomeController@referralSendEmail');
    Route::get('/user-details/change-password', 'UserHomeController@changePassword');
    Route::post('/user-details/update', 'UserHomeController@updateInfo');
    Route::post('/user-details/update-password', 'UserHomeController@updatePassword');
    Route::get('/user-details/all-order', 'UserHomeController@allOrder');
    Route::get('/user-details/shipment-order', 'UserHomeController@shipmentOrder');
    Route::get('/user-details/completed-order', 'UserHomeController@completedOrder');
    Route::get('/user-details/cancel-order', 'UserHomeController@cancelOrder');
    Route::get('/user-details/bidding-history', 'UserHomeController@biddingHistory');
    Route::get('/user-details/credit-buy-history', 'UserHomeController@creditBuyingHistory');
    Route::get('/user-details/order-cancel/{order_no}', 'UserHomeController@orderCancel');
    Route::get('/generate-invoice/{id}', 'PaymentController@generateCreditInvoice');
    Route::get('/order-invoice/{order_no}', 'PaymentController@generateOrderInvoice');
});

    Route::get('/payment-confirmation', 'PaymentController@paymentConfirmation');
    Route::post('/make-payment', 'PaymentController@makePayment');
    Route::get('/credit/make-payment', 'PaymentController@makeCreditPayment');
    Route::get('/credit/ssl/make-payment', 'PaymentController@sslCreditPayment');

    Route::get('/view-cart', 'CartController@goToCartPage');
    Route::get('/all-products','ProductController@getAllProduct');
    Route::get('/payment-done','PaymentController@afterPayment');
    Route::post('/ssl/payment-done','PaymentController@afterPaymentSsl');
    Route::post('/ssl/payment-fail','PaymentController@failPaymentSsl');
    Route::post('/ssl/payment-cancel','PaymentController@cancelPaymentSsl');

    Route::get('/user-details/point', function () {
        return view('site.login.user.partial.point');
    });

    Route::get('/user-details/earned-discount', function () {
        return view('site.login.user.partial.discount');
    });
    Route::get('/product/details',function (){
        return view('site.pages.product.product-details');
    });

    Route::get('/how-it-works', function () {
        return view('site.pages.partials.how-it-works');
    });

    Route::get('/credit-product', 'PaymentController@buyCredit');

    Route::get('/privacy-policy', function () {
        return view('site.conditions.privacy-policy');
    });

    Route::get('/terms-and-conditions', function () {
        return view('site.conditions.terms-and-conditions');
    });

    Route::get('/about', function () {
        return view('site.pages.about');
    });

    Route::get('/faq', function () {
        return view('site.pages.partials.FAQ');
    });
    Route::get('/contact', function () {
        return view('site.pages.partials.contact');
    });

    Route::get('/forget-password', function () {
        return view('site.login.login-partitial.forget-password');
    });
//    Route::get('/reset-password/{token}/{email}', function () {
//        return view('site.login.login-partitial.reset-password');
//    });


    Route::get('/referral', function () {
        return view('site.pages.referral.referral');
    });


});




Route::get('/set', function (){
    $auctions=\App\Auction::all();
    $bids=\App\Bid::all();
    foreach ($bids as $key=>$item){
        $item->delete();
    }
    foreach ($auctions as $key=>$item){
            $item->update([
                'up_time'=>\Carbon\Carbon::now(),
                'is_closed'=>0,
                'status'=>'Active'
            ]);
    }
//    \App\Auction::find(2)->update(['is_closed'=>1]);
//    \App\Auction::find(4)->update(['is_closed'=>1]);
    return redirect('/user-home');
});
Route::get('/stop', function (){
    $auctions=\App\Auction::all();

    foreach ($auctions as $key=>$item){
        $item->update([
            'up_time'=>\Carbon\Carbon::now(),
            'is_closed'=>1
        ]);
    }
    return redirect('/user-home');
});


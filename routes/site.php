<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;

// front-end website 
Route::get('/index', 'SiteController@index')->name('index');
Route::get('/shop', 'SiteController@shop')->name('shop');
Route::get('/showCategory/{category}', 'SiteController@showCategory')->name('showCategory');

// cart handling
Route::get('/cart', 'CartController@index')->name('cart');
Route::get('/addToCart/{product}', 'CartController@addToCart')->name('addToCart');
Route::get('/cart/change-quantity/{product}', 'CartController@changeQuantity')->name('cart.change-quantity');
Route::get('/cart/clear-cart', 'CartController@clear')->name('cart.clear');
Route::get('/cart/removeItem/{product_id}', 'CartController@removeItem')->name('cart.removeItem');

// handling payment using checloutn mada
// Route::get('payment', 'MadaController@charge')->name('charge');



// // handling payments with paypal SdK integration
// Route::get('/payment/paypal/getToken', 'PayPalPaymentController@getToken')->name('payment.paypal.getToken');
// Route::get('/payment/paypal/captureAuthorizedPayment', 'PayPalPaymentController@captureAuthorizedPayment')->name('payment.paypal.captureAuthorizedPayment');
// Route::get('/payment/paypal/checkout', 'PayPalPaymentController@checkout')->name('payment.paypal.checkout');


// // handling payment with paypal onmiPay:
// Route::get('omniPay/payment', 'PaypalController@index');
// Route::get('omniPay/charge/{amount}', 'PaypalController@charge')->name('charge');
// Route::get('omniPay/paymentsuccess', 'PaypalController@payment_success')->name('omniPay.succes');
// Route::get('omniPay/paymenterror', 'PaypalController@payment_error')->name('omniPay.error');



// // myFatoorah payment handling
Route::post('/payment/pay','PaymentController@pay')->name('payment.pay');
Route::get('/payment/checkout','PaymentController@checkout')->name('payment.checkout');
Route::get('/payment/invoice-link','PaymentController@invoiceLink')->name('payment.invoice-link');
Route::get('/payment/returnback/success','PaymentController@returnbackSuccess')->name('payment.returnback.success');
Route::get('/payment/returnback/error','PaymentController@returnbackError')->name('payment.returnback.error');





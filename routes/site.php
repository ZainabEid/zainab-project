<?php

use Illuminate\Support\Facades\Route;


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

// payment handling
Route::post('/payment/pay','PaymentController@pay')->name('payment.pay');
Route::get('/payment/checkout','PaymentController@checkout')->name('payment.checkout');
Route::get('/payment/invoice-link','PaymentController@invoiceLink')->name('payment.invoice-link');
Route::get('/payment/returnback/success','PaymentController@returnbackSuccess')->name('payment.returnback.success');
Route::get('/payment/returnback/error','PaymentController@returnbackError')->name('payment.returnback.error');


Route::get('handle-payment', 'PayPalPaymentController@handlePayment')->name('make.payment');
Route::get('cancel-payment', 'PayPalPaymentController@paymentCancel')->name('cancel.payment');
Route::get('payment-success', 'PayPalPaymentController@paymentSuccess')->name('success.payment');

// // Login
// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('login', 'Auth\LoginController@login');
// Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// // Register
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

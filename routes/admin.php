<?php

use Illuminate\Support\Facades\Route;

// Dashboard
//Route::get('/', 'DashboardController@index')->name('dashboard');

#################### Athentication Routes ###############################
// Login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Register
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Reset Password
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Confirm Password
Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

// Verify Email
// Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
// Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

#################### End of Athentication Routes ###############################


#################### Dashboard Routs ###############################

## roles and permission routes
Route:: resource('roles','RoleController');

## categories routes
Route:: resource('categories','CategoryController');

## admins routes
Route:: resource('admins','AdminController');

## users routes
Route:: resource('users','UserController')->except('show');
Route::get('users/addphone', function () {
    return view('admin.dashboard.users._extra_phone');
});
Route::get('users/addPhone', 'UserController@addPhone')->name('users.addPhone');

## news routes
Route:: resource('news','NewsController');

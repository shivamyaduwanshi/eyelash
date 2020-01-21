<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// Authentication Routes...
Route::get('login', 'Frontend\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Frontend\Auth\LoginController@login');
Route::post('logout', 'Frontend\Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Frontend\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Frontend\Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Frontend\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Frontend\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Frontend\Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Frontend\Auth\ResetPasswordController@reset');

Route::get('/', 'Frontend\HomeController@index')->name('home');
Route::get('/my/account', 'Frontend\HomeController@myAccount')->name('my.account');
Route::get('/contact-us', 'Frontend\HomeController@contactUs')->name('contact.us');

Route::get('/products', 'Frontend\HomeController@products')->name('products');
Route::get('/product/details/{id}', 'Frontend\HomeController@productDetails')->name('product.details');
Route::get('/product/payment', 'Frontend\HomeController@productPayment')->name('product.payment');
Route::any('/product/order', 'Frontend\HomeController@productOrder')->name('product.order');

Route::get('/services', 'Frontend\HomeController@services')->name('services');
Route::get('/service/details', 'Frontend\HomeController@serviceDetails')->name('service.details');
Route::get('/service/payment', 'Frontend\HomeController@servicePayment')->name('service.payment');
Route::post('/book/appointment', 'Frontend\HomeController@bookAppointment')->name('book.appointment');
Route::any('procede/payment', 'Frontend\HomeController@procedePayment')->name('procede.payment');

Route::get('/classes', 'Frontend\HomeController@classes')->name('classes');
Route::get('/class/details/{id}', 'Frontend\HomeController@classDetails')->name('class.details');
Route::get('/class/payment', 'Frontend\HomeController@classPayment')->name('class.payment');
Route::post('class/payment', 'Frontend\HomeController@classBook')->name('class.book');
Route::any('class/paypal/payment', 'Frontend\HomeController@classBook')->name('class.paypal.book');
Route::get('confirm/class/booked', 'Frontend\HomeController@classConfirm')->name('confirm.class');


Route::get('/confirm/order', 'Frontend\HomeController@confirmOrder')->name('confirm.order');

Route::get('/remove/item', 'Frontend\HomeController@removeItem')->name('remove.item');

Route::get('/get/timeslots', 'Frontend\HomeController@getTimeSlots')->name('getTimeSlots');

Route::get('confirm/appointment','Frontend\HomeController@confirmAppointment')->name('confirm.appointment');
Route::get('transaction/failed','Frontend\HomeController@transactionFailed')->name('transaction_failed');

Route::get('paypal/payment','Frontend\HomeController@paypalPayment')->name('paypal.payment');
Route::get('paypal/success','Frontend\HomeController@paypalSuccess')->name('paypal.success');
Route::get('paypal/cancel','Frontend\HomeController@paypalCancel')->name('paypal.cancel');

Route::post('give/review/rating','Frontend\HomeController@giveReviewRating')->name('give.review.rating');





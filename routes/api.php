<?php

use Illuminate\Http\Request;

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

    /**
    * Application Api's
    */

    Route::get('get/banner' , 'Api\HomeController@getBanner');
    Route::post('update/banner' , 'Api\HomeController@updateBanner');
    Route::get('get/address' , 'Api\HomeController@getAddress');
    Route::post('update/address' , 'Api\HomeController@updateAddress');
    Route::post('upload/video' , 'Api\HomeController@uploadVideo');
    Route::post('block/time/slot' , 'Api\HomeController@blockTimeSlot');
    Route::post('update/block/time/slot' , 'Api\HomeController@updateBlockTimeSlot');
    Route::get('get/review/rating' , 'Api\HomeController@getReviewRating');
    Route::get('get/history' , 'Api\HomeController@getHistory');
    Route::get('get/total/income' , 'Api\HomeController@getTotalIncome');
   
    /**
    * Auth Api's
    */
	Route::post('/login','Api\AuthController@login');
	Route::get('/get/profile','Api\AuthController@getProfile');
    Route::post('/user/register','Api\AuthController@userRegister');
    Route::post('/update/profile','Api\AuthController@updateProfile');
	Route::post('/change/password','Api\AuthController@changePassword');
    
    /**
    * Service Api's
    */
	Route::get('get/services' , 'Api\HomeController@getServices');
    Route::get('get/service/details' , 'Api\HomeController@getServiceDetails');
	Route::post('create/service' , 'Api\HomeController@createService');
	Route::post('update/service' , 'Api\HomeController@updateService');
	Route::post('delete/service' , 'Api\HomeController@deleteService');

    /**
    * Class Api's
    */
	Route::get('get/classes' , 'Api\HomeController@getClasses');
    Route::get('get/class/details' , 'Api\HomeController@getClassDetails');
	Route::post('create/class' , 'Api\HomeController@createClass');
	Route::post('update/class' , 'Api\HomeController@updateClass');
	Route::post('delete/class' , 'Api\HomeController@deleteClass');
    Route::get('get/class/students' , 'Api\HomeController@getClassStudent');
    Route::get('get/booking/details' , 'Api\HomeController@getClassStudentDetails');
    Route::post('dismiss/class/student' , 'Api\HomeController@dismissStudentClass');

    /**
    * Product Api's
    */
	Route::get('get/products' , 'Api\HomeController@getProducts');
    Route::get('get/product/details' , 'Api\HomeController@getProductDetails');
	Route::post('create/product' , 'Api\HomeController@createProduct');
	Route::post('update/product' , 'Api\HomeController@updateProduct');
	Route::post('delete/product' , 'Api\HomeController@deleteProduct');
    Route::get('get/orders' , 'Api\HomeController@getOrders');
    Route::get('get/order/details' , 'Api\HomeController@getOrderDetails');
    
    /**
    * Application Api's
    */
    Route::post('set/business/day/hours' , 'Api\HomeController@setBusinessDayHours');
    Route::get('get/business/days' , 'Api\HomeController@getBusinessDays');
    Route::post('set/week/start/day' , 'Api\HomeController@setWeekStartDay');
    Route::post('set/time/slot' , 'Api\HomeController@setTimeSlot');
    Route::get('view/time/slot' , 'Api\HomeController@viewTimeSlot');
   
     /**
     * Book Appointment
     */
     Route::get('get/time/slot','Api\HomeController@getTimeSlot');
     Route::post('book/appointment' , 'Api\HomeController@bookAppointment');
     Route::post('add/notes' , 'Api\HomeController@addNotes');

     Route::get('get/appointments' , 'Api\HomeController@getAppointment');
     Route::post('cancel/appointment' , 'Api\HomeController@cancelAppointment');
     Route::post('complete/appointment' , 'Api\HomeController@completeAppointment');
     Route::get('complete/appointment' , 'Api\HomeController@completeAppointment');
     Route::get('get/appointment/details' , 'Api\HomeController@appointmentDetails');

     Route::post('approved/review' , 'Api\HomeController@approvedReview');
     Route::post('decline/review' , 'Api\HomeController@declineReview');

     

     





    

  

  

  
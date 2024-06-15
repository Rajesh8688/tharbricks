<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->group(function () {

    Route::post('/register', [App\Http\Controllers\Api\Auth\RegisterController::class, 'register']);

    Route::post('/login', [App\Http\Controllers\Api\Auth\LoginController::class, 'login']);

    Route::get('/services', [App\Http\Controllers\Api\ServiceController::class, 'services']);

    Route::post('/signup', [App\Http\Controllers\Api\Auth\RegisterController::class, 'signup']);

    Route::post('/forgetPassword', [App\Http\Controllers\Api\Auth\RegisterController::class, 'forgotPassword']); 

    Route::group(['middleware' => ['auth:api']], function() {

        Route::get('/leads', [App\Http\Controllers\Api\LeadController::class, 'leads']);
        
        Route::get('/leadDetails', [App\Http\Controllers\Api\LeadController::class, 'leadDetails']);

        Route::post('/deleteAccount', [App\Http\Controllers\Api\LeadController::class, 'deleteAccount']);

        Route::post('/notInterestedLead', [App\Http\Controllers\Api\LeadController::class, 'notInterestedLead']);

        Route::post('/InterestedLead', [App\Http\Controllers\Api\LeadController::class, 'InterestedLead']);

        //Response
        Route::post('/myleads', [App\Http\Controllers\Api\LeadController::class, 'myleads']);
        Route::get('/responseDetails', [App\Http\Controllers\Api\LeadController::class, 'responseDetails']);
        Route::post('/activityLogger', [App\Http\Controllers\Api\LeadController::class, 'activityLogger']);
        Route::post('/addestimation', [App\Http\Controllers\Api\LeadController::class, 'addestimation']);


        Route::post('/deleteAccount', [App\Http\Controllers\Api\VendorController::class, 'deleteAccount']);

        Route::get('/profile', [App\Http\Controllers\Api\VendorController::class, 'UserProfile']);

        Route::get('/transactionLogs', [App\Http\Controllers\Api\VendorController::class, 'transactionLogs']);

        Route::post('/UpdateProfile', [App\Http\Controllers\Api\VendorController::class, 'UpdateProfile']);

        Route::post('/changePassword', [App\Http\Controllers\Api\VendorController::class, 'changePassword']);
        Route::get('/notifications', [App\Http\Controllers\Api\NotificationsController::class, 'notifications']);
        Route::post('/uploadimage', [App\Http\Controllers\Api\VendorController::class, 'uploadimage']); // Upload the ad images
        Route::get('/orderCreation', [App\Http\Controllers\Api\VendorController::class, 'razorpayOrderCreation']); // order id 
        Route::post('/updateOrder', [App\Http\Controllers\Api\VendorController::class, 'updateOrder']); // update id 
        //Services
        Route::get('/myServices', [App\Http\Controllers\Api\VendorController::class, 'myServices']); // My Services
        Route::post('/addService', [App\Http\Controllers\Api\VendorController::class, 'addService']); // Add service 
        Route::post('/editService', [App\Http\Controllers\Api\VendorController::class, 'editService']); // edit service 
        Route::post('/removeService', [App\Http\Controllers\Api\VendorController::class, 'removeService']); // Remove service 
        
        Route::post('/updateLeadStatus', [App\Http\Controllers\Api\VendorController::class, 'updateUserServiceStatus']); // update lead status
        Route::post('/requestReview', [App\Http\Controllers\Api\VendorController::class, 'requestReview']); // Review Request
        Route::resource('/emailTemplate', \App\Http\Controllers\Api\EmailTemplateController::class);//email-template
        Route::get('/review', [App\Http\Controllers\Api\VendorController::class, 'review']); // Review Request

        //locations
        Route::get('/allLocations', [App\Http\Controllers\Api\VendorController::class, 'allLocations']); // all location
        Route::post('/addLocation', [App\Http\Controllers\Api\VendorController::class, 'addLocation']); // Add Location
        Route::post('/editLocation', [App\Http\Controllers\Api\VendorController::class, 'editLocation']); // Edit Location
        Route::delete('/deleteLocation', [App\Http\Controllers\Api\VendorController::class, 'deleteLocation']); // Delete Location
    

        Route::post('/delete-gallary-image', [App\Http\Controllers\Api\VendorController::class, 'deleteGalleryImage']); // available location





    });

    Route::get('/appversion', [App\Http\Controllers\Api\GeneralController::class, 'appVersion']);

    Route::get('/plan', [App\Http\Controllers\Api\PlanController::class, 'plan']);

    Route::get('/support', [App\Http\Controllers\Api\GeneralController::class, 'supportDetails']);


    // Route::post('/updateProfile', [App\Http\Controllers\Api\UserController::class, 'updateProfile'])->middleware('auth:api');

    // Route::group([
    //     'middleware' => ['auth:api']], function() {
    //         Route::post('/updateProfile', [App\Http\Controllers\Api\UserController::class, 'updateProfile']);
    //         Route::post('/UpdatePassword', [App\Http\Controllers\Api\UserController::class, 'UpdatePassword']); 
    //         Route::delete('deleteAccount', [App\Http\Controllers\Api\UserController::class, 'deleteAccount']);   
    //         Route::get('userBooking', [App\Http\Controllers\Api\UserController::class, 'bookings']);   
    //         Route::post('cancelBooking', [App\Http\Controllers\Api\UserController::class, 'cancelBooking']); 
    // });

    Route::get('/userServices', [App\Http\Controllers\Api\VendorController::class, 'userService']);

    

    
   
});

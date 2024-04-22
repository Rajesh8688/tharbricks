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

        Route::get('/myleads', [App\Http\Controllers\Api\LeadController::class, 'myleads']);
        
        Route::get('/responseDetails', [App\Http\Controllers\Api\LeadController::class, 'responseDetails']);

        Route::post('/deleteAccount', [App\Http\Controllers\Api\VendorController::class, 'deleteAccount']);

        Route::get('/profile', [App\Http\Controllers\Api\VendorController::class, 'UserProfile']);

        Route::post('/transactionLogs', [App\Http\Controllers\Api\VendorController::class, 'transactionLogs']);

        Route::post('/UpdateProfile', [App\Http\Controllers\Api\VendorController::class, 'UpdateProfile']);
    });

    Route::get('/appversion', [App\Http\Controllers\Api\GeneralController::class, 'appVersion']);

    Route::get('/plan', [App\Http\Controllers\Api\PlanController::class, 'plan']);


    // Route::post('/updateProfile', [App\Http\Controllers\Api\UserController::class, 'updateProfile'])->middleware('auth:api');

    // Route::group([
    //     'middleware' => ['auth:api']], function() {
    //         Route::post('/updateProfile', [App\Http\Controllers\Api\UserController::class, 'updateProfile']);
    //         Route::post('/UpdatePassword', [App\Http\Controllers\Api\UserController::class, 'UpdatePassword']); 
    //         Route::delete('deleteAccount', [App\Http\Controllers\Api\UserController::class, 'deleteAccount']);   
    //         Route::get('userBooking', [App\Http\Controllers\Api\UserController::class, 'bookings']);   
    //         Route::post('cancelBooking', [App\Http\Controllers\Api\UserController::class, 'cancelBooking']); 
    // });

    

    
   
});

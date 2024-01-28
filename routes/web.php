<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



Route::get('/', [App\Http\Controllers\FrontEnd\HomeController::class, 'index'])->name('home');
Route::get('contact-us', [App\Http\Controllers\FrontEnd\HomeController::class, 'contactUs'])->name('contactUs');
Route::post('submitContactUs', [App\Http\Controllers\FrontEnd\HomeController::class, 'submitContactUs'])->name('submitContactUs');

Route::get('getQuestions', [App\Http\Controllers\FrontEnd\QuestionsController::class, 'getQuestion'])->name('getQuestions');

Route::get('getPlans', [App\Http\Controllers\FrontEnd\PlanController::class, 'getPlans'])->name('getPlans');

Route::get('signup', [App\Http\Controllers\FrontEnd\HomeController::class, 'Signup'])->name('signup');

//Manual Auth
// Route::get('user/signup', [App\Http\Controllers\FrontEnd\HomeController::class, 'Signup'])->name('user-signup');
// Route::post('user/creation', [App\Http\Controllers\FrontEnd\HomeController::class, 'CreateFrontEndUser'])->name('user-creation');
Route::get('user/forget-password', [App\Http\Controllers\FrontEnd\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('user-forget.password.get');
Route::post('user/forget-password', [App\Http\Controllers\FrontEnd\ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('user-forget.password.post'); 
Route::get('reset-password/{token}', [App\Http\Controllers\FrontEnd\ForgotPasswordController::class, 'showResetPasswordForm'])->name('user-reset.password.get');
Route::post('reset-password', [App\Http\Controllers\FrontEnd\ForgotPasswordController::class, 'submitResetPasswordForm'])->name('user-reset.password.post');
Route::get('vendor/create', [App\Http\Controllers\FrontEnd\VendorController::class, 'create'])->name('vendor-create');

Route::post('vendor/login',[App\Http\Controllers\Auth\WebLoginController::class, 'login'])->name('vendor-login');

Route::post('vendor/createAccount', [App\Http\Controllers\FrontEnd\VendorController::class, 'storeVendor'])->name('vendor-store');



//service
Route::get('service', [App\Http\Controllers\FrontEnd\ServiceController::class, 'index'])->name('service');
Route::get('service/{slug}', [App\Http\Controllers\FrontEnd\ServiceController::class, 'serviceDetails'])->name('serviceDetails');


//leads
Route::post('storeLead', [App\Http\Controllers\FrontEnd\LeadController::class, 'storeLead'])->name('addLead');

Route::group(['middleware' => ['auth:web']], function() {
    Route::get('vendor/dashboard', [App\Http\Controllers\FrontEnd\VendorController::class, 'dashboard'])->name('vendor-dashboard');
    Route::get('vendor/leads', [App\Http\Controllers\FrontEnd\LeadController::class, 'leads'])->name('vendor-leads');
    Route::get('vendor/leads/details', [App\Http\Controllers\FrontEnd\LeadController::class, 'leadDetails'])->name('vendor-lead-details');
    Route::get('vendor/not-interested-lead', [App\Http\Controllers\FrontEnd\LeadController::class, 'notInterestedLead'])->name('vendor-not-interested-lead');
    Route::get('vendor/interested-lead', [App\Http\Controllers\FrontEnd\LeadController::class, 'InterestedLead'])->name('vendor-interested-lead');
    Route::get('vendor/my-tharbricks', [App\Http\Controllers\FrontEnd\LeadController::class, 'myleads'])->name('my-tharbricks');
    Route::get('vendor/response/details', [App\Http\Controllers\FrontEnd\LeadController::class, 'responseDetails'])->name('vendor-response-lead-details');
});



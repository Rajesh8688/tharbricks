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

//Blogs
Route::get('blogs', [App\Http\Controllers\FrontEnd\BlogController::class, 'index'])->name('blogs');
Route::get('blog/{slug}', [App\Http\Controllers\FrontEnd\BlogController::class, 'blogDetails'])->name('blogDetails');

//leads
Route::post('storeLead', [App\Http\Controllers\FrontEnd\LeadController::class, 'storeLead'])->name('addLead');


Route::get('sendNotification', [App\Http\Controllers\FrontEnd\LeadController::class, 'sendNotification']);
Route::post('sendOtp', [App\Http\Controllers\FrontEnd\LeadController::class, 'sendOtp'])->name('sendOtp');
Route::get('review/{token}', [App\Http\Controllers\FrontEnd\HomeController::class, 'review'])->name('requestReview');
Route::post('submitReview', [App\Http\Controllers\FrontEnd\HomeController::class, 'reviewSubmit'])->name('submitReview');
Route::get('review-success', [App\Http\Controllers\FrontEnd\HomeController::class, 'reviewSuccess'])->name('reviewSuccess');
Route::get('review-failure', [App\Http\Controllers\FrontEnd\HomeController::class, 'reviewFailure'])->name('reviewFailure');


Route::group(['middleware' => ['auth:web']], function() {
    Route::get('vendor/dashboard', [App\Http\Controllers\FrontEnd\VendorController::class, 'dashboard'])->name('vendor-dashboard');
    Route::get('vendor/leads', [App\Http\Controllers\FrontEnd\LeadController::class, 'leads'])->name('vendor-leads');
    Route::get('vendor/leads/details', [App\Http\Controllers\FrontEnd\LeadController::class, 'leadDetails'])->name('vendor-lead-details');
    Route::get('vendor/not-interested-lead', [App\Http\Controllers\FrontEnd\LeadController::class, 'notInterestedLead'])->name('vendor-not-interested-lead');
    Route::get('vendor/interested-lead', [App\Http\Controllers\FrontEnd\LeadController::class, 'InterestedLead'])->name('vendor-interested-lead');
    
    Route::get('vendor/my-tharbricks', [App\Http\Controllers\FrontEnd\LeadController::class, 'myleads'])->name('my-tharbricks');
    Route::get('vendor/response/details', [App\Http\Controllers\FrontEnd\LeadController::class, 'responseDetails'])->name('vendor-response-lead-details');
    Route::get('vendor/activityLogger', [App\Http\Controllers\FrontEnd\LeadController::class, 'activityLogger'])->name('vendor-activity-logger');
    Route::post('vendor/addEstimation', [App\Http\Controllers\FrontEnd\LeadController::class, 'addEstimation'])->name('vendor-estimation');
    
    Route::get('vendor/edit', [App\Http\Controllers\FrontEnd\VendorController::class, 'edit'])->name('vendor-edit');
    Route::post('vendor/company/update', [App\Http\Controllers\FrontEnd\VendorController::class, 'updateCompanyDetails'])->name('update-company-details');
    Route::post('vendor/user/update', [App\Http\Controllers\FrontEnd\VendorController::class, 'updateUserDetails'])->name('update-user-details');
    Route::post('vendor/social-account/update', [App\Http\Controllers\FrontEnd\VendorController::class, 'updateSocialMediaDetails'])->name('update-vendor-social-account-details');
    Route::post('vendor/update/services', [App\Http\Controllers\FrontEnd\VendorController::class, 'updateServices'])->name('update-vendor-services');
    Route::post('vendor/update/questions', [App\Http\Controllers\FrontEnd\VendorController::class, 'updateQuestions'])->name('update-vendor-questions');
    Route::post('vendor/image/upload', [App\Http\Controllers\FrontEnd\VendorController::class, 'uploadCompanyImage'])->name('update-company-image');
    Route::post('vendor/image/delete', [App\Http\Controllers\FrontEnd\VendorController::class, 'deleteCompanyImage'])->name('delete-company-image');
    Route::get('vendor/my-credits', [App\Http\Controllers\FrontEnd\VendorController::class, 'myCredits'])->name('my-credits');
    // Route::post('vendor/my-credits', [App\Http\Controllers\RazorpayPaymentController::class, 'store']);
    Route::post('vendor/my-credits', [App\Http\Controllers\FrontEnd\VendorController::class, 'storePayment']);

    // Route::get('vendor/payment', [RazorpayPaymentController::class, 'index']);
    // Route::post('vendor/payment', [App\Http\Controllers\RazorpayPaymentController::class, 'store']);


    Route::get('/change-password', [App\Http\Controllers\FrontEnd\VendorController::class, 'ChangePassword'])->name('change-password');
    Route::post('/change-password', [App\Http\Controllers\FrontEnd\VendorController::class, 'UpdatePassword'])->name('updatePassword');

    Route::post('/addlocation', [App\Http\Controllers\FrontEnd\VendorController::class, 'addLocation'])->name('addlocation');

    

});



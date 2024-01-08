<?php

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

Route::get('/', [App\Http\Controllers\FrontEnd\HomeController::class, 'index'])->name('home');
Route::get('contact-us', [App\Http\Controllers\FrontEnd\HomeController::class, 'contactUs'])->name('contactUs');
Route::post('submitContactUs', [App\Http\Controllers\FrontEnd\HomeController::class, 'submitContactUs'])->name('submitContactUs');

Route::get('getQuestions', [App\Http\Controllers\FrontEnd\QuestionsController::class, 'getQuestion'])->name('getQuestions');
Route::post('storeRequirement', [App\Http\Controllers\FrontEnd\RequirementController::class, 'storeRequirement'])->name('addRequirement');



//category
Route::get('category', [App\Http\Controllers\FrontEnd\CategoryController::class, 'index'])->name('category');
Route::get('category/{slug}', [App\Http\Controllers\FrontEnd\CategoryController::class, 'categoryDetails'])->name('categoryDetails');

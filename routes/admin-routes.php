<?php 
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Admin web" middleware group. Now create something great!
|
*/
Route::get('admin/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'showLoginForm']);
Route::post('admin/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'login']);
Route::get('admin', function () {
    return redirect('admin/login');
});

Route::group([
    'name' => 'admin.',
    'prefix' => 'admin',
    'middleware' => ['auth:admin'],
], function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.dashboard');

    Route::resource('role', \App\Http\Controllers\Admin\RoleController::class);//Roles
    Route::resource('permission', \App\Http\Controllers\Admin\PermissionController::class);//Permissions
    Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class);//Category

    Route::resource('user_request', \App\Http\Controllers\Admin\UserRequestController::class);//UserRequest

    Route::resource('question', \App\Http\Controllers\Admin\QuestionController::class);//question
    Route::get('/get-category-question', [\App\Http\Controllers\Admin\QuestionController::class , 'getCategoryQuestions'])->name('getCategoryQuestions');

    Route::get('/user', [App\Http\Controllers\Admin\UserController::class, 'UserList'])->name('admin.userList');
    Route::get('/edit', [App\Http\Controllers\Admin\UserController::class, 'editUser'])->name('admin.editUser');
    Route::post('/updateUser/{id}', [App\Http\Controllers\Admin\UserController::class, 'updateUser'])->name('admin.updateUser');
    Route::resource('operator', \App\Http\Controllers\Admin\OperatorController::class);//Operator

    Route::get('/changePassword', [App\Http\Controllers\Admin\UserController::class, 'changePassword'])->name('admin.changePassword');
    Route::post('/UpdatePassword', [App\Http\Controllers\Admin\UserController::class, 'updatePassword'])->name('admin.updatePassword');

    // Contacts
    Route::get('/contactinfo', [App\Http\Controllers\Admin\SettingsController::class, 'contactinfo'])->name('contactinfo');
    Route::put('/contactinfoupdate', [App\Http\Controllers\Admin\SettingsController::class, 'contactinfoUpdate'])->name('contactinfo.update');
    Route::get('/feedback', [App\Http\Controllers\Admin\SettingsController::class, 'feedback'])->name('feedback');
    Route::delete('/feedback/{feedback}', [App\Http\Controllers\Admin\SettingsController::class, 'feedbackDelete'])->name('feedback.destroy');

    // Settings
    Route::get('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'settings'])->name('admin.settings.show');
    Route::post('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'settingsUpdate'])->name('admin.settings.update');
    Route::get('/settings/profile/', [App\Http\Controllers\Admin\SettingsController::class, 'showprofile'])->name('admin.profile.show');
    Route::post('/settings/profile/', [App\Http\Controllers\Admin\SettingsController::class, 'updateprofile'])->name('admin.profile.update');
    


    
});


Route::post('admin/logout', [App\Http\Controllers\Auth\AdminLoginController::class, 'logout'])->name('admin.logout');
?>
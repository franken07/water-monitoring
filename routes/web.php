<?php

use App\Http\Controllers\about_controller;

use App\Http\Controllers\contacts_controller;
use App\Http\Controllers\index_controller;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserLoginController;


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

Route::get('/', function () {
    return view('index');
});


Route::get('/about',[about_controller::class, 'about'])->name('about');
Route::get('/contact',[contacts_controller::class, 'contact'])->name('contact');
Route::get('/index',[index_controller::class, 'index'])->name('index');


Route::put('/users/{id}/update-usertype', [Authentication::class, 'updateUserType'])->name('users.update-usertype');
Route::get('/login', [Authentication::class, 'login'])->name('login');
Route::post('/login', [Authentication::class, 'loginPost'])->name('login.post');
Route::get('/registration', [Authentication::class, 'registration'])->name('registration');
Route::post('/registration', [Authentication::class, 'registrationPost'])->name('registration.post');
Route::get('/logout', [Authentication::class, 'logout'])->name('logout');



Route::get('/reset-request', [ResetPasswordController::class, 'forgetpassword'])->name('forget.password');
Route::post('/reset-request', [ResetPasswordController::class, 'forgetpasswordpost'])->name('forget.password.post');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetpassword'])->name('reset.password');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPasswordPost'])->name('reset.password.post');


Route::get('/users/{id}/edit', [Authentication::class, 'editUser'])->name('users.edit');
Route::put('/users/{id}', [Authentication::class, 'updateUser'])->name('users.update');
Route::delete('/users/{id}', [Authentication::class, 'deleteUser'])->name('users.delete');
Route::get('/users', [Authentication::class, 'getalluser'])->name('users.list');


Route::get('/export-users', function() {
    return Excel::download(new UsersExport, 'users.xlsx');
});

Route::get('/export-users', function() {
    return Excel::download(new UsersExport, 'users.xlsx');
})->name('export.users');

Route::get('/export-products', function () {
    return Excel::download(new ProductsExport, 'products.xlsx');
});



Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');




Route::post('/firebase-login', [AuthController::class, 'firebaseLogin']);

//index login
/*
Route::group(['middleware' => 'firebaseAuth'], function() {
    Route::get('/index', function () {
        return view('index');
    })->name('index');
});
*/

Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Admin Panel Route
Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index');

Route::group(['middleware' => 'firebaseAuth'], function () {
    Route::get('/sensor', [SensorController::class, 'index'])->name('sensor.index');
    Route::get('/sensor/live-data', [SensorController::class, 'liveData'])->name('sensor.liveData');
    Route::get('/sensor/live', [SensorController::class, 'liveData']); // optional
});


Route::get('/admin/users', [App\Http\Controllers\AdminUserController::class, 'index'])
    ->name('admin.users.index');
Route::middleware(['firebaseAuth'])->group(function () {
    // Admin Dashboard
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])
        ->name('admin.index');

    // Admin Users Page
    Route::get('/admin/users', [App\Http\Controllers\AdminuserController::class, 'index'])
        ->name('admin.users.index');
});
Route::prefix('admin')->group(function () {
    // ✅ Admin Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.index');

    // ✅ Admin User Management
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{uid}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::post('/users/{uid}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{uid}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');

    // ✅ Admin User Logins Page
 Route::get('/user-logins', [AdminUserLoginController::class, 'index'])->name('admin.user_logins.index');
    Route::post('/user-logins/{uid}/{deviceId}/approve', [AdminUserLoginController::class, 'approveLogin'])->name('admin.user_logins.approve');
    Route::post('/user-logins/{uid}/{deviceId}/reject', [AdminUserLoginController::class, 'rejectLogin'])->name('admin.user_logins.reject');
});
// Admin User Logins Table (for auto-refresh)
Route::get('/admin/user-logins/fetch', [AdminUserLoginController::class, 'fetchTable'])
    ->name('admin.user_logins.fetch');

Route::get('/assets/{path}', function ($path) {
    $file = resource_path('assets/' . $path);
    if (file_exists($file)) {
        return response()->file($file);
    }
    abort(404);
})->where('path', '.*');

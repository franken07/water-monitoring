<?php

use App\Http\Controllers\about_controller;
use App\Http\Controllers\Apointmentcontroller;
use App\Http\Controllers\contacts_controller;
use App\Http\Controllers\index_controller;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\Productcontroller;
use App\Http\Controllers\ResetPasswordController;
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

Route::get('/', function () {
    return view('index');
});


Route::get('/about',[about_controller::class, 'about'])->name('about');
Route::get('/contact',[contacts_controller::class, 'contact'])->name('contact');
Route::get('/index',[index_controller::class, 'index'])->name('index');
Route::get('/components',[Productcontroller::class, 'components'])->name('components');

Route::put('/users/{id}/update-usertype', [Authentication::class, 'updateUserType'])->name('users.update-usertype');
Route::get('/login', [Authentication::class, 'login'])->name('login');
Route::post('/login', [Authentication::class, 'loginPost'])->name('login.post');
Route::get('/registration', [Authentication::class, 'registration'])->name('registration');
Route::post('/registration', [Authentication::class, 'registrationPost'])->name('registration.post');
Route::get('/logout', [Authentication::class, 'logout'])->name('logout');
Route::get('/users', [Authentication::class, 'getalluser'])->name('users.getall');


Route::get('/reset-request', [ResetPasswordController::class, 'showResetRequestForm'])->name('reset.request.form');
Route::post('/reset-request', [ResetPasswordController::class, 'showResetPasswordPost'])->name('reset.request.post');
Route::get('/reset-password', [ResetPasswordController::class, 'showResetPasswordForm'])->name('reset.password.form');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPasswordPost'])->name('reset.password.post');

Route::get('/admin', [Productcontroller::class, 'admin'])->name('admin');
Route::post('/admin', [Productcontroller::class, 'addProduct'])->name('addProduct');
Route::get('/userPurchases', [Productcontroller::class, 'userPurchases'])->name('user.purchases');  
Route::get('/delivered/{id}', [Productcontroller::class, 'delivered'])->name('delivered');
Route::post('/delivered/{id}', [Productcontroller::class, 'delivered'])->name('delivered');

Route::post('/cart/{id}', [Productcontroller::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [Productcontroller::class, 'checkout'])->name('checkout');
Route::delete('/remove-cart/{order}', [Productcontroller::class, 'removeCartItem'])->name('remove_cart');
Route::get('/checkout', [Productcontroller::class, 'checkoutprod'])->name('checkoutprod');
Route::post('/checkout', [Productcontroller::class, 'checkoutprod'])->name('checkoutprod');


Route::get('/admin', [Productcontroller::class, 'editDeleteProducts'])->name('edit_delete_products');
Route::put('/admin/products/{id}', [Productcontroller::class, 'editProduct'])->name('edit_product');
Route::delete('/admin/products/{productId}', [Productcontroller::class, 'deleteProduct'])->name('delete_product');
Route::get('/admin/products/{id}/edit', [Productcontroller::class, 'editprod'])->name('editprod');

Route::get('/billing', [Productcontroller::class, 'billingshow'])->name('billing');
Route::put('/billing', [Productcontroller::class, 'updateBilling'])->name('billing.buy');

Route::get('/appointments',[Apointmentcontroller::class, 'Appointmentindex'])->name('Appointmentindex');
Route::get('/appointments/{date}',[Apointmentcontroller::class, 'Appointmentshow'])->name('Appointmentshow');
Route::post('/appointments', [Apointmentcontroller::class, 'Appointmentstore'])->name('Appointmentstore');
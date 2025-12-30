<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\OrderStatusController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\UserController as DashboardUserController;
use App\Http\Controllers\GeneralUtils;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\InvoiceController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('test', [PaymentController::class, 'pay_order']);

Route::get('/cart', function () {
    return view('user.cart');
})->name('cart');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'sign_in'])->name('sign-in');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'sign_up'])->name('sign-up');

// Logged
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
});
Route::resource('/category', CategoryController::class);
Route::resource('/product', ProductController::class);
Route::get('/orders', [OrderStatusController::class, 'index'])->name('order.status');
Route::put('/orders/{order_id}', [OrderStatusController::class, 'update_status'])->name('order.status.update');
Route::get('/user', [DashboardUserController::class, 'index'])->name('user.index');
Route::delete('/users/{id}', [DashboardUserController::class, 'destroy'])->name('user.destroy');

// User home
Route::get('/about', [Controller::class, 'about_us'])->name('about-us');
Route::get('/home', [Controller::class, 'home'])->name('home');
Route::get('/menu', [Controller::class, 'menu'])->name('menu');
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::get('/profile/edit', [UserController::class, 'edit_form'])->name('profile.edit.form');
Route::put('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
Route::get('/book-table', [Controller::class, 'book_table'])->name('book-table');
Route::resource('/cart', CartController::class);
Route::resource('/payment', PaymentController::class);
Route::get('/invoice/{payment_id}', [InvoiceController::class, 'invoice'])->name('invoice');
Route::get('/invoice/{payment_id}/download', [InvoiceController::class, 'download_invoice'])->name('invoice.download');
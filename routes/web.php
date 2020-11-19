<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileContoller;
use App\Http\Controllers\OrderController;
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

// Authrntication
Auth::routes();
Route::post('/prelogin', [LoginController::class,'prelogin'])->name('prelogin');

// HomePageController
Route::get('/', [HomePageController::class, "index"] )->name("pages.home");

//ProductController
Route::resource('/products', ProductController::class);

//ProfileController
Route::resource('/profile', ProfileContoller::class);

// OrderController
Route::resource('/orders', OrderController::class);
Route::post('/order/{product_id}', [OrderController::class,'createOrder'])->name("create_order");
Route::get('/order/inform/{order_id}', [OrderController::class,'inform'])->name("inform_order");
Route::put('/order/inform/{order_id}',[OrderController::class,'uploadPayment'])->name("upload_payment");

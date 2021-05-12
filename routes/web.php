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
Route::post('/products/carts',[ ProductController::class,'cart'])->name('cart.show');
Route::get('/report', [ ProductController::class,'report'])->name('report');

//ProfileController
Route::resource('/profile', ProfileContoller::class);

// OrderController
Route::resource('/orders', OrderController::class);
Route::put('orders/{id}/accept',[OrderController::class, "acceptPayment"])->name("orders.accept");
Route::put('orders/{id}/reject',[OrderController::class, "rejectPayment"])->name("orders.reject");
Route::put('orders/{id}/update-shipment',[OrderController::class, "updateShipment"])->name("orders.update_shipment");
Route::get('orders/{id}/detail',[OrderController::class, "showOrderDetail"])->name("orders.show_detail");

Route::get("/test", function() {
    return view("orders.success");
});




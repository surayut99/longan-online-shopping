<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileContoller;
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

// HomePageController
Route::get('/', [HomePageController::class, "index"] )->name("pages.home");

//ProductController
Route::resource('/products', ProductController::class);

//ProfileController
Route::resource('/profile', ProfileContoller::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/prelogin', [LoginController::class,'prelogin'])->name('prelogin');

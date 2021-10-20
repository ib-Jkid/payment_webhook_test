<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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
    return view('welcome');
});


Route::get('/login',[AuthController::class, "login_page"])->name('login');
Route::get('/register',[AuthController::class, "register_page"])->name('register');

Route::get('/logout',[AuthController::class, "logout"])->name('logout');


Route::post('/login',[AuthController::class, "login"])->name('login');
Route::post('/register',[AuthController::class, "register"])->name('register');


Route::middleware("auth")->group(function() {
    Route::get('/dashboard',[DashboardController::class, "index"])->name('dashboard');
    Route::get('/transactions',[DashboardController::class, "transactions"])->name('transactions');
    Route::get('/payment',[DashboardController::class, "payment"])->name('payment');


    Route::post('/payment/initiate',[DashboardController::class, "initiate_payment"])->name('payment.initiate');
    Route::get('/payment/{reference}/verify',[DashboardController::class, "verify_payment"])->name('payment.verify');
});


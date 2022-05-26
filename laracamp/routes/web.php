<?php

use Illuminate\Support\Facades\Route;

//Import controllers
use App\Http\Controllers\UserController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\DashboardController;

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
})->name('welcome');

//Routing untuk Socialite
Route::get('sign-in-google', [UserController::class, 'loginGoogle'])->name('user.login.google');
Route::get('auth/google/callback', [UserController::class, 'handleProviderCallback'])->name('user.google.callback');

// Buat Group Routing untuk semua Route yang membutuhkan login
Route::middleware(['auth'])->group(function(){
    // Checkout Route
    Route::get('checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('checkout/{camps:slug}', [CheckoutController::class, 'create'])->name('checkout.create');
    Route::post('checkout/{camps}', [CheckoutController::class, 'store'])->name('checkout.store');

    //Routing ke Dashboard
    Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';

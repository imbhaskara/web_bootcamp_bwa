<?php

use Illuminate\Support\Facades\Route;

//Import controllers
use App\Http\Controllers\UserController;

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

Route::get('checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('success-checkout', function () {
    return view('success_checkout');
})->name('success-checkout');

//Routing untuk Socialite
Route::get('sign-in-google', [UserController::class, 'loginGoogle'])->name('user.login.google');
Route::get('auth/google/callback', [UserController::class, 'handleProviderCallback'])->name('user.google.callback');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

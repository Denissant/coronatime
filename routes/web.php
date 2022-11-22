<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\RegisterController;
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

Route::view('/', 'welcome')->name('home');

Route::controller(LoginController::class)->group(function () {
	Route::get('login', 'login')->name('login')->middleware('guest');
	Route::post('login', 'authenticate')->name('login')->middleware('guest');
	Route::post('logout', 'logout')->name('logout')->middleware('auth');
});

Route::controller(RegisterController::class)->group(function () {
	Route::get('register', 'register')->name('register')->middleware('guest');
	Route::post('register', 'store')->name('register')->middleware('guest');
});

Route::controller(ForgotPasswordController::class)->group(function () {
	Route::get('forgot-password', 'forgot')->name('password.request')->middleware('guest');
	Route::post('forgot-password', 'email')->name('password.email')->middleware('guest');
});

Route::controller(ResetPasswordController::class)->group(function () {
	Route::get('reset-password/{token}', 'reset')->name('password.reset')->middleware('guest');
	Route::post('reset-password', 'update')->name('password.update')->middleware('guest');
});

Route::view('/password-splash', 'auth.password-changed-splash')->name('password-splash');
Route::view('/email-splash', 'auth.email-confirmed-splash')->name('email-splash');
Route::view('/confirmation-splash', 'auth.confirmation-sent-splash')->name('confirmation-splash');

Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'index'])->middleware(['signed'])->name('verification.verify');

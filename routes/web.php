<?php

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

Route::view('/login', 'auth.login')->name('login');
Route::controller(RegisterController::class)->group(function () {
	Route::get('register', 'register')->name('register')->middleware('guest');
	Route::post('register', 'store')->name('register')->middleware('guest');
});

Route::view('/forgot', 'auth.forgot')->name('forgot');
Route::view('/reset', 'auth.change-password')->name('reset');
Route::view('/password-splash', 'auth.password-changed-splash')->name('password-splash');
Route::view('/email-splash', 'auth.email-confirmed-splash')->name('email-splash');

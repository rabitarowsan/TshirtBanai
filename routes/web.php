<?php

use App\Http\Controllers\AuthManager;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('pricing', function () {
    return view('pricing');
})->name('pricing');

Route::get('customize', function () {
    return view('customize');
})->name('customize');

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');

Route::get('/register', [AuthManager::class, 'register'])->name('register');
Route::post('/register', [AuthManager::class, 'registerPost'])->name('register.post');

Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

Route::get('/forgotpassword', [ForgotPasswordManager::class, 'forgotpassword'])->name('forgot.password');
Route::post('/forgotpassword', [ForgotPasswordManager::class, 'forgotpasswordPost'])->name('forgot.password.post');

Route::get('/resetpassword/{token}', [ForgotPasswordManager::class, 'resetPassword'])->name('reset.password');
Route::post('/resetpassword/{token}', [ForgotPasswordManager::class, 'resetPasswordPost'])->name('reset.password.post');


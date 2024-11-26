<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {return view('main.HomePage');})->name('homePage');
Route::get('/registration', [UserController::class, 'viewRegisterPage'])->name('registerPage');
Route::post('/register', [UserController::class, 'register'])->name('registerPage.register');
Route::get('/login', [UserController::class, 'viewLoginPage'])->name('loginPage');
Route::post('/login', [UserController::class, 'login'])->name('loginPage.login');
Route::get('/logout', [UserController::class, 'logout'])->name('loginPage.logout');
Route::get('/about-us', function () {return view('main.AboutUsPage');})->name('aboutUsPage');
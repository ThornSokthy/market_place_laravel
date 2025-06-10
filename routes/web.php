<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Route::view('/profile', 'profile.index')->name('profile');

Route::get("/", [ProductController::class, "index"])->name("home");
Route::get("/profile", [UserController::class, "getProfile"])->name("profile");
Route::get('/order', [UserController::class, 'getOrder'])->name("order");

Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

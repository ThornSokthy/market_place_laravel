<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Route::view('/profile', 'profile.index')->name('profile');

Route::get("/", [ProductController::class, "index"])->name("home");
Route::get("/profile", [UserController::class, "getProfile"])->name("profile");

Route::post('/posts', [ProductController::class, 'store'])->name('posts.store');
Route::delete('/posts/{id}', [ProductController::class, 'destroy'])->name('posts.destroy');
Route::put('/posts/{id}', [ProductController::class, 'update'])->name('posts.update');

Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

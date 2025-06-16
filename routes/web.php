<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get("/", [ProductController::class, "index"])->name("home");

Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::delete('/orders/{id}', [OrderController::class, 'cancel'])->name('orders.cancel');

    Route::post('/posts', [ProductController::class, 'store'])->name('posts.store');
    Route::delete('/posts/{id}', [ProductController::class, 'destroy'])->name('posts.destroy');
    Route::put('/posts/{id}', [ProductController::class, 'update'])->name('posts.update');

    Route::get("/profile", [UserController::class, "getProfile"])->name("profile");
    Route::get("/profile/update", [UserController::class, "edit"])->name("profile.edit");
    Route::put("/profile/update", [UserController::class, "update"])->name("profile.update");

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

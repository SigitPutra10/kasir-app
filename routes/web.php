<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return view('main');
// });

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('authProcess');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');

});

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductsController::class, 'index'])->name('index'); // Perbaikan di sini!
    Route::get('/create', [ProductsController::class, 'create'])->name('create');
    Route::post('/', [ProductsController::class, 'store'])->name('store');
    Route::get('/{product}/edit', [ProductsController::class, 'edit'])->name('edit');
    Route::put('/{product}', [ProductsController::class, 'update'])->name('update');
    Route::delete('/{product}', [ProductsController::class, 'destroy'])->name('destroy');
});


Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
});
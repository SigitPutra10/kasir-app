<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductsController;

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

Route::prefix('/products')->name('products.')->group(function () {
    Route::get('/products', [ProductsController::class, 'index'])->name('index');
    Route::get('/create', [ProductsController::class, 'create'])->name('create');
    Route::post('/', [ProductsController::class, 'store'])->name('store');
    Route::get('/{product}/edit', [ProductsController::class, 'edit'])->name('edit');
    Route::put('/{product}', [ProductsController::class, 'update'])->name('update');
    Route::delete('/{product}', [ProductsController::class, 'destroy'])->name('destroy');
});
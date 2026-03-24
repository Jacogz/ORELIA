<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\AdminController;

// LOGIN
Route::get('/login',  [UserController::class, 'login'])->name('login.index');
Route::post('/login', [UserController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [UserController::class, 'logout'])->name('login.logout');

// HOME
Route::get('/', [MaterialController::class, 'index'])->name('home.index');

// MATERIALS CRUD
    Route::prefix('materials')->group(function () {
    Route::get('/', [MaterialController::class, 'index'])->name('materials.index');       
    Route::get('/create', [MaterialController::class, 'create'])->name('materials.create'); 
    Route::post('/', [MaterialController::class, 'store'])->name('materials.store');  
    Route::get('/{id}', [MaterialController::class, 'show'])->name('materials.show');       
    Route::delete('/{id}', [MaterialController::class, 'destroy'])->name('materials.destroy'); 
});

// USERS CRUD
Route::get('/users',        [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users',       [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}',   [UserController::class, 'show'])->name('users.show');
Route::delete('/users/{id}',[UserController::class, 'destroy'])->name('users.destroy');

// ORDER ITEMS CRUD
Route::get('/orderitems',        [OrderItemController::class, 'index'])->name('orderitems.index');
Route::get('/orderitems/create', [OrderItemController::class, 'create'])->name('orderitems.create');
Route::post('/orderitems',       [OrderItemController::class, 'store'])->name('orderitems.store');
Route::get('/orderitems/{id}',   [OrderItemController::class, 'show'])->name('orderitems.show');
Route::delete('/orderitems/{id}',[OrderItemController::class, 'destroy'])->name('orderitems.destroy');

// ADMIN ROUTES (only for admins)
Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
});
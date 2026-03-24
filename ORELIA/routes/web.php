<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMaterialController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Authentication
Route::get('/login', [UserController::class, 'login'])->name('login.index');
Route::post('/login', [UserController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [UserController::class, 'logout'])->name('login.logout');

// Final user section (read-only views)
Route::get('/', [MaterialController::class, 'index'])->name('home.index');
Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
Route::get('/materials/{id}', [MaterialController::class, 'show'])->name('materials.show');
Route::get('/collections', [CollectionController::class, 'index'])->name('collections.index');
Route::get('/collections/{id}', [CollectionController::class, 'show'])->name('collections.show');
Route::get('/orderitems', [OrderItemController::class, 'index'])->name('orderitems.index');
Route::get('/orderitems/{id}', [OrderItemController::class, 'show'])->name('orderitems.show');

// Admin section (independent views and controllers)
Route::middleware(['admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');

        // Admin Material CRUD (complete)
        Route::get('/materials', [AdminMaterialController::class, 'index'])->name('materials.index');
        Route::get('/materials/create', [AdminMaterialController::class, 'create'])->name('materials.create');
        Route::post('/materials', [AdminMaterialController::class, 'store'])->name('materials.store');
        Route::get('/materials/{id}', [AdminMaterialController::class, 'show'])->name('materials.show');
        Route::get('/materials/{id}/edit', [AdminMaterialController::class, 'edit'])->name('materials.edit');
        Route::put('/materials/{id}', [AdminMaterialController::class, 'update'])->name('materials.update');
        Route::delete('/materials/{id}', [AdminMaterialController::class, 'destroy'])->name('materials.destroy');

        // Admin User CRUD (complete)
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
        Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}', [AdminUserController::class, 'show'])->name('users.show');
        Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    });

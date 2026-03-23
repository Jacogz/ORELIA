<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderItemController;

// MATERIAL ROUTES
Route::get('/', [MaterialController::class, 'index'])->name('material.index');
Route::get('/materials/create', [MaterialController::class, 'create'])->name('material.create');
Route::post('/materials', [MaterialController::class, 'save'])->name('material.save');
Route::get('/materials', [MaterialController::class, 'list'])->name('material.list');
Route::get('/materials/{id}', [MaterialController::class, 'show'])->name('material.show');
Route::delete('/materials/{id}', [MaterialController::class, 'destroy'])->name('material.destroy');

// USER ROUTES
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// ORDERITEM ROUTES
Route::get('/orderitems/create', [OrderItemController::class, 'create'])->name('orderitems.create');
Route::post('/orderitems', [OrderItemController::class, 'store'])->name('orderitems.store');
Route::get('/orderitems', [OrderItemController::class, 'index'])->name('orderitems.index');
Route::get('/orderitems/{id}', [OrderItemController::class, 'show'])->name('orderitems.show');
Route::delete('/orderitems/{id}', [OrderItemController::class, 'destroy'])->name('orderitems.destroy');
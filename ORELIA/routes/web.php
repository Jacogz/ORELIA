<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PieceController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

// Pieces ---------------------------------
// Public routes
Route::get('/',                                 [PieceController::class, 'index'])->name('pieces.index');
Route::get('/pieces/{id}',                      [PieceController::class, 'show'])->name('pieces.show');
// Admin routes
Route::get('/admin/pieces/create',              [PieceController::class, 'create'])->name('pieces.create');
Route::post('/admin/pieces',                    [PieceController::class, 'store'])->name('pieces.store');
Route::get('/admin/pieces/{id}/edit',           [PieceController::class, 'edit'])->name('pieces.edit');
Route::put('/admin/pieces/{id}',                [PieceController::class, 'update'])->name('pieces.update');
Route::delete('/admin/pieces/{id}',             [PieceController::class, 'delete'])->name('pieces.delete');

// Materials ---------------------------------
// Public routes
Route::get('/materials',                        [MaterialController::class, 'index'])->name('materials.index');
Route::get('/materials/{id}',                   [MaterialController::class, 'show'])->name('materials.show');
// Admin routes
Route::get('/admin/materials/create',           [MaterialController::class, 'create'])->name('materials.create');
Route::post('/admin/materials',                 [MaterialController::class, 'store'])->name('materials.store');
Route::get('/admin/materials/{id}/edit',        [MaterialController::class, 'edit'])->name('materials.edit');
Route::put('/admin/materials/{id}',             [MaterialController::class, 'update'])->name('materials.update');
Route::delete('/admin/materials/{id}',          [MaterialController::class, 'delete'])->name('materials.delete');

// Collections ---------------------------------
// Public routes
Route::get('/collections',                      [CollectionController::class, 'index'])->name('collections.index');
Route::get('/collections/{id}',                 [CollectionController::class, 'show'])->name('collections.show');

// Orders --------------------------------------
// Public routes
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}',                      [OrderController::class, 'show'])->name('orders.show');

// Oder Items -----------------------------------
//Public routes
Route::get('/orderitems',                       [OrderItemController::class, 'index'])->name('orderitems.index');
Route::get('/orderitems/{id}',                  [OrderItemController::class, 'show'])->name('orderitems.show');
// Admin routes
Route::get('/admin/orderitems/create',          [OrderItemController::class, 'create'])->name('orderitems.create');
Route::post('/admin/orderitems',                [OrderItemController::class, 'store'])->name('orderitems.store');
Route::get('/admin/orderitems/{id}/edit',       [OrderItemController::class, 'edit'])->name('orderitems.edit');
Route::put('/admin/orderitems/{id}',            [OrderItemController::class, 'update'])->name('orderitems.update');
Route::delete('/admin/orderitems/{id}',         [OrderItemController::class, 'delete'])->name('orderitems.delete');

// Users --------------------------------------
// Public routes
Route::get('/users/login',                      [UserController::class, 'login'])->name('users.login');
Route::post('/users/authenticate',              [UserController::class, 'authenticate'])->name('users.authenticate');
Route::post('/users/logout',                    [UserController::class, 'logout'])->name('users.logout');
// Admin routes
Route::get('/admin/users',                      [UserController::class, 'index'])->name('admin.users.index');
Route::get('/admin/users/create',               [UserController::class, 'create'])->name('admin.users.create');
Route::post('/admin/users',                     [UserController::class, 'store'])->name('admin.users.store');
Route::get('/admin/users/{id}',                 [UserController::class, 'show'])->name('admin.users.show');

// Admin Dashboard ---------------------------------------
Route::get('/admin',                            [AdminController::class, 'index'])->name('admin.index');
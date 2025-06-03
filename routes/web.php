<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

// auth

Route::get('/', function () {return view('Admin.login');})->name('get.login');

Route::post('/', [AdminController::class, 'login'])->name('login');

Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

Route::middleware('auth:admin')->group(function () {

// dashboard

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// create account user

Route::get('/create-user', [UserController::class, 'create'])->name('create');

Route::post('/register', [UserController::class, 'register'])->name('create_user');

Route::get('/users', [UserController::class, 'show'])->name('users');

Route::delete('/user/{user}', [UserController::class, 'hapus'])->name('user.destroy');

Route::get('users/export/', [UserController::class, 'export']);

// item

Route::get('/createitem', [ItemController::class, 'show_create_item'])->name('create.item');

Route::post('/createitem', [ItemController::class, 'create_item'])->name('item.create');

Route::get('/items', [ItemController::class, 'show'])->name('items');

Route::get('/item/{item}/edit', [itemController::class, 'show_edit_item'])->name('itemshow.edit');

Route::put('/item/{item}', [itemController::class, 'edit_item'])->name('item.edit');

Route::delete('/item/{item}', [ItemController::class, 'destroy_item'])->name('item.destroy');

Route::get('items/export/', [ItemController::class, 'export']);

// category

Route::get('/createcategory', [CategoryController::class, 'show_create_category'])->name('create.category');

Route::post('/createcategory', [CategoryController::class, 'create_category'])->name('category.create');

Route::get('/categories', [CategoryController::class, 'show'])->name('categories');

Route::get('/category/{category}/edit', [CategoryController::class, 'show_edit_category'])->name('categoryshow.edit');

Route::put('/category/{category}', [CategoryController::class, 'edit_category'])->name('category.edit');

Route::delete('/category/{category}', [CategoryController::class, 'destroy_category'])->name('category.destroy');

    // loan

    Route::get('/loans', [LoanController::class, 'data_loan'])->name('loans');
    Route::post('/loan/approve/{id}', [AdminController::class, 'approve'])->name('admin.loans.approve');
    Route::post('/loans/reject/{id}', [AdminController::class, 'reject'])->name('admin.loans.reject');
    Route::post('/loans/return/{id}', [AdminController::class, 'return'])->name('admin.loans.return');
    Route::post('/loans/{loan}/update-return-date', [AdminController::class, 'ReturnDate'])->name('admin.loans.updateReturnDate');
    Route::get('loans/export/', [LoanController::class, 'export']);

    // Return

    Route::get('/returns', [ReturnController::class, 'data_return'])->name('returns');
    Route::get('returns/export/', [ReturnController::class, 'export']);

    // Report

    Route::get('/report-users', [UserController::class, 'show_report'])->name('users.report');
    Route::get('/report-items', [ItemController::class, 'show_report'])->name('items.report');
    Route::get('/report-loans', [LoanController::class, 'show_report'])->name('loans.report');
    Route::get('/report-returns', [ReturnController::class, 'show_report'])->name('returns.report');
});

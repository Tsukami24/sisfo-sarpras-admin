<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReturnController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [UserController::class, 'register'])->name('create_user');

Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();
    return response()->json(['message' => 'Logged out successfully']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {

    // category
    Route::get('/category', [ItemController::class, 'category']);

    // item


    // loan
    Route::post('/loan', [LoanController::class, 'create_loan']);
    Route::get('/loans', [LoanController::class, 'loan']);

    // Return
});
Route::get('/item', [ItemController::class, 'item']);
Route::post('/returns', [ReturnController::class, 'return']);



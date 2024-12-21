<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//login
Route::post('/login', [UserController::class, 'login']);

//user/check

Route::post('/user/check', [UserController::class, 'checkUser'])->middleware('auth:sanctum');
//logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
//store
Route::post('/user', [UserController::class, 'store']);
//get user
Route::get('/user/{email}', [UserController::class, 'index']);
//update google id
Route::put('/user/googleid/{id}', [UserController::class, 'updateGoogleId']);
//update user
Route::put('/user/{id}', [UserController::class, 'update']);

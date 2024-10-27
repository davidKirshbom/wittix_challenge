<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('register', UserController::class . '@store');


Route::apiResource('users', UserController::class)->middleware('auth.basic');
Route::apiResource('customers', CustomerController::class)->middleware('auth.basic');
Route::post('login', [UserController::class, 'login']);

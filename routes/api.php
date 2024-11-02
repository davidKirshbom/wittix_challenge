<?php

use App\Actions\CreateUser;
use App\Actions\DeleteUser;
use App\Actions\LoginUser;
use App\Actions\ListUsers;
use Illuminate\Support\Facades\Route;

Route::post('register', CreateUser::class);
Route::post('login', LoginUser::class);
Route::middleware('auth:sanctum')->group(function () {

    Route::delete('users/{id}', DeleteUser::class);
});
Route::get('users', ListUsers::class)->middleware('auth:sanctum');

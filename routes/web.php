<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return  redirect('/login');
});

Route::get('login', function () {

    return Inertia::render('Login');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard')->middleware('auth:sanctum');



Route::get('register', function () {
    return Inertia::render('Register');
})->name('register');

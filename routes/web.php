<?php

use App\Http\Controllers\userAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register',[userAuthController::class , 'register'])->name('user.register');
Route::get('/login',[userAuthController::class , 'login'])->name('login');

Route::post('/register',[userAuthController::class , 'store'])->name('handleUserRegister');
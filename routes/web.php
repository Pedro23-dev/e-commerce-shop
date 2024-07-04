<?php

use App\Http\Controllers\userAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//Indscription
Route::get('/register',[userAuthController::class , 'register'])->name('user.register');
Route::post('/register',[userAuthController::class , 'store'])->name('handleUserRegister');

//Connexion
Route::get('/login', [userAuthController::class, 'login'])->name('user.Login');
Route::post('/login', [userAuthController::class, 'handleLogin'])->name('handleUserLogin');

//Déconnexion
Route::get('/logout', [userAuthController::class, 'handleLogout'])->name('user.logout');

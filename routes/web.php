<?php

use App\Http\Controllers\userAuthController;
use App\Http\Controllers\VendorAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('welcome');
});

// Route::get('/login', [userAuthController::class, 'login'])->name('login');




//les routes qui seront appelées que quand l'utilisateur est en mode invité
Route::middleware('guest')->group(function () {
    Route::get('/register', [userAuthController::class, 'register'])->name('user.register');
    Route::post('/register', [userAuthController::class, 'store'])->name('handleUserRegister');
 

    //Connexion
    Route::get('/login', [userAuthController::class, 'login'])->name('user.Login');
    Route::post('/login', [userAuthController::class, 'handleLogin'])->name('handleUserLogin');

});
//la route qui sera appelée que quand l'utilisateur est connectée
Route::middleware('auth')->group(function () {
    //Déconnexion
    Route::get('/logout', [userAuthController::class, 'handleLogout'])->name('user.logout');
});

//route pour les vendeurs

Route::prefix('vendors/accounts')->group(function () {
    Route::get('/login',[VendorAuthController::class, 'login'])->name('vendors.login'); 
    Route::get('/register',[VendorAuthController::class, 'register'])->name('vendors.register'); 

    Route::post('/login',[VendorAuthController::class, 'handleLogin'])->name('vendors.handleLogin'); 
    Route::post('/register',[VendorAuthController::class, 'handleRegister'])->name('vendors.handleRegister'); 
  
});



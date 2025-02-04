<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\userAuthController;
use App\Http\Controllers\userPaymentController;
use App\Http\Controllers\VendorAuthController;
use App\Http\Controllers\Vendors\VendorDashboard;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;














Route::get('/', [WebsiteController::class, 'vue']);
Route::get('/home', [WebsiteController::class, 'vue']);


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

    Route::get('/articles/order/{id}',[userPaymentController::class, 'initPayment'])->name('order.article');
    //Déconnexion
    Route::get('/logout', [userAuthController::class, 'handleLogout'])->name('user.logout');
});

//route pour les vendeurs avec le prefixe vendors/accounts 
Route::middleware('guest')->prefix('vendors/accounts')->group(function () {
    Route::get('/login',[VendorAuthController::class, 'login'])->name('vendors.login'); 
    Route::get('/register',[VendorAuthController::class, 'register'])->name('vendors.register'); 

    Route::post('/login',[VendorAuthController::class, 'handleLogin'])->name('vendors.handleLogin'); 
    Route::post('/register',[VendorAuthController::class, 'handleRegister'])->name('vendors.handleRegister'); 
  
});

//le middleware qui sera appelé quand le vendeur sera connecté

Route::middleware('vendor')->prefix('vendors/dashboard')->group(function () {
        Route::get('/', [VendorDashboard::class, 'index'])->name('vendors.dashboard');

    Route::prefix('articles')->group(function () {
        Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
        Route::get('/create', [ArticleController::class, 'create'])->name('articles.create');
        Route::post('/create', [ArticleController::class, 'handleCreate'])->name('articles.handleCreate');

    });

    Route::get('payment-configuration', [PaymentController::class,'getAccountInfo'])->name('payment-configuration');
        
    Route::post('handle-payment-configuration', [PaymentController::class,'handleUpdateInfo'])->name('payment.configuration');
        

        Route::get('/logout', [VendorDashboard::class, 'logout'])->name('vendors.logout');
    Route::delete('/article/{article}', [ArticleController::class, "delete"])->name("article.supprimer");
    });
    
// });
// Route::get('/', [VendorDashboard::class, 'index'])->name('vendors.dashboard')->middleware('vendor');
// Route::middleware(['vendor'])->group(function () {
//     Route::get('/', [VendorDashboard::class, 'index'])->name('vendors.dashboard');
    // Vos routes protégées ici





<?php

use App\Http\Controllers\auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::prefix('/auth')->group(function () {
        Route::name('auth.')->group(function () {
            Route::view('/login', 'auth.login')->name('login.view');
            Route::post('/login', LoginController::class)->name('login');
        });
    });
});

<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\HomeController;
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

Route::prefix('/auth')->group(function () {
    Route::name('auth.')->group(function () {
        Route::middleware('guest')->group(function () {
            Route::view('/login', 'auth.login')->name('login.view');
            Route::post('/login', [AuthController::class, 'login'])->name('login');
        });

        Route::middleware('auth')->group(function () {
            Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        });
    });
});

Route::prefix('/admin')->group(function () {
    Route::name('admin.')->group(function () {
        Route::middleware('admin')->group(function () {
            Route::get('/allocation', [AdminController::class, 'allocation'])->name('allocation');
            Route::get('/manage-classes', [AdminController::class, 'manageClasses'])->name('manage-classes');
            Route::get('/manage-students', [AdminController::class, 'manageStudents'])->name('manage-students');
            Route::get('/manage-lecturers', [AdminController::class, 'manageLecturers'])->name('manage-lecturers');
        });
    });
});

Route::permanentRedirect('/', '/home');
Route::get('/home', HomeController::class)->name('home');

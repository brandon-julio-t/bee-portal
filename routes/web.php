<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

Route::prefix('/user')->group(function () {
    Route::name('user.')->group(function () {
        Route::middleware('auth')->group(function () {
            Route::post('/change-semester', [UserController::class, 'changeSemester'])->name('change-semester');
        });
    });
});

Route::prefix('/admin')->group(function () {
    Route::name('admin.')->group(function () {
        Route::middleware('admin')->group(function () {
            Route::get('/allocation', [AdminController::class, 'allocation'])->name('allocation');


            Route::prefix('/manage-classrooms')->group(function () {
                Route::name('manage-classrooms')->group(function () {
                    Route::get('/', [AdminController::class, 'manageClassrooms'])->name('');
                    Route::post('/', [AdminController::class, 'updateOrCreateClassroom'])->name('.update-or-create');
                    Route::delete('/{classroom}', [AdminController::class, 'deleteClassroom'])->name('.delete');
                });
            });


            Route::prefix('/manage-subjects')->group(function () {
                Route::name('manage-subjects')->group(function () {
                    Route::get('/', [AdminController::class, 'manageSubjects'])->name('');
                    Route::post('/', [AdminController::class, 'updateOrCreateSubject'])->name('.update-or-create');
                    Route::delete('/{subject}', [AdminController::class, 'deleteSubject'])->name('.delete');
                });
            });

            Route::get('/manage-lecturers', [AdminController::class, 'manageLecturers'])->name('manage-lecturers');
            Route::get('/manage-students', [AdminController::class, 'manageStudents'])->name('manage-students');
        });
    });
});

Route::permanentRedirect('/', '/home');
Route::get('/home', HomeController::class)->name('home');

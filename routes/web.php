<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassTransactionController;
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

Route::middleware('auth')->group(function () {
    Route::prefix('/user')->group(function () {
        Route::name('user.')->group(function () {
            Route::post('/change-semester', [UserController::class, 'changeSemester'])->name('change-semester');
        });
    });

    Route::prefix('/class-transaction')->group(function () {
        Route::name('class-transaction.')->group(function () {
            Route::get('/', [ClassTransactionController::class, 'index'])->name('index');
            Route::get('/{classTransaction}', [ClassTransactionController::class, 'view'])->name('detail');
        });
    });

    Route::name('general.')->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');  
        Route::get('/courses', [UserController::class, 'courses'])->name('courses');
        Route::get('/forums', [UserController::class, 'forums'])->name('forums');
        Route::get('/schedules', [UserController::class, 'schedules'])->name('schedules');
    });
});

Route::prefix('/admin')->group(function () {
    Route::name('admin.')->group(function () {
        Route::middleware('admin')->group(function () {

            Route::prefix('/allocation')->group(function () {
                Route::name('allocation')->group(function () {
                    Route::get('/', [AdminController::class, 'allocation'])->name('');
                    Route::post('/', [AdminController::class, 'createAllocation'])->name('.create');

                    Route::get('/create', [AdminController::class, 'viewCreateAllocation'])->name('.create.view');

                    Route::get('/update/{classTransaction}', [AdminController::class, 'viewUpdateAllocation'])->name('.update.view');
                    Route::put('/update/{classTransaction}', [AdminController::class, 'updateAllocation'])->name('.update');

                    Route::post('/student-allocation/{classTransaction}', [AdminController::class, 'createStudentAllocation'])->name('.student.create');
                    Route::delete('/student-allocation/{classTransaction}/{user}', [AdminController::class, 'deleteStudentAllocation'])->name('.student.delete');

                    Route::post('/detail-allocation/{classTransaction}', [AdminController::class, 'updateOrCreateDetailAllocation'])->name('.detail.update-or-create');
                    Route::delete('/detail-allocation/{classTransactionDetail}', [AdminController::class, 'deleteDetailAllocation'])->name('.detail.delete');

                    Route::delete('/{classTransaction}', [AdminController::class, 'deleteAllocation'])->name('.delete');
                    Route::post('/restore/{classTransaction}', [AdminController::class, 'restoreAllocation'])->name('.restore');
                });
            });


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

            Route::prefix('/manage-users')->group(function () {
                Route::name('manage-users')->group(function () {
                    Route::post('/', [AdminController::class, 'updateOrCreateUser'])->name('.update-or-create');
                    Route::delete('/{user}', [AdminController::class, 'deleteUser'])->name('.delete');
                    Route::post('/restore/{user}', [AdminController::class, 'restoreUser'])->name('.restore');
                });
            });
        });
    });
});

Route::permanentRedirect('/', '/home')->name('index');
Route::permanentRedirect('/login', '/auth/login')->name('login');
Route::permanentRedirect('/admin', '/');
Route::get('/home', HomeController::class)->name('home');

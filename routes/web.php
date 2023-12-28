<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataSurveyController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Menampilkan form login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');


// Menangani proses login
Route::post('/', [AuthController::class, 'login']);

// Menangani proses logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/datasurvey', [DataSurveyController::class, 'index'])->name('admin.datasurvey');
    
    // data survey
    Route::get('/datasurvey/create', [DataSurveyController::class, 'create'])->name('admin.datasurvey.create');
    Route::post('/datasurvey/store', [DataSurveyController::class, 'store'])->name('admin.datasurvey.store');
    Route::get('/datasurvey/{id}/edit', [DataSurveyController::class, 'edit'])->name('admin.datasurvey.edit');
    Route::put('/datasurvey/{id}/update', [DataSurveyController::class, 'update'])->name('admin.datasurvey.update');
    Route::delete('/datasurvey/{id}/destroy', [DataSurveyController::class, 'destroy'])->name('admin.datasurvey.destroy');
    Route::put('/datasurvey/{id}/setuju', [DataSurveyController::class, 'setuju'])->name('admin.datasurvey.setuju');
    Route::put('/datasurvey/{id}/tolak', [DataSurveyController::class, 'tolak'])->name('admin.datasurvey.tolak');

    // user
    Route::get('/user', [UserController::class, 'index'])->name('admin.user');
    Route::post('/user/store', [UserController::class, 'store'])->name('admin.user.store');
    Route::put('/user/{id}/update', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('/user/{id}/destroy', [UserController::class, 'destroy'])->name('admin.user.destroy');

});
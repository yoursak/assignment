<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;


Route::middleware(['checkLogout'])->group(function () {
    Route::prefix('/login')->group(function () {
        Route::get('/', [LoginController::class, 'index'])->name('login.page');
        Route::post('/authentication', [LoginController::class, 'authenticateUser'])->name('login.authenticateUser');
    });
});

Route::middleware(['checkLogin'])->group(function () {
    Route::get('/', [TaskController::class, 'dashboard'])->name('dashboard');
    Route::prefix('/')->group(function () {
        Route::get('/task', [TaskController::class, 'index'])->name('task.page');
        Route::post('/create-task', [TaskController::class, 'createTask'])->name('task.createTask');
        Route::post('/delete-task', [TaskController::class, 'deleteTask'])->name('task.deleteTask');
        Route::post('/update-task', [TaskController::class, 'updateTask'])->name('task.updateTask');
    });
    Route::prefix('/')->group(function () {
        Route::get('/user', [UserController::class, 'index'])->name('user.page');
        Route::post('/add-user', [UserController::class, 'addNewUser'])->name('user.addNewUser');
        Route::post('/update-user', [UserController::class, 'updateUser'])->name('user.updateUser');
        Route::post('/delete-user', [UserController::class, 'deleteUser'])->name('user.deleteUser');
    });
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});

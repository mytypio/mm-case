<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    // Admin pages
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth', 'role:ROLE_ADMIN']);
    Route::get('/admin/users', [UserController::class, 'index'])->name('user.index')->middleware(['auth', 'role:ROLE_ADMIN']);
    Route::get('/admin/users/{id}', [UserController::class, 'view'])->name('user.view')->middleware(['auth', 'role:ROLE_ADMIN']);

    Route::post('/admin/users/{id}/activate', [UserController::class, 'activate'])->name('user.activate')->middleware(['auth', 'role:ROLE_ADMIN']);
    Route::post('/admin/users/{id}/sync', [UserController::class, 'sync'])->name('user.sync')->middleware(['auth', 'role:ROLE_ADMIN']);
    Route::get('/admin/users/{id}/destroy', [UserController::class, 'destroy'])->name('user.destroy')->middleware(['auth', 'role:ROLE_ADMIN']);

    // User pages
    Route::get('/profile', [ProfileController::class, 'view'])->name('profile.view')->middleware(['auth', 'role:ROLE_USER']);
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware(['auth', 'role:ROLE_USER']);
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware(['auth', 'role:ROLE_USER']);
});

require __DIR__.'/auth.php';

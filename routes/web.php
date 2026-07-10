<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskKategoriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

// Redirect root to task-kategori
Route::get('/', function () {
    return redirect('/task-kategori');
});

Route::middleware('auth')->group(function () {
    // Dashboard route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Task Kategori Routes
    Route::get('/task-kategori', [TaskKategoriController::class, 'index'])->name('task_kategori.index');
    Route::post('/task-kategori/status', [TaskKategoriController::class, 'storeStatus'])->name('task_kategori.storeStatus');
    Route::post('/task-kategori/priority', [TaskKategoriController::class, 'storePriority'])->name('task_kategori.storePriority');
    Route::put('/task-kategori/status/{id}', [TaskKategoriController::class, 'updateStatus'])->name('task_kategori.updateStatus');
    Route::put('/task-kategori/priority/{id}', [TaskKategoriController::class, 'updatePriority'])->name('task_kategori.updatePriority');
    Route::delete('/task-kategori/status/{id}', [TaskKategoriController::class, 'destroyStatus'])->name('task_kategori.destroyStatus');
    Route::delete('/task-kategori/priority/{id}', [TaskKategoriController::class, 'destroyPriority'])->name('task_kategori.destroyPriority');

    // Task Views
    Route::get('/my-task', function () {
        return view('mytask');
    })->name('my_task');

    Route::get('/vital-task', function () {
        return view('vitaltask');
    })->name('vital_task');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
    Route::get('/account-info', [ProfileController::class, 'showAccountInfo'])->name('account.info');
    Route::post('/account-info', [ProfileController::class, 'updateAccountInfo'])->name('account.info.update');
    Route::get('/change-password', [ProfileController::class, 'showChangePassword'])->name('change.password');
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('change.password.post');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', function () {
        return view('register');
    })->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
});

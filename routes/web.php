<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskKategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Task CRUD Routes
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
Route::patch('/tasks/{task}/priority', [TaskController::class, 'updatePriority'])->name('tasks.updatePriority');

Route::get('/task-kategori', [TaskKategoriController::class, 'index'])->name('task_kategori.index');
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/register', function () {
    return view('register');
})->name('register');
Route::post('/task-kategori/status', [TaskKategoriController::class, 'storeStatus'])->name('task_kategori.storeStatus');
Route::post('/task-kategori/priority', [TaskKategoriController::class, 'storePriority'])->name('task_kategori.storePriority');
Route::put('/task-kategori/status/{id}', [TaskKategoriController::class, 'updateStatus'])->name('task_kategori.updateStatus');
Route::put('/task-kategori/priority/{id}', [TaskKategoriController::class, 'updatePriority'])->name('task_kategori.updatePriority');
Route::delete('/task-kategori/status/{id}', [TaskKategoriController::class, 'destroyStatus'])->name('task_kategori.destroyStatus');
Route::delete('/task-kategori/priority/{id}', [TaskKategoriController::class, 'destroyPriority'])->name('task_kategori.destroyPriority');
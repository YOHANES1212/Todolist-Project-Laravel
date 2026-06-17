<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskKategoriController;

Route::get('/', function () {
    return redirect('/task-kategori');
});

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
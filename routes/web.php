<?php

use App\Http\Controllers\ProfileController;
use \App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['true'])->group(function () {
    Route::resource('tasks',TaskController::class);
});
Route::middleware(['true'])->group(function () {
    Route::resource('type',TypeController::class);
});
Route::get('/user/tasks', [TaskController::class, 'indexuser'])->name('user.tasks.index');
Route::put('/tasks/{id}/status', [TaskController::class, 'updatecompleted'])->name('tasks.status.update');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

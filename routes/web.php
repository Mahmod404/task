<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\CheckIfManager;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('departments', DepartmentController::class)->middleware('auth');

Route::controller(TaskController::class)->middleware('auth')->group(function () {
    Route::get('/tasks', 'index')->name('tasks.index');
    Route::get('/tasks/create', 'create')->name('tasks.create')->middleware(CheckIfManager::class);
    Route::post('/tasks', 'store')->name('tasks.store')->middleware(CheckIfManager::class);
    Route::get('/tasks/{task}', 'show')->name('tasks.show');
    Route::get('/tasks/{task}/edit', 'edit')->name('tasks.edit')->middleware(CheckIfManager::class);
    Route::patch('/tasks/{task}', 'update')->name('tasks.update')->middleware(CheckIfManager::class);
    Route::delete('/tasks/{task}', 'destroy')->name('tasks.destroy')->middleware(CheckIfManager::class);
    Route::patch('/tasks/{task}/complete', [TaskController::class, 'completeTask'])->name('tasks.complete');
});

require __DIR__ . '/auth.php';
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');

Route::middleware('auth')->group(function () {

    Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    
});
//Route::resource('tasks', TaskController::class)->middleware('auth');
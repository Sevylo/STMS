<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $totalTasks = \Illuminate\Support\Facades\Auth::user()->tasks()->count();
        $pendingTasks = \Illuminate\Support\Facades\Auth::user()->tasks()->where('status', 'pending')->count();
        $completedTasks = \Illuminate\Support\Facades\Auth::user()->tasks()->where('status', 'completed')->count();
        return view('dashboard', compact('totalTasks', 'pendingTasks', 'completedTasks'));
    })->name('dashboard');

    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::get('/notifications/read', [TaskController::class, 'markNotificationsRead'])->name('notifications.markAsRead');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update'); // Changed to put to match controller validation
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::patch('/tasks/{task}/toggle', [TaskController::class, 'togglestatus'])->name('tasks.toggle');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

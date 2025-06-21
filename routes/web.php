<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('ledingweb');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test', function () {
    return 'Test route is working!';
})->middleware(['auth', 'verified'])->name('test');

require __DIR__.'/auth.php';


// Only users with 'admin' role
Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return 'Admin Dashboard';
    });
    Route::get('/admin/users', function () {
        return 'Manage Users';
    });
});

// Only users with 'user' role
Route::middleware(['role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return 'User Dashboard';
    });
});

// Only users with 'edit schedule' permission
Route::middleware(['permission:edit schedule'])->group(function () {
    Route::get('/schedule/edit', function () {
        return 'Edit Schedule';
    });
});

// Only users with 'view schedule' permission
Route::middleware(['permission:view schedule'])->group(function () {
    Route::get('/schedule/view', function () {
        return 'View Schedule';
    });
});
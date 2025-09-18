<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SchedulingsController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\LaporanPraktikumController;
use App\Http\Controllers\LandingSertifikatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


// Route::get('/dashboard', function () {
//     return view('rapihin.dashboard2');
// })->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/kalab', action: [KalabDashboardController::class, 'index'])->name('kalab.dashboard');

Route::get('/', function () {
    return view('landing.home');
});

Route::get('/jadwal', function () {
    return view('landing.partials.schedule');
})->name('jadwal.index');



Route::get('/laprak/{laprak}/certificates', [LaporanPraktikumController::class, 'certificates'])->name('laprak.certificates');
Route::get('/certificate/result', [SertifikatController::class, 'result'])->name('certificate.result');

Route::prefix('sertifikat')->group(function () {
    Route::get('/', [LandingSertifikatController::class, 'index'])->name('sertifikat.index');
    Route::get('/filter', [LandingSertifikatController::class, 'filter'])->name('sertifikat.filter');
});

// Route::prefix('jadwal')->group(function () {
//     Route::get('/', [LandingSertifikatController::class, 'index'])->name('jadwal.index');
//     Route::get('/filter', [LandingSertifikatController::class, 'filter'])->name('jadwal.filter');
// });



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // profile Routes
    Route::prefix('profile')->group(function (){
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // schedulings Routes
    Route::prefix('schedulings')->group(function () {
        Route::get('/', [SchedulingsController::class, 'index'])->name('scheduling.index');
        Route::get('/create', [SchedulingsController::class, 'create'])->name('schedulings.create');
        Route::post('/', [SchedulingsController::class, 'store'])->name('schedulings.store');
        Route::get('/{id}', [SchedulingsController::class, 'show'])->name('schedulings.show');
        Route::get('/{id}/edit', [SchedulingsController::class, 'edit'])->name('schedulings.edit'); // untuk tampilkan form edit
        Route::put('/{id}', [SchedulingsController::class, 'update'])->name('schedulings.update');  // untuk simpan hasil edit
        Route::delete('/{id}', [SchedulingsController::class, 'destroy'])->name('schedulings.destroy');
    });

    // Roles Routes
    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/{id}', [RoleController::class, 'show'])->name('roles.show');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::put('/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    });

    // Users Routes
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [RegisteredUserController::class, 'create'])->name('users.create');
        Route::post('/create', [RegisteredUserController::class, 'store'])->name('users.store');
        Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Documentation Routes
    Route::prefix('schedulings/documentation')->group(function () {
        Route::get('/', [DocumentationController::class, 'index'])->name('documentation.index');
        Route::get('/create/{scheduling_id}', [DocumentationController::class, 'create'])->name('documentations.create');
        Route::post('/', [DocumentationController::class, 'store'])->name('documentations.store');
        Route::get('/{id}', [DocumentationController::class, 'show'])->name('documentations.show');
        Route::get('/{id}/edit', [DocumentationController::class, 'edit'])->name('documentations.edit');
        Route::put('/{id}', [DocumentationController::class, 'update'])->name('documentations.update');
        Route::delete('/{id}', [DocumentationController::class, 'destroy'])->name('documentations.destroy');
    });

    // Certificate Routes
    Route::prefix('certificate')->group(function () {
        Route::get('/create/{laprakId}', [SertifikatController::class, 'create'])->name('certificate.create');
        Route::post('/', [SertifikatController::class, 'store'])->name('certificate.store');
    });

    // Laporan Pratikum Routes
    Route::prefix('laporan-praktikum')->group(function () {
        Route::get('/', [LaporanPraktikumController::class, 'index'])->name('laprak.index');
        Route::get('/create', [LaporanPraktikumController::class, 'create'])->name('laprak.create');
        Route::post('/', [LaporanPraktikumController::class, 'store'])->name('laprak.store');
        Route::get('/{id}', [LaporanPraktikumController::class, 'show'])->name('laprak.show');
        Route::get('/{id}/edit', [LaporanPraktikumController::class, 'edit'])->name('laprak.edit');
        Route::put('/{id}', [LaporanPraktikumController::class, 'update'])->name('laprak.update');
        Route::delete('/{id}', [LaporanPraktikumController::class, 'destroy'])->name('laprak.destroy');
    });

    // Template Sertifikat Routes
    Route::prefix('template')->group(function () {
        Route::get('/', [TemplateController::class, 'index'])->name('template.index');
        Route::get('/create', [TemplateController::class, 'templateForm'])->name('template.create');
        Route::post('/store', [TemplateController::class, 'storeTemplate'])->name('template.store');
        Route::get('/{id}', [TemplateController::class, 'show'])->name('template.show');
        Route::get('/{id}/edit', [TemplateController::class, 'edit'])->name('template.edit');
        Route::put('/{id}', [TemplateController::class, 'update'])->name('template.update');
        Route::delete('/{id}', [TemplateController::class, 'destroy'])->name('template.destroy');
    });

});


require __DIR__.'/auth.php';


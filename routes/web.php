<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SchedulingsController;
use App\Http\Controllers\DocumentationController;
use Illuminate\Support\Facades\Route;

// Route::redirect('/', '/login');
// Route::get('/home', function () {
//     if (session('status')) {
//         return redirect()->route('admin.home')->with('status', session('status'));
//     }

//     return redirect()->route('admin.home');
// });



// Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
//     Route::get('/', 'HomeController@index')->name('home');
//     // Permissions
//     Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
//     Route::resource('permissions', 'PermissionsController');

//     // Roles
//     Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
//     Route::resource('roles', 'RolesController');

//     // Users
//     Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
//     Route::resource('users', 'UsersController');

//     // Rooms
//     Route::delete('rooms/destroy', 'RoomsController@massDestroy')->name('rooms.massDestroy');
//     Route::resource('rooms', 'RoomsController');

//     // Events
//     Route::delete('events/destroy', 'EventsController@massDestroy')->name('events.massDestroy');
//     Route::resource('events', 'EventsController');

//     Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');

//     Route::get('search-room', 'BookingsController@searchRoom')->name('searchRoom');
//     Route::post('book-room', 'BookingsController@bookRoom')->name('bookRoom');

//     Route::get('my-credits', 'BalanceController@index')->name('balance.index');
//     Route::post('add-balance', 'BalanceController@add')->name('balance.add');

//     Route::resource('transactions', 'TransactionsController')->only(['index']);
// });


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////


Route::get('/', function () {
    return view('ledingweb');
});

// Route::get('/dashboard', function () {
//     return view('rapihin.dashboard2');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/roles', [RolesController::class, 'index'])->middleware(['auth', 'verified'])->name('roles.index');
Route::get('/role-create', [RolesController::class, 'create'])->middleware(['auth', 'verified'])->name('roles.create');

Route::get('/users', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('user.index');
Route::get('/user-create', [UserController::class, 'create'])->middleware(['auth', 'verified'])->name('user.create');

// scheduling Routes
Route::prefix('scheduling')->group(function () {
    Route::get('/', [SchedulingsController::class, 'index'])->middleware(['auth', 'verified'])->name('scheduling.index');
    Route::get('/create', [SchedulingsController::class, 'create'])->middleware(['auth', 'verified'])->name('schedulings.create');
    Route::post('/', [SchedulingsController::class, 'store'])->middleware(['auth', 'verified'])->name('schedulings.store');
    Route::get('/{id}', [SchedulingsController::class, 'show'])->middleware(['auth', 'verified'])->name('schedulings.show');
    Route::get('/{id}/edit', [SchedulingsController::class, 'edit'])->middleware(['auth', 'verified'])->name('schedulings.edit'); // untuk tampilkan form edit
    Route::put('/{id}', [SchedulingsController::class, 'update'])->middleware(['auth', 'verified'])->name('schedulings.update');  // untuk simpan hasil edit
    Route::delete('/{id}', [SchedulingsController::class, 'destroy'])->middleware(['auth', 'verified'])->name('schedulings.destroy');
});

// Documentation Routes
Route::prefix('documentation')->group(function () {
    Route::get('/', [DocumentationController::class, 'index'])->middleware(['auth', 'verified'])->name('documentation.index');
    Route::get('/create/{scheduling_id}', [DocumentationController::class, 'create'])->middleware(['auth', 'verified'])->name('documentations.create');
    Route::post('/', [DocumentationController::class, 'store'])->middleware(['auth', 'verified'])->name('documentations.store');
    Route::get('/{id}', [DocumentationController::class, 'show'])->middleware(['auth', 'verified'])->name('documentations.show');
    Route::get('/{id}/edit', [DocumentationController::class, 'edit'])->middleware(['auth', 'verified'])->name('documentations.edit');
    Route::put('/{id}', [DocumentationController::class, 'update'])->middleware(['auth', 'verified'])->name('documentations.update');
    Route::delete('/{id}', [DocumentationController::class, 'destroy'])->middleware(['auth', 'verified'])->name('documentations.destroy');
});


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
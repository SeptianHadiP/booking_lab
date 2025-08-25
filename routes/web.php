<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SchedulingsController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\LaporanPraktikumController;
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

// Route::get('/users', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('user.index');
// Route::get('/user-create', [UserController::class, 'create'])->middleware(['auth', 'verified'])->name('user.create');


// Route::prefix('scheduling')->group(function () {
//     Route::middleware('permission:read scheduling')->get('/', [SchedulingsController::class, 'index'])->name('schedulings.index');
//     Route::middleware('permission:create scheduling')->get('/create', [SchedulingsController::class, 'create'])->name('schedulings.create');
//     Route::middleware('permission:create scheduling')->post('/', [SchedulingsController::class, 'store'])->name('schedulings.store');
//     Route::middleware('permission:read scheduling')->get('/{id}', [SchedulingsController::class, 'show'])->name('schedulings.show');
//     Route::middleware('permission:update scheduling')->get('/{id}/edit', [SchedulingsController::class, 'edit'])->name('schedulings.edit');
//     Route::middleware('permission:update scheduling')->put('/{id}', [SchedulingsController::class, 'update'])->name('schedulings.update');
//     Route::middleware('permission:delete scheduling')->delete('/{id}', [SchedulingsController::class, 'destroy'])->name('schedulings.destroy');
// });

// Route::middleware('role:kalab')->prefix('user-role')->group(function () {
//     Route::get('/', [UserRoleController::class, 'index'])->name('user-role.index');
//     Route::get('/{user}/edit', [UserRoleController::class, 'edit'])->name('user-role.edit');
//     Route::put('/{user}', [UserRoleController::class, 'update'])->name('user-role.update');
// });


// Route::middleware(['role:kalab'])->prefix('roles')->group(function () {
//     Route::get('/', [RoleController::class, 'index'])->name('roles.index');
//     Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
//     Route::post('/', [RoleController::class, 'store'])->name('roles.store');
//     Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
//     Route::put('/{role}', [RoleController::class, 'update'])->name('roles.update');
//     Route::delete('/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
// });


// Route::middleware(['auth', 'role:kalab'])->prefix('permissions')->group(function () {
//     Route::get('/', [PermissionController::class, 'index'])->name('permissions.index');
//     Route::get('/create', [PermissionController::class, 'create'])->name('permissions.create');
//     Route::post('/', [PermissionController::class, 'store'])->name('permissions.store');
//     Route::get('/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
//     Route::put('/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
//     Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
// });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // schedulings Routes
    Route::prefix('schedulings')->middleware(['auth', 'verified'])->group(function () {
        Route::get('/', [SchedulingsController::class, 'index'])->name('scheduling.index');
        Route::get('/create', [SchedulingsController::class, 'create'])->name('schedulings.create');
        Route::post('/', [SchedulingsController::class, 'store'])->name('schedulings.store');
        Route::get('/{id}', [SchedulingsController::class, 'show'])->name('schedulings.show');
        Route::get('/{id}/edit', [SchedulingsController::class, 'edit'])->name('schedulings.edit'); // untuk tampilkan form edit
        Route::put('/{id}', [SchedulingsController::class, 'update'])->name('schedulings.update');  // untuk simpan hasil edit
        Route::delete('/{id}', [SchedulingsController::class, 'destroy'])->name('schedulings.destroy');
    });

    // Roles Routes
    Route::prefix('roles')->middleware(['auth', 'verified'])->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/{id}', [RoleController::class, 'show'])->name('roles.show');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::put('/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    });

    // Users Routes
    Route::prefix('users')->middleware(['auth', 'verified'])->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [RegisteredUserController::class, 'create'])->name('users.create');
        Route::post('/create', [RegisteredUserController::class, 'store'])->name('users.store');
        Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Documentation Routes
    Route::prefix('documentation')->middleware(['auth', 'verified'])->group(function () {
        Route::get('/', [DocumentationController::class, 'index'])->name('documentation.index');
        Route::get('/create/{scheduling_id}', [DocumentationController::class, 'create'])->name('documentations.create');
        Route::post('/', [DocumentationController::class, 'store'])->name('documentations.store');
        Route::get('/{id}', [DocumentationController::class, 'show'])->name('documentations.show');
        Route::get('/{id}/edit', [DocumentationController::class, 'edit'])->name('documentations.edit');
        Route::put('/{id}', [DocumentationController::class, 'update'])->name('documentations.update');
        Route::delete('/{id}', [DocumentationController::class, 'destroy'])->middleware(['auth', 'verified'])->name('documentations.destroy');
    });

    Route::prefix('certificate')->middleware(['auth', 'verified'])->group(function () {
        Route::get('/', [CertificateController::class, 'form'])->name('certificate.create');
        Route::post('/', [CertificateController::class, 'generate'])->name('generate.certificates');
    });
    Route::prefix('laporan-praktikum')->middleware(['auth', 'verified'])->group(function () {
        Route::get('/', [LaporanPraktikumController::class, 'create'])->name('laprak.create');
        Route::post('/', [LaporanPraktikumController::class, 'store'])->name('laprak.store');
        Route::delete('/{id}', [LaporanPraktikumController::class, 'destroy'])->name('laprak.destroy');
        // Route::get('/', [LaporanController::class, 'index'])->name('laporan.index');
        // Route::get('/create', [LaporanController::class, 'create'])->name('laporan.create');
        // Route::post('/store', [LaporanController::class, 'store'])->name('laporan.store');
    });
    Route::prefix('template')->middleware(['auth', 'verified'])->group(function () {
        Route::get('/', [TemplateController::class, 'index'])->name('template.index');
        Route::get('/create', [TemplateController::class, 'templateForm'])->name('template.create');
        Route::post('/store', [TemplateController::class, 'storeTemplate'])->name('template.store');
        Route::get('/{id}', [TemplateController::class, 'show'])->name('template.show');
        Route::get('/{id}/edit', [TemplateController::class, 'edit'])->name('template.edit');
        Route::put('/{id}', [TemplateController::class, 'update'])->name('template.update');
        Route::delete('/{id}', [TemplateController::class, 'destroy'])->middleware(['auth', 'verified'])->name('template.destroy');
    });

});


require __DIR__.'/auth.php';

// Route::middleware('role:kalab')->prefix('roles')->group(function () {
//     Route::get('/', [RoleController::class, 'index'])->name('roles.index');
//     Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
//     Route::post('/', [RoleController::class, 'store'])->name('roles.store');
// });


// Route::prefix('roles')->middleware(['auth', 'verified'])->group(function () {
//     Route::get('/', [RoleController::class, 'index'])->name('roles.index');
//     Route::get('/create/{scheduling_id}', [RoleController::class, 'create'])->name('roles.create');
//     Route::post('/', [RoleController::class, 'store'])->name('roles.store');
//     Route::get('/{id}', [RoleController::class, 'show'])->name('roles.show');
//     Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
//     Route::put('/{id}', [RoleController::class, 'update'])->name('roles.update');
//     Route::delete('/{id}', [RoleController::class, 'destroy'])->middleware(['auth', 'verified'])->name('roles.destroy');
// });

// Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
// Route::get('/role-create', [RoleController::class, 'create'])->name('roles.create');

// Route::middleware(['role:kalab'])->group(function () {
//     Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
//     Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
//     Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
//     Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
// });
// Route::get('/test', function () {
//     return 'Test route is working!';
// })->middleware(['auth', 'verified'])->name('test');

// require __DIR__.'/auth.php';


// Only users with 'admin' role
// Route::middleware(['role:admin'])->group(function () {
//     Route::get('/admin/dashboard', function () {
//         return 'Admin Dashboard';
//     });
//     Route::get('/admin/users', function () {
//         return 'Manage Users';
//     });
// });

// Only users with 'user' role
// Route::middleware(['role:user'])->group(function () {
//     Route::get('/user/dashboard', function () {
//         return 'User Dashboard';
//     });
// });

// Only users with 'edit schedule' permission
// Route::middleware(['permission:edit schedule'])->group(function () {
//     Route::get('/schedule/edit', function () {
//         return 'Edit Schedule';
//     });
// });

// Only users with 'view schedule' permission
// Route::middleware(['permission:view schedule'])->group(function () {
//     Route::get('/schedule/view', function () {
//         return 'View Schedule';
//     });
// });

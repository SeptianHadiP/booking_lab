<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SchedulesController;
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
    return view('welcome');
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

Route::get('/schedules', [SchedulesController::class, 'index'])->middleware(['auth', 'verified'])->name('schedule.index');
Route::get('/schedule-create', [SchedulesController::class, 'create'])->middleware(['auth', 'verified'])->name('schedule.create');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test', function () {
    return 'Test route is working!';
})->middleware(['auth', 'verified'])->name('test');

require __DIR__.'/auth.php';

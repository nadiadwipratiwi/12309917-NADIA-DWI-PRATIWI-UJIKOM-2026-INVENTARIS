<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\DashboardController;
use App\Exports\ItemExport;        
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('landing');
});

Route::get('/export-item', function () {
    return Excel::download(new ItemExport, 'items.xlsx');
})->name('export.item');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/staff/dashboard', [DashboardController::class, 'index'])->name('staff.dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('checkrole:admin')->group(function () {
        Route::post('/users/{id}/reset', [UserController::class, 'reset'])->name('users.reset');
        Route::get('/users-admin', [UserController::class, 'indexAdmin'])->name('users.admin');
        Route::get('/users-staff', [UserController::class, 'indexStaff'])->name('users.staff');
        Route::get('/users-admin/create', [UserController::class, 'createAdmin'])->name('users.admin.create');
        Route::get('/users-staff/create', [UserController::class, 'createStaff'])->name('users.staff.create');

        Route::resource('categories', CategoryController::class);
        Route::resource('items', ItemController::class);
        Route::resource('users', UserController::class);

        Route::get('/admin/lending-detail/{item_id}', [LendingController::class, 'show'])->name('items.detail');
    });
        
        Route::middleware('checkrole:staff')->group(function () {
            Route::resource('lendings', LendingController::class);
            Route::get('/staff/items-list', [ItemController::class, 'showItemStaff'])->name('staff.items.index');
            Route::get('/staff/users/{id}/edit', [UserController::class, 'editStaff'])->name('staff.users.edit');
            Route::put('/staff/users/{id}', [UserController::class, 'updateStaff'])->name('staff.users.update');
        });
});

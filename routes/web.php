<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('login'));
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::middleware('auth')->group(function () {
    // Role Routes
    Route::resource('role', RoleController::class)->middleware('role:admin');
    Route::post('/role/{role}/assign/perm', [RoleController::class, 'givePermission'])->name('role.assign.perm');
    Route::delete('/role/{role}/revoke/perm/{permission}', [RoleController::class, 'revokePermission'])->name('role.revoke.perm');

    // Permission Routes
    Route::resource('permission', PermissionController::class)->middleware('role:admin');

    // Users Routes
    Route::resource('/users', UserController::class)->middleware('role:admin');
    Route::post('/users/{user}/assign/role', [UserController::class, 'giveRole'])->name('users.assign.role');
    Route::delete('/users/{user}/revoke/role/{role}', [UserController::class, 'revokeRole'])->name('users.revoke.role');

    // Profile Routes
    Route::resource('/profile', ProfileController::class);

    // Inventory Routes
    Route::resource('/product', ProductController::class)->middleware('role:admin|csr|rider');
    Route::delete('/product/{product}/removeImage', [ProductController::class, 'destroyImage'])->name('product.destroyImage');
})->middleware(['auth', 'verified']);

// Route::get('/buttons/icon', function () {
//     return view('buttons-showcase.icon');
// })->middleware(['auth'])->name('buttons.icon');

// Route::get('/buttons/text-icon', function () {
//     return view('buttons-showcase.text-icon');
// })->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';

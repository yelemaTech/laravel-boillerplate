<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InitController;
use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// app initialisation (first user creation)
Route::get('/init', [InitController::class, 'initView'])->name('init.get');
Route::post('/init', [InitController::class, 'init'])->name('init.post');

// Manage user roles & permissions
Route::get('/manager/role-et-permissions', [ManagerController::class, 'managerView'])->name('manager.index');
Route::post('/manager/store-role', [ManagerController::class, 'storeRole'])->name('manager.store.role');
Route::post('/manager/store-permissions', [ManagerController::class, 'storePermission'])->name('manager.store.permission');

Route::get('/manager/role/{role}/details', [ManagerController::class, 'showRole'])->name('manager.show.role');
Route::patch('/manager/role/{role}/attach-permission', [ManagerController::class, 'attachPermission'])->name('manager.role.attach.permission');


require __DIR__.'/auth.php';

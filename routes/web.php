<?php

use App\Http\Controllers\Auth\AdminAuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResidentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('residents.home');
});


Route::get('/', function () {
    return view('residents.home');
})->middleware(['auth', 'verified']);

Route::middleware(['auth', 'role:resident,official'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Admin
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthenticatedSessionController::class, 'create'])->name('admin.login');

    Route::post('/login', [AdminAuthenticatedSessionController::class, 'store'])->name('admin.login.store');

    //Protected Routes
    Route::middleware(['auth', 'role:official'])->group( function () {
        Route::get('',function () {
            return view('admins.dashboard');
        })->name('admin.dashboard');

        Route::get('/residents',[ResidentController::class, 'create'])->name('admin.residents');
        
    });
});

require __DIR__.'/auth.php';

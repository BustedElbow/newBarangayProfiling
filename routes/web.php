<?php

use App\Http\Controllers\Auth\AdminAuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\ResidentProfileController;
use App\Http\Controllers\OfficialController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\HouseHoldController;
use App\Http\Controllers\Auth\RegisteredResidentController;
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
})->name('resident.home');


Route::middleware(['auth:resident', 'role:resident,official'])->group(function () {
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

        Route::get('/dashboard',function () {
            return view('admins.dashboard');
        })->name('admin.dashboard');

        Route::get('/residents', [ResidentController::class, 'create'])->name('admin.residents');

        Route::get('/residents/{resident}', [ResidentProfileController::class, 'create'])->name('admin.resident.profile');

        Route::patch('/residents/{resident}', [ResidentProfileController::class, 'update'])->name('admin.resident.update');

        Route::get('/households', [HouseHoldController::class, 'create'])->name('admin.households');
        
        Route::get('/officials', [OfficialController::class, 'create'])->name('admin.officials');

        Route::get('/events', [EventController::class, 'create'])->name('admin.events');

        Route::get('/services', [ServicesController::class, 'create'])->name('admin.services');

        Route::put('/resident/{relation}/edit-relationship', [ResidentProfileController::class, 'editRelationship'])->name('admin.resident.editRelationship');
        Route::delete('/resident/{relation}/delete-relatinship', [ResidentProfileController::class, 'deleteRelationship'])->name('admin.resident.deleteRelationship');
        Route::post('/resident/{resident}/add-relationship', [ResidentProfileController::class, 'storeRelationship'])->name('admin.resident.addRelationship');
    });
});

Route::get('/fetchresidents', [ResidentController::class, 'fetchResidents']);
Route::get('/fetchhouseholds', [HouseHoldController::class, 'fetchHouseholds']);

require __DIR__ . '/auth.php';

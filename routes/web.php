<?php

use App\Http\Controllers\Auth\AdminAuthenticatedSessionController;
use App\Http\Controllers\BrgyClearanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\ResidentProfileController;
use App\Http\Controllers\OfficialController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\HouseHoldController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('resident.home');


Route::middleware(['auth:resident'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/profile', [BrgyClearanceController::class, 'store'])->name('clearance.request');
});

//Admin
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthenticatedSessionController::class, 'create'])->name('admin.login');

    Route::post('/login', [AdminAuthenticatedSessionController::class, 'store'])->name('admin.login.store');

    //Protected Routes
    Route::middleware(['auth:official'])->group( function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        
        Route::get('/residents',[ResidentController::class, 'create'])->name('admin.residents');
        
        Route::get('/residents/{residentId}', [ResidentProfileController::class, 'create'])->name('admin.resident.profile');

        Route::patch('/residents/{resident}', [ResidentProfileController::class, 'update'])->name('admin.resident.update');

        Route::get('/households', [HouseHoldController::class, 'create'])->name('admin.households');
        Route::get('/households/{household}', [HouseholdController::class, 'show'])
        ->name('admin.household.show');
        
        Route::get('/officials', [OfficialController::class, 'create'])->name('admin.officials');

        Route::get('/events', [EventController::class, 'create'])->name('admin.events');

        Route::get('/clearances', [BrgyClearanceController::class, 'index'])->name('admin.clearances');

        Route::put('/resident/{relation}/edit-relationship', [ResidentProfileController::class, 'editRelationship'])->name('admin.resident.editRelationship');
        Route::delete('/resident/{relation}/delete-relatinship', [ResidentProfileController::class, 'deleteRelationship'])->name('admin.resident.deleteRelationship');
        Route::post('/admin/resident/{resident}/relationships', [ResidentProfileController::class, 'storeRelationship'])
        ->name('admin.resident.storeRelationship');

        Route::patch('/residents/{resident}/update-household', [ResidentProfileController::class, 'updateHousehold'])
        ->name('admin.resident.updateHousehold');
        Route::delete('/residents/{resident}/leave-household', [ResidentProfileController::class, 'leaveHousehold'])
        ->name('admin.resident.leaveHousehold');

        Route::post('/officials', [OfficialController::class, 'store'])->name('admin.officials.store');

        Route::post('/officials/puroks', [OfficialController::class, 'storePurok'])->name('admin.puroks.store');
        Route::put('/officials/puroks/{purok}', [OfficialController::class, 'updatePurok'])->name('admin.puroks.update');

        Route::post('/clearances/{clearance}/status', [BrgyClearanceController::class, 'updateStatus'])
        ->name('clearances.updateStatus');

        Route::patch('/clearances/{clearance}/approve', [BrgyClearanceController::class, 'approve'])->name('clearances.approve');
        Route::patch('/clearances/{clearance}/for-claim', [BrgyClearanceController::class, 'markForClaim'])->name('clearances.forClaim');
        Route::patch('/clearances/{clearance}/claim', [BrgyClearanceController::class, 'markAsClaimed'])->name('clearances.claim');
        Route::patch('/clearances/{clearance}/reject', [BrgyClearanceController::class, 'reject']);
        
    });
});

Route::get('/fetchresidents', [ResidentController::class, 'fetchResidents']);
Route::get('/fetchhouseholds', [HouseHoldController::class, 'fetchHouseholds']);

require __DIR__ . '/auth.php';

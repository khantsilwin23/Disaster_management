<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\IncidentController;

// Home route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Removed guest middleware from these routes
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    
    // Dashboard redirection
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    })->name('dashboard');
    
    // Map routes
    Route::get('/map', [MapController::class, 'show'])->name('map');
    Route::get('/api/map-data', [MapController::class, 'riskData'])->name('api.map-data');
    Route::get('/incident/map/{id}', [IncidentController::class, 'show'])->name('incident.map');

    Route::get('/incident/map-data', [IncidentController::class, 'riskData'])->name('incident.api.map-data');

    
    // Admin routes
    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        

        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/incidents', [AdminController::class, 'incidents'])->name('admin.incidents');
        Route::get('/resources', [AdminController::class, 'resources'])->name('admin.resources');
        Route::get('/hazards', [AdminController::class, 'hazards'])->name('admin.hazards');
        // routes/web.php

       


        

        

    });
    
    // User routes
    Route::prefix('user')->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
        Route::get('/report', [UserController::class, 'reportIncident'])->name('user.report');
        Route::post('/report', [UserController::class, 'storeIncident'])->name('user.storeIncident');
        Route::get('/incidents', [UserController::class, 'myIncidents'])->name('user.incidents');
        Route::get('/safety-tips', [UserController::class, 'safetyTips'])->name('user.safety-tips');
        Route::get('/user/alerts', [UserController::class, 'myAlerts'])->name('user.alerts');
    });
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
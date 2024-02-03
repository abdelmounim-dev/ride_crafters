<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // Routes accessible only by authenticated users

    // Trip Routes
    Route::apiResource('trips', TripController::class);
    Route::post('/trips', [TripController::class, 'store']);
    Route::get('/trips/{trips}', [TripController::class, 'show']);
    Route::post('/trips/{trips}/accept', [TripController::class, 'accept']);
    Route::post('/trips/{trips}/start', [TripController::class, 'start']);
    Route::post('/trips/{trips}/end', [TripController::class, 'end']);
    Route::post('/trips/{trips}/location', [TripController::class, 'location']);

    Route::apiResource('/locations', LocationController::class);
    // Route::apiResource('/reservations', ReservationController::class);

    // Driver Routes
    Route::get('/driver', [DriverController::class, 'show']);
    Route::post('/driver', [DriverController::class, 'update']);
});


//Auth Routes
Route::post("/register", [AuthController::class, 'register']);
Route::post("/login", [AuthController::class, 'login']);

// Admin Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/api/admin/trips', [AdminController::class, 'showAllTrips']);
    Route::delete('/api/admin/trips/{id}', [AdminController::class, 'deleteTrip']);
    Route::delete('/api/admin/users/{id}', [AdminController::class, 'deleteUser']);
    Route::get('/api/admin/drivers', [AdminController::class, 'showAllDrivers']);
    Route::put('/api/admin/users/{id}/assign-admin', [AdminController::class, 'assignAdmin']);
});

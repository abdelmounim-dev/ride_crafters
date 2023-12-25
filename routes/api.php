<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripController;
use App\Http\Controllers\LocationController;

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
    
Route::apiResource('trips', TripController::class);
Route::post('/api/trips', [TripController::class, 'store']);
Route::get('/api/trips/{trips}', [TripController::class, 'show']);
Route::post('/api/trips/{trips}/accept', [TripController::class, 'accept']);
Route::post('/api/trips/{trips}/start', [TripController::class, 'start']);
Route::post('/api/trips/{trips}/end', [TripController::class, 'end']);
Route::post('/api/trips/{trips}/location', [TripController::class, 'location']);

Route::apiResource('/api/locations', LocationController::class);
Route::apiResource('/api/reservations', ReservationController::class);

Route::get('/api/driver', [DriverController::class, 'show']);
Route::post('/api/driver', [DriverController::class, 'update']);

    return $request->user();
});

Route::post("/api/register", [AuthController::class, 'register']);
Route::post("/api/login", [AuthController::class, 'login']);


Route::get('/api/admin/trips', [AdminController::class,'showAllTrips']);
Route::delete('/api/admin/trips/{id}', [AdminController::class,'deleteTrip']);
Route::delete('/api/admin/users/{id}', [AdminController::class,'deleteUser']);
Route::get('/api/admin/drivers', [AdminController::class,'showAllDrivers']);


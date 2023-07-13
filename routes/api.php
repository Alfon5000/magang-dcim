<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\StatusController;
use App\Http\Controllers\API\VisitorController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\MagneticDoorController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\SmokeDetectorController;
use App\Http\Controllers\API\TemperatureHumidityController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json([
            'success' => true,
            'data' => $request->user(),
        ]);
    });
});

Route::get('/visitors/download/{file_name}', [VisitorController::class, 'download']);
Route::patch('/visitors/accept/{id}', [VisitorController::class, 'accept']);
Route::patch('/visitors/reject/{id}', [VisitorController::class, 'reject']);

Route::apiResources([
    '/users' => UserController::class,
    '/visitors' => VisitorController::class,
    '/roles' => RoleController::class,
    '/categories' => CategoryController::class,
    '/statuses' => StatusController::class,
]);

Route::get('/magnetic-doors', [MagneticDoorController::class, 'read']);
Route::get('/smoke-detectors', [SmokeDetectorController::class, 'read']);

Route::get('/temperature-humidities', [TemperatureHumidityController::class, 'readAll']);
Route::get('/temperature-humidities/aggregate', [TemperatureHumidityController::class, 'readAggregate']);
Route::get('/temperature-humidities/{id}', [TemperatureHumidityController::class, 'readBySensorId']);

Route::get('/notifications', [NotificationController::class, 'getAll']);
Route::patch('/notifications/read', [NotificationController::class, 'readAll']);
Route::patch('/notifications/unread', [NotificationController::class, 'unreadAll']);
Route::patch('/notifications/read/{id}', [NotificationController::class, 'readOne']);
Route::patch('/notifications/unread/{id}', [NotificationController::class, 'unreadOne']);
Route::delete('/notifications', [NotificationController::class, 'deleteAll']);
Route::delete('/notifications/{id}', [NotificationController::class, 'deleteOne']);

Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);

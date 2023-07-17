<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\UserController;
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
        return $request->user();
    });

    Route::middleware('admin')->group(function () {
        Route::apiResources([
            '/users' => UserController::class,
            '/visitors' => VisitorController::class,
            '/roles' => RoleController::class,
            '/categories' => CategoryController::class,
            '/statuses' => StatusController::class,
        ]);

        Route::get('/visitors/download/{file_name}', [VisitorController::class, 'download']);
        Route::patch('/visitors/accept/{id}', [VisitorController::class, 'accept']);
        Route::patch('/visitors/reject/{id}', [VisitorController::class, 'reject']);
    });

    Route::get('/magnetic-doors', [MagneticDoorController::class, 'readAll']);
    Route::get('/magnetic-doors/one', [MagneticDoorController::class, 'readOne']);
    Route::get('/magnetic-doors/aggregate', [MagneticDoorController::class, 'readAggregate']);

    Route::get('/smoke-detectors', [SmokeDetectorController::class, 'readAll']);
    Route::get('/smoke-detectors/one', [SmokeDetectorController::class, 'readOne']);
    Route::get('/smoke-detectors/aggregate', [SmokeDetectorController::class, 'readAggregate']);

    Route::get('/temperature-humidities', [TemperatureHumidityController::class, 'readAll']);
    Route::get('/temperature-humidities/temperature-aggregate', [TemperatureHumidityController::class, 'temperatureAggregate']);
    Route::get('/temperature-humidities/humidity-aggregate', [TemperatureHumidityController::class, 'humidityAggregate']);
    Route::get('/temperature-humidities/{id}', [TemperatureHumidityController::class, 'readBySensorId']);

    Route::get('/notifications', [NotificationController::class, 'getAll']);
    Route::delete('/notifications', [NotificationController::class, 'deleteAll']);
    Route::delete('/notifications/{id}', [NotificationController::class, 'deleteOne']);
    Route::patch('/notifications/read', [NotificationController::class, 'readAll']);
    Route::patch('/notifications/read/{id}', [NotificationController::class, 'readOne']);
    Route::patch('/notifications/unread', [NotificationController::class, 'unreadAll']);
    Route::patch('/notifications/unread/{id}', [NotificationController::class, 'unreadOne']);

    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::post('/login', [AuthController::class, 'login']);

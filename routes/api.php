<?php

use App\Http\Controllers\API\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VisitorController;
use App\Http\Controllers\API\MagneticDoorController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    '/users' => UserController::class,
    '/visitors' => VisitorController::class,
]);

Route::get('/magnetic-door', [MagneticDoorController::class, 'read']);
Route::get('/temperature-humidity/{id}', [TemperatureHumidityController::class, 'read']);

Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);

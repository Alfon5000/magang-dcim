<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TemperatureHumidity;
use Illuminate\Http\Request;

class TemperatureHumidityController extends Controller
{
    public function read(string $sensor_id)
    {
        $temperature_humidity = TemperatureHumidity::where('sensor_id', $sensor_id)->latest()->first();
        return response()->json([
            'success' => true,
            'data' => $temperature_humidity,
        ]);
    }
}

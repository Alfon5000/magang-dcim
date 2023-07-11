<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\TemperatureHumidity;
use App\Http\Controllers\Controller;

class TemperatureHumidityController extends Controller
{
    public function readAll()
    {
        $temperature_humidities = TemperatureHumidity::latest()->get();

        return response()->json([
            'success' => true,
            'data' => $temperature_humidities,
        ]);
    }

    public function readBySensorId(string $sensor_id)
    {
        $temperature_humidity = TemperatureHumidity::where('sensor_id', $sensor_id)->latest()->first();

        return response()->json([
            'success' => true,
            'data' => $temperature_humidity,
        ]);
    }

    public function readAvg()
    {
        $avg = TemperatureHumidity::selectRaw('AVG(temperature) AS temperature, AVG(humidity) AS humidity, DATE(created_at) AS date')->groupByRaw('date')->orderByRaw('date ASC')->get();

        return response()->json([
            'success' => true,
            'data' => $avg,
        ]);
    }

    public function readMin()
    {
        $min = TemperatureHumidity::selectRaw('MIN(temperature) AS temperature, MIN(humidity) AS humidity, DATE(created_at) AS date')->groupByRaw('date')->orderByRaw('date ASC')->get();

        return response()->json([
            'success' => true,
            'data' => $min,
        ]);
    }

    public function readMax()
    {
        $max = TemperatureHumidity::selectRaw('MAX(temperature) AS temperature, MAX(humidity) AS humidity, DATE(created_at) AS date')->groupByRaw('date')->orderByRaw('date ASC')->get();

        return response()->json([
            'success' => true,
            'data' => $max,
        ]);
    }
}

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
        $sensor_id = TemperatureHumidity::select('sensor_id')->groupBy('sensor_id')->orderBy('sensor_id')->get();
        $years = TemperatureHumidity::selectRaw('YEAR(created_at) as year')->groupByRaw('year')->orderByRaw('year ASC')->get();
        $months = TemperatureHumidity::selectRaw('MONTH(created_at) as month')->groupByRaw('month')->orderByRaw('month ASC')->get();

        return response()->json([
            'success' => true,
            'data' => $temperature_humidities,
            'sensor_id' => $sensor_id,
            'years' => $years,
            'months' => $months,
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

    public function temperatureAggregate()
    {
        $data = TemperatureHumidity::selectRaw('DAY(created_at) as day, MIN(temperature) AS min, MAX(temperature) AS max, AVG(temperature) AS avg')->filter(request(['id', 'year', 'month']))->groupByRaw('day')->orderByRaw('day ASC')->get();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function humidityAggregate()
    {
        $data = TemperatureHumidity::selectRaw('DAY(created_at) as day, MIN(humidity) AS min, MAX(humidity) AS max, AVG(humidity) AS avg')->filter(request(['id', 'year', 'month']))->groupByRaw('day')->orderByRaw('day ASC')->get();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}

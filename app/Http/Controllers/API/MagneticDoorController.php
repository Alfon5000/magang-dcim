<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MagneticDoor;
use Illuminate\Http\Request;

class MagneticDoorController extends Controller
{
    public function readAll()
    {
        $data = MagneticDoor::latest()->get();
        $years = MagneticDoor::selectRaw('YEAR(created_at) as year')->groupByRaw('year')->orderByRaw('year ASC')->get();
        $months = MagneticDoor::selectRaw('MONTH(created_at) as month')->groupByRaw('month')->orderByRaw('month ASC')->get();

        return response()->json([
            'success' => true,
            'data' => $data,
            'years' => $years,
            'months' => $months,
        ]);
    }

    public function readOne()
    {
        $data = MagneticDoor::latest()->first();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function readAggregate()
    {
        $data = MagneticDoor::selectRaw('DAY(created_at) AS day, COUNT(status) AS count')->whereRaw('status = 1')->filter(request(['year', 'month']))->groupByRaw('day')->orderByRaw('day ASC')->get();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SmokeDetector;
use Illuminate\Http\Request;

class SmokeDetectorController extends Controller
{
    public function read()
    {
        $data = SmokeDetector::latest()->first();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}

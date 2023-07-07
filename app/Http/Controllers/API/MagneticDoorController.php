<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MagneticDoor;
use Illuminate\Http\Request;

class MagneticDoorController extends Controller
{
    public function read()
    {
        $data = MagneticDoor::latest()->first();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}

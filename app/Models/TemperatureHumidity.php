<?php

namespace App\Models;

use App\Models\Sensor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TemperatureHumidity extends Model
{
    use HasFactory;

    protected $casts = ['created:d-m-Y'];

    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }
}

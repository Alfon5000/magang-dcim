<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function temperatureHumidities()
    {
        return $this->hasMany(TemperatureHumidity::class);
    }

    public function magneticDoors()
    {
        return $this->hasMany(MagneticDoor::class);
    }

    public function smokeDetectors()
    {
        return $this->hasMany(SmokeDetector::class);
    }
}

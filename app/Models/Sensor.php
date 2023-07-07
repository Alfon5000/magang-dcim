<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function temperatureHumidities()
    {
        return $this->hasMany(TemperatureHumidity::class);
    }
}

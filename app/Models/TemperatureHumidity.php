<?php

namespace App\Models;

use App\Models\Sensor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TemperatureHumidity extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }

    public function scopeFilter($query, array $filter)
    {
        $query->when($filter['year'] ?? false, function ($query, $year) {
            return $query->whereYear('created_at', $year);
        });

        $query->when($filter['month'] ?? false, function ($query, $month) {
            return $query->whereMonth('created_at', $month);
        });

        $query->when($filter['day'] ?? false, function ($query, $day) {
            return $query->whereDay('created_at', $day);
        });
    }
}

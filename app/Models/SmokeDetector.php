<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmokeDetector extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filter)
    {
        $query->when($filter['year'] ?? false, function ($query, $year) {
            return $query->whereYear('created_at', $year);
        });

        $query->when($filter['month'] ?? false, function ($query, $month) {
            return $query->whereMonth('created_at', $month);
        });
    }
}

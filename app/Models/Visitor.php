<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'visitor_category_id',
        'start_date',
        'end_date',
        'application_letter',
        'description',
    ];

    public function visitor_category()
    {
        return $this->belongsTo(VisitorCategory::class);
    }
}

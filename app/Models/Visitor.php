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

    protected $with = ['visitor_category'];

    public function visitor_category()
    {
        return $this->belongsTo(VisitorCategory::class);
    }

    public function scopeFilter($query, array $filter)
    {
        $query->when($filter['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('start_date', 'like', '%' . $search . '%')
                ->orWhere('end_date', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        });

        $query->when($filter['visitor_category'] ?? false, function ($query, $visitor_category) {
            return $query->whereHas('visitor_category', function ($query) use ($visitor_category) {
                $query->where('name', 'like', '%' . $visitor_category . '%');
            });
        });
    }
}

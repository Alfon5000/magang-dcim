<?php

namespace Database\Seeders;

use App\Models\VisitorCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisitorCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $visitor_categories = [
            [
                'name' => 'Installation',
            ],
            [
                'name' => 'Maintenance',
            ],
            [
                'name' => 'Repair',
            ],
        ];

        foreach ($visitor_categories as $visitor_category) {
            VisitorCategory::create($visitor_category);
        }
    }
}

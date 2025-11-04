<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB; 
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Engine Components',
            'Transmission & Drivetrain',
            'Electrical & Lighting',
            'Fuel System',
            'Braking System',
            'Suspension & Steering',
            'Exhaust System',
            'Body & Frame',
            'Handlebars & Controls',
            'Wheels & Tires',
            'Mirrors & Accessories',
            'Cooling System',
            'Lubricants & Fluids',
        ];

        $rows = collect($names)->map(fn ($name) => [
            'name'       => $name,
            'created_at' => now(),
            'updated_at' => now(),
        ])->all();

        DB::table('categories')->insert($rows);
    }
}

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
            'Accessories & Apparel',
            'Body & Frame',
            'Braking System',
            'Cooling System',
            'Electrical & Lighting',
            'Engine Components',
            'Exhaust System',
            'Fuel System',
            'Handlebars & Controls',
            'Lubricants & Fluids',
            'Suspension & Steering',
            'Transmission & Drivetrain',
            'Wheels & Tires',
        ];

        $rows = collect($names)->map(fn ($name) => [
            'name'       => $name,
            'created_at' => now(),
            'updated_at' => now(),
        ])->all();

        DB::table('categories')->insert($rows);
    }
}

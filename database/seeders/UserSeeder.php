<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'role_id' => 1,
            'firstname' => 'admin',
            'lastname' => 'User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'), 
            'verification_token' => rand(100000, 999999),
            'created_at' => now(),
            'updated_at' => now(),
            'is_seeded' => true, 
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shop')->insert([
            'shop_id' => 1,
            'shop_name' => 'MotoSmart Shop',
            'shop_logo'    => 'images/primary-logo.png',
        ]);
    }
}

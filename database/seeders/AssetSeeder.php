<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Asset;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Asset::create([
            'asset_id' => 'AS23102023001',
            'asset_name' => 'Tenda',
            'quantity' => 1,
            'description' => 'Tenda',
            'attachment' => 'image',
            'status' => 'Tersedia',
            'is_active' => '1',
        ]);
    }
}

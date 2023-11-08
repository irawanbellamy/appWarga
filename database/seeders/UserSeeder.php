<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Irawan',
            'house_block' => 'I2',
            'house_number' => '29',
            'phone_number' => '085780605338',
            'role' => 'ADMIN',
            'status' => 'Menetap',
            'email' => 'irawanbellamy@gmail.com',
            'password' => Hash::make('123456'),
            'is_active' => '1',
        ]);
    }
}

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
            [
                'name' => 'jhon',
                'email' => 'jhon@gmail.com',
                'phone' => '+963900000001',
                'password' => Hash::make('password'),
                'city_id' => 1,
                'address' => 'Jl. Raya Purworejo',
                'gender' => 'male',
                'birth_date' => '2000-01-01',
                'email_verified_at' => '2000-01-01',
            ],
            [
                'name' => 'ros',
                'email' => 'ros@gmail.com',
                'phone' => '+963900000002',
                'password' => Hash::make('password'),
                'city_id' => 2,
                'address' => 'EL. Some Where',
                'gender' => 'female',
                'birth_date' => '1998-01-01',
                'email_verified_at' => '2000-01-01',

            ]
        ]);
    }
}

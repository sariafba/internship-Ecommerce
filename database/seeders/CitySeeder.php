<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->insert([
            [
                'name' => json_encode([
                    'en' => 'Damascus',
                    'ar' => 'دمشق',
                ]),
            ],
            [
                'name' => json_encode([
                    'en' => 'Alepo',
                    'ar' => 'حلب',
                ]),
            ],
            [
                'name' => json_encode([
                    'en' => 'Latakia',
                    'ar' => 'اللاذقية',
                ]),
            ],
            [
                'name' => json_encode([
                    'en' => 'Homes',
                    'ar' => 'حمص',
                ]),
            ],
            [
                'name' => json_encode([
                    'en' => 'Tartus',
                    'ar' => 'طرطوس',
                ]),
            ],




        ]);
    }
}

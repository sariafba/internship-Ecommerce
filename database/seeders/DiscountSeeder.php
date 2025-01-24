<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('discounts')->insert([
            [
                'name' => json_encode([
                    'en' => 'New Year\'s Day',
                    'ar' => 'عيد راس السنة',
                ]),
                'type' => 'percent',
                'value' => 10,
                'start_at' => '2024-10-01 00:00:00',
                'end_at' => '2024-10-31 00:00:00',
            ],
            [
                'name' => json_encode([
                    'en' => 'Mother\'s Day',
                    'ar' => 'عيد الام',
                ]),
                'type' => 'subtraction',
                'value' => 500,
                'start_at' => '2024-10-01 00:00:00',
                'end_at' => '2024-10-31 00:00:00',
            ],
        ]);

    }
}

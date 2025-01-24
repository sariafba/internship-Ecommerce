<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('attributes')->insert([
            [
                'name' => json_encode([
                    'en' => 'cpu',
                    'ar' => 'معالج',
                ]),
            ],
            [
                'name' => json_encode([
                    'en' => 'ram',
                    'ar' => 'رامات',
                ]),
            ],
            [
                'name' => json_encode([
                    'en' => 'gpu',
                    'ar' => 'كرت الشاشة',
                ]),
            ],
        ]);
    }
}

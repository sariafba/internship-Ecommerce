<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('attribute_values')->insert([

            //cpu
            [
                'attribute_id' => 1,
                'name' => json_encode([
                    'en' => 'm 1',
                    'ar' => 'ام 1',
                ]),
            ],
            [
                'attribute_id' => 1,
                'name' => json_encode([
                    'en' => 'm 2',
                    'ar' => 'ام 2',
                ]),
            ],
            [
                'attribute_id' => 1,
                'name' => json_encode([
                    'en' => 'A 15',
                    'ar' => 'اي 15',
                ]),
            ],
            [
                'attribute_id' => 1,
                'name' => json_encode([
                    'en' => 'A 16',
                    'ar' => 'اي 16',
                ]),
            ],

            //ram
            [
                'attribute_id' => 2,
                'name' => json_encode([
                    'en' => '8 GB',
                    'ar' => '8 جيجابايت',
                ]),
            ],
            [
                'attribute_id' => 2,
                'name' => json_encode([
                    'en' => '16 GB',
                    'ar' => '16 جيجابايت',
                ]),
            ],
            [
                'attribute_id' => 3,
                'name' => json_encode([
                    'en' => 'rtx 4060',
                    'ar' => 'ار تي اكس 4060'
                ]),
            ],
            [
                'attribute_id' => 1,
                'name' => json_encode([
                    'en' => 'intel core i7 13800 h',
                    'ar' => ' 13800 h انتل كور اي 7'
                ]),
            ]
        ]);
    }
}

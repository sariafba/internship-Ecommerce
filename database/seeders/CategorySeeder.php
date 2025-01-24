<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => json_encode([
                    'en' => 'laptops',
                    'ar' => 'لابتوبات'
                ])
            ],
            [
                'name' => json_encode([
                    'en' => 'mobiles',
                    'ar' => 'موبايلات'
                ])
            ],
        ]);


        DB::table('categories')->insert([
            [
                'parent_id' => 1,
                'name' => json_encode([
                    'en' => 'dell',
                    'ar' => 'ديل',
                ]),
            ],
            [
                'parent_id' => 1,
                'name' => json_encode([
                    'en' => 'lenovo',
                    'ar' => 'لينوفو',
                ]),
            ],
            [
                'parent_id' => 4,
                'name' => json_encode([
                    'en' => 'gaming',
                    'ar' => 'جيمنج',
                ]),
            ],
            [
                'parent_id' => 4,
                'name' => json_encode([
                    'en' => 'ideapad',
                    'ar' => 'ايدياباد',
                ]),
            ],
            [
                'parent_id' => 5,
                'name' => json_encode([
                    'en' => 'legion',
                    'ar' => 'ليجون',
                ]),
            ],
            [
                'parent_id' => 2,
                'name' => json_encode([
                    'en' => 'samsung',
                    'ar' => 'سامسنج',
                ]),
            ],
            [
                'parent_id' => 2,
                'name' => json_encode([
                    'en' => 'apple',
                    'ar' => 'ابل',
                ]),
            ],
            [
                'parent_id' => 9,
                'name' => json_encode([
                    'en' => 'iphone',
                    'ar' => 'ايفون',
                ]),
            ],
            [
                'parent_id' => 9,
                'name' => json_encode([
                    'en' => 'mac',
                    'ar' => 'ماك',
                ]),
            ],
        ]);

        Category::fixTree();
    }
}

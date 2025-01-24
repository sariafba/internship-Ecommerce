<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'brand_id' => 3,
                'category_id' => 10,
                'name' => json_encode([
                    'en' => 'iphone 15',
                    'ar' => 'ايفون 15',
                ]),
                'description' => json_encode([
                    'en' => 'This is the description for Example Product 1',
                    'ar' => 'هذا هو الوصف للمنتج مثال 1',
                ]),
                'minimum_amount' => 5,
            ],
            [
                'brand_id' => 3,
                'category_id' => 11,
                'name' => json_encode([
                    'en' => 'mac book pro',
                    'ar' => 'ماك بوك برو',
                ]),
                'description' => json_encode([
                    'en' => 'This is the description for Example Product 2',
                    'ar' => 'هذا هو الوصف للمنتج مثال 2',
                ]),
                'minimum_amount' => 2,
            ],
            [
                'brand_id' => 5,
                'category_id' => 7,
                'name' => json_encode([
                    'en' => 'legion 5 pro',
                    'ar' => 'ليجون 5 برو',
                ]),
                'description' => json_encode([
                    'en' => 'This is the description for Example Product 3',
                    'ar' => 'هذا هو الوصف للمنتج مثال 3',
                ]),
                'minimum_amount' => 2,
            ],
//            [
//                'brand_id' => 5,
//                'category_id' => 6,
//                'name' => json_encode([
//                    'en' => 'lenovo ideapad',
//                    'ar' => 'لينوفو ايديا باد',
//                ]),
//                'description' => json_encode([
//                    'en' => 'This is the description for Example Product 4',
//                    'ar' => 'هذا هو الوصف للمنتج مثال 4',
//                ]),
//                'minimum_amount' => 5,
//            ],
        ]);

        $products = Product::all();

        $products->find(1)->discounts()->attach(1);
        $products->find(1)->attributes()->attach([1, 2]);

        $products->find(2)->discounts()->attach(2);
        $products->find(2)->attributes()->attach([1, 2]);

        $products->find(3)->attributes()->attach([1, 2]);
    }
}

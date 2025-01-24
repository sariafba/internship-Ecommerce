<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_variants')->insert([

            //iphone
            [
                'product_id' => 1,
                'attributes_values' => json_encode([
                    1 => 3,
                    2 => 5
                ]),
                'amount' => 15,
                'price' => 1100,
            ],
            [
                'product_id' => 1,
                'attributes_values' => json_encode([
                    1 => 3,
                    2 => 6
                ]),
                'amount' => 5,
                'price' => 1300,
            ],
            [
                'product_id' => 1,
                'attributes_values' => json_encode([
                    1 => 4,
                    2 => 6
                ]),
                'amount' => 2,
                'price' => 1600,
            ],


            //mac
            [
                'product_id' => 2,
                'attributes_values' => json_encode([
                    1 => 1,
                    2 => 5
                ]),
                'amount' => 10,
                'price' => 2100,
            ],
            [
                'product_id' => 2,
                'attributes_values' => json_encode([
                    1 => 1,
                    2 => 6
                ]),
                'amount' => 2,
                'price' => 2300,
            ],
            [
                'product_id' => 2,
                'attributes_values' => json_encode([
                    1 => 2,
                    2 => 6
                ]),
                'amount' => 1,
                'price' => 2500,
            ],
            [
                'product_id' => 3,
                'attributes_values' => json_encode([
                    1 => 3,
                    2 => 6,
                    3 => 7
                ]),
                'amount' => 1,
                'price' => 3000,
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Product::all() as $product)
        {
            DB::table('images')->insert([
                [
                    'url' => fake()->url,
                    'imageable_type' => Product::class,
                    'imageable_id' => $product->id,
                ],
                [
                    'url' => fake()->url,
                    'imageable_type' => Product::class,
                    'imageable_id' => $product->id,
                ],
                [
                    'url' => fake()->url,
                    'imageable_type' => Product::class,
                    'imageable_id' => $product->id,
                ]
            ]);
        }

        foreach (Category::all() as $category)
        {
            DB::table('images')->insert([
                [
                    'url' => fake()->url,
                    'imageable_type' => Category::class,
                    'imageable_id' => $category->id,
                ]
            ]);
        }

        foreach (Brand::all() as $brand)
        {
            DB::table('images')->insert([
                [
                    'url' => fake()->url,
                    'imageable_type' => Brand::class,
                    'imageable_id' => $brand->id,
                ]
            ]);
        }

    }
}

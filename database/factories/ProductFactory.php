<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => [
                'en' => fake()->name,
                'ar' => fake()->name,
            ],
            'description' => [
                'en' => fake()->name,
                'ar' => fake()->name,
            ],
            'minimum_amount' => fake()->numberBetween(1,100),
        ];
    }


}

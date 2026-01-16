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
            'name' => fake()->text(5),
            'description' => fake()->text(20),
            'price' => rand(1, 5),
            'quantity' => rand(1, 10),
            'category_id' => rand(1, 3),
            'imageUrl' => 'no_image.png',
            'active' => 1,
        ];
    }
}
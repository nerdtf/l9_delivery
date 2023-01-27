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
    public function definition()
    {
        return [
            "name" => fake()->word(),
            "description" => fake()->text(30),
            "weight" => fake()->numberBetween(1, 800),
            "image" => fake()->uuid(),
            "price" => fake()->randomFloat(null , 10, 1234)
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;
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


    public function predefinedProducts()
    {
        $productNames = [
            'Apples', 'Bananas', 'Cherries', 'Dates', 'Eggplant',
            'Figs', 'Grapes', 'Honeydew Melon', 'Iceberg Lettuce', 'Jackfruit',
            'Lemons', 'Mangoes', 'Nectarines', 'Oranges',
            'Papayas', 'Raspberries', 'Strawberries', 'Tomatoes',
            'Yams','Zucchini', 'Eggs', 'Milk', 'Unsalted Butter'
        ];

        foreach ($productNames as $productName) {
            Product::create([
                'name' => $productName,
                'description' => $this->faker->text(30),
                'weight' => $this->faker->numberBetween(1, 800),
                'price' => $this->faker->randomFloat(null , 10, 1234)
            ]);
        }
    }
}

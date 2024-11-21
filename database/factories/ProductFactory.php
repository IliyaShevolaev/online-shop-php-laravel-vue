<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(2, true),
            'description' => $this->faker->paragraph(),
            'image_path' => 'uploads/test.jpg',
            'price' => $this->faker->numberBetween(100, 10000),
            'old_price' => $this->faker->optional()->numberBetween(100, 10000),
            'products_count' => $this->faker->numberBetween(0, 100),
            'category_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}

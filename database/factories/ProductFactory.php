<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

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
        $product_categories = ProductCategory::all();
        return [
            'sku' => strtolower($this->faker->unique()->word()),
            'name' => $this->faker->unique()->sentence(2),
            'image' => 'default/product.png',
            'stock' => $this->faker->numberBetween(1, 100),
            'minimum_buy' => $this->faker->numberBetween(1, 5),
            'weight' => $this->faker->numberBetween(1, 10) * 100,
            'price' => $this->faker->randomFloat(2, 1000, 5000),
            'description' => $this->faker->paragraph(),

            'product_category_id' => $product_categories->random()->id,
        ];
    }
}

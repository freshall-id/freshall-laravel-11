<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\TransactionHeader;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransactionDetail>
 */
class TransactionDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::all()->random();
        $transactionHeader = TransactionHeader::all()->random();
        return [
            'quantity' => $this->faker->numberBetween(1, 10),
            'rating' => $this->faker->randomFloat(2, 0, 5),
            'product_id' => $product->id,
            'transaction_header_id' => $transactionHeader->id,
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voucher>
 */
class VoucherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => strtoupper($this->faker->unique()->word()) . $this->faker->unique()->randomNumber(5),
            'discount' => $this->faker->randomFloat(2, 1, 10),
            'min_price' => $this->faker->randomFloat(2, 1000, 5000),
            'max_discount' => $this->faker->randomFloat(2, 1000, 5000),
            'expired_at' => $this->faker->dateTimeBetween('now', '+1 month'),
            'quantity' => $this->faker->numberBetween(1, 10),
            'used' => $this->faker->numberBetween(0, 5),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserAddress;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransactionHeader>
 */
class TransactionHeaderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userAddress = UserAddress::with('user')->get();
        $randomUserAddress = $userAddress->random();

        return [
            'invoice_number' => $this->faker->unique()->numerify('INV-########'),
            'status' => $this->faker->randomElement(['PENDING', 'INPROCESS', 'COMPLETED', 'CANCELED', 'FAILED', 'TROUBLE', 'ONHOLD']),

            'shipping_provider' => $this->faker->company,
            'shipping_receipt_number' => $this->faker->regexify('[A-Z]{3}[0-9]{7}'),
            'shipping_status' => $this->faker->randomElement(['INPROCESS', 'WAITING', 'SHIPPED', 'DELIVERED', 'RETURNED', 'LOST', 'DAMAGED']),

            'payment_method' => $this->faker->randomElement(['BANK_TRANSFER', 'CREDIT_CARD', 'EWALLET']),
            'payment_receipt_number' => $this->faker->regexify('[A-Z0-9]{10}'),
            'payment_status' => $this->faker->randomElement(['PENDING', 'WAITING', 'PAID', 'FAILED', 'REFUNDED', 'CANCELED']),

            'price_shipping' => $this->faker->randomFloat(2, 0, 99999999),
            'price_items' => $this->faker->randomFloat(2, 0, 99999999),
            'price_discount' => $this->faker->randomFloat(2, 0, 99999999),
            'price_insurance' => $this->faker->randomFloat(2, 0, 99999999),
            'price_fee' => $this->faker->randomFloat(2, 0, 99999999),
            'price_total' => function (array $attributes) {
                return $attributes['price_items']
                    + $attributes['price_shipping']
                    + $attributes['price_insurance']
                    + $attributes['price_fee']
                    - $attributes['price_discount'];
            },

            'notes' => $this->faker->optional()->sentence,

            'user_id' => $randomUserAddress->user->id,
            'user_address_id' => $randomUserAddress->id,
            'voucher_id' => null,
        ];
    }
}

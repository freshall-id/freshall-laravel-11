<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAddress>
 */
class UserAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::WHERE('role','USER')->get();
        return [
            'label' => $this->faker->words(2, true),
            'category' => $this->faker->randomElement(['HOME', 'KOST', 'OFFICE', 'APARTMENT', 'OTHER']), // Pilihan kategori
            'full_address' => $this->faker->address,
            'receiver_name' => $this->faker->name,
            'receiver_phone' => $this->faker->phoneNumber,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'postal_code' => $this->faker->postcode,
            'notes' => substr($this->faker->sentence, 0, 45),
            'is_primary' => $this->faker->boolean,
            'user_id' => $user->random()->id,
        ];
    }
}

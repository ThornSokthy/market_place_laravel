<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'street' => $this->faker->streetAddress(),
            'commune' => $this->faker->citySuffix(),
            'district' => $this->faker->city(),
            'city' => $this->faker->city(),
            'postal_code' => $this->faker->postcode(),
            'is_default' => $this->faker->boolean(),
        ];
    }

    public function default()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_default' => true,
            ];
        });
    }
    public function notDefault()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_default' => false,
            ];
        });
    }
}

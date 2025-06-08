<?php

namespace Database\Factories;

use App\Models\User;
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
        $categories = ["electronics", "clothing", "home", "books", "other"];
        $statuses = ["available", "sold"];

        return [
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph,
            'category' => $this->faker->randomElement($categories),
            'quantity' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'status' => $this->faker->randomElement($statuses),
            'is_active' => $this->faker->boolean(90), // 90% chance of being active
        ];
    }

    // State methods for specific scenarios
    public function available()
    {
        return $this->state([
            'status' => 'available',
        ]);
    }

    public function sold()
    {
        return $this->state([
            'status' => 'sold',
            'quantity' => 0,
        ]);
    }

    public function inactive()
    {
        return $this->state([
            'is_active' => false,
        ]);
    }

    public function forSeller(User $seller)
    {
        return $this->state(function (array $attributes) use ($seller) {
            return [
                'seller_id' => $seller instanceof User ? $seller->id : $seller,
            ];
        });
    }
}

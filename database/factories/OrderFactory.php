<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'order_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'total_amount' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }

    public function forBuyer(User $buyer)
    {
        return $this->state([
            'buyer_id' => $buyer->id,
        ]);
    }

    public function forSeller(User $seller)
    {
        return $this->state([
            'seller_id' => $seller->id,
        ]);
    }

    public function withAddress(Address $address)
    {
        return $this->state([
            'address_id' => $address->id,
            'buyer_id' => $address->user_id,
        ]);
    }

    public function recent()
    {
        return $this->state([
            'order_date' => $this->faker->dateTimeBetween('-1 week', 'now'),
        ]);
    }

    public function old()
    {
        return $this->state([
            'order_date' => $this->faker->dateTimeBetween('-1 year', '-6 months'),
        ]);
    }
}

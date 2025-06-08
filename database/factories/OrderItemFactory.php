<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }

    public function forOrder(Order $order)
    {
        return $this->state([
            'order_id' => $order->id,
        ]);
    }

    public function withProduct(Product $product)
    {
        return $this->state([
            'product_id' => $product->id,
            'price' => $product->price,
        ]);
    }

    public function withQuantity(int $quantity)
    {
        return $this->state([
            'quantity' => $quantity,
        ]);
    }
}

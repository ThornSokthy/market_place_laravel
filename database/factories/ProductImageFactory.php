<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductImage>
 */
class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'image_url' => $this->faker->imageUrl(640, 480, 'product', true),
            'is_primary' => false,
        ];
    }

    public function primary()
    {
        return $this->state([
            'is_primary' => true,
        ]);
    }

}

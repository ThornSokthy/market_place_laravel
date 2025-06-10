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
        $imageUrls = [
            'https://d2v5dzhdg4zhx3.cloudfront.net/web-assets/images/storypages/primary/ProductShowcasesampleimages/JPEG/Product+Showcase-1.jpg',
            'https://plus.unsplash.com/premium_photo-1664392147011-2a720f214e01?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR1Z2hl8RAvyhzhHYErVp_wc_31v59q5N9w-dJQa2fSaN5pa-HInoxYoZ3_07VjDtEXN30&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQLcW90dVPhS7TDm-rr3jmjoneXpcH2g-2SmpYYtQbT_r4HUy-SxwIVDWwlX2E_916F0nY&usqp=CAU',
            'https://m.media-amazon.com/images/I/61ttw0sasbL.jpg'
        ];

        return [
            'product_id' => Product::factory(),
            'image_url' => $this->faker->randomElement($imageUrls),
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

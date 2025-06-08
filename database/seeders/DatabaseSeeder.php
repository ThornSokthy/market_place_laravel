<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create specific test user
//        User::factory()->create([
//            'first_name' => 'Test',
//            'last_name' => 'User',
//            'email' => 'test@example.com',
//            'phone' => '1234567890', // Required unique field
//            'password' => bcrypt('password'), // Explicit password
//        ]);

        $users = User::factory(10)
            ->has(
                Address::factory()->count(3)
                    ->sequence(
                        ['is_default' => true],
                        ['is_default' => false],
                        ['is_default' => false]
                    ),
                'addresses'
            )
            ->create();

        $sellers = $users->random(6);

        $productsPerSeller = [4, 3, 3, 4, 3, 3];

        $sellers->each(function ($seller, $index) use ($productsPerSeller) {
            Product::factory()
                ->count($productsPerSeller[$index])
                ->for($seller, 'seller')
                ->has(
                    ProductImage::factory()
                        ->count(3)
                        ->sequence(
                            ['is_primary' => true],
                            ['is_primary' => false],
                            ['is_primary' => false]
                        ),
                    'images'
                )
                ->create();
        });
        for ($i = 0; $i < 15; $i++) {
            $buyer = $users->random(); // Uses existing user
            $seller = $sellers->random(); // Uses existing seller
            $address = $buyer->addresses->where('is_default', true)->first();

            $order = Order::factory()
                ->forBuyer($buyer)
                ->forSeller($seller)
                ->withAddress($address)
                ->create(['total_amount' => 0]);

            $sellerProducts = Product::where('seller_id', $seller->id)->get()->random(rand(1, 3));

            $totalAmount = 0;
            foreach ($sellerProducts as $product) {
                $quantity = rand(1, 3);
                $totalAmount += $product->price * $quantity;

                OrderItem::factory()
                    ->forOrder($order)
                    ->withProduct($product)
                    ->withQuantity($quantity)
                    ->create();
            }

            $order->update(['total_amount' => $totalAmount]);
        }

    }
}

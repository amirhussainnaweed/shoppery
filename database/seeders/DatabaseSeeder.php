<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Review;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // FIRST: Seed categories and brands
        $this->call([
            CategorySeeder::class,
            BrandSeeder::class,
            // TagSeeder::class, // If you have one
            // AttributeSeeder::class, // If you have one
        ]);

        // SECOND: Create users with their relationships
        User::factory(200)
            ->has(\App\Models\Address::factory()->count(2))
            ->has(\App\Models\Billing::factory()->count(2))
            ->has(\App\Models\Cart::factory())
            ->has(\App\Models\Wishlist::factory()->count(3))
            ->has(\App\Models\Order::factory()->count(2))
            ->create();

        // THIRD: Create products (categories and brands now exist)
      Product::factory(50)
    ->has(\App\Models\ProductAttribute::factory()->count(3), 'productAttributes')
    ->has(\App\Models\ProductImage::factory()->count(2), 'images')
    ->has(\App\Models\ProductTag::factory()->count(2), 'tags')
    ->has(\App\Models\Review::factory()->count(5), 'reviews')
    ->create();

        // FOURTH: Create orders
        Order::factory(20)
            ->has(\App\Models\OrderItem::factory()->count(3))
            ->create();
    }
}

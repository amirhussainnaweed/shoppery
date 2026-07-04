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
        User::factory(200)
            ->has(\App\Models\Address::factory()->count(2))
            ->has(\App\Models\Billing::factory()->count(2))
            ->has(\App\Models\Cart::factory())
            ->has(\App\Models\Wishlist::factory()->count(3))
            ->has(\App\Models\Order::factory()->count(2))
            ->create();

        Product::factory(50)
            ->has(\App\Models\ProductAttribute::factory()->count(3))
            ->has(\App\Models\ProductImage::factory()->count(2))
            ->has(\App\Models\ProductTag::factory()->count(2))
            ->has(\App\Models\Review::factory()->count(5))
            ->create();

        Order::factory(20)
            ->has(\App\Models\OrderItem::factory()->count(3))
            ->create();
    }
}

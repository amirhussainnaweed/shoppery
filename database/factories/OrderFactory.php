<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Billing;
use App\Models\ShippingAddress;
use App\Models\Order;
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
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'billing_id' => Billing::factory(),
            'shipping_address_id' => ShippingAddress::factory(),
            'order_date' => $this->fake()->dateTimeBetween('-1 year', 'now'),
            'status' => $this->fake()->randomElement(['pending', 'processing', 'shipped', 'delivered', 'cancelled']),
            'payment_method' => $this->fake()->randomElement(['credit_card', 'paypal', 'bank_transfer', 'cash_on_delivery']),
            'shipping_cost' => $this->fake()->randomFloat(2, 0, 50),
            'total_price' => $this->fake()->randomFloat(2, 10, 1000),
        ];
    }
}

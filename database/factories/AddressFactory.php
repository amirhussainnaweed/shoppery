<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'address_text' => $this->fake()->streetAddress(),
            'city' => $this->fake()->city(),
            'country' => $this->fake()->country(),
            'postal_code' => $this->fake()->numberBetween(100, 99999),
        ];
    }
}

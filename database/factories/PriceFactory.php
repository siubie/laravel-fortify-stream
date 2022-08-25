<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Price>
 */
class PriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'buy' => fake()->numberBetween(900000, 1000000),
            'sell' => fake()->numberBetween(900000, 1000000),
            'date' => fake()->date('Y-m-d')
        ];
    }
}

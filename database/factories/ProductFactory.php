<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $price = rand(10000, 44000);
        return [
            'name' => fake()->colorName() . ' product',
            'image' => 'https://picsum.photos/200',
            'price_without_discount' => $price,
            'price_with_discount' => rand(1000, $price - 1000),
            'stock' => rand(0, 99)
        ];
    }
}

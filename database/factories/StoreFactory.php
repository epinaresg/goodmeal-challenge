<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake()->company();

        return [
            'logo' => fake()->url(),
            'background' => fake()->url(),
            'name' => $name,
            'slug' => Str::slug($name, '-'),
            'products_with_stock' => rand(0, 1),
            'address' => fake()->address(),
            'rating' => rand(1, 5),
            'delivery' => rand(0, 1),
            'take_out' => rand(0, 1),
        ];
    }
}

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

        $delivery = rand(0, 1);
        $takeOut = ($delivery == 0 ? 1 : rand(0, 1));

        $kindOfAttention = 'Retiro o delivery';
        if ($delivery == 1 && $takeOut == 0) {
            $kindOfAttention = 'Delivery';
        } elseif ($delivery == 0 && $takeOut == 1) {
            $kindOfAttention = 'Retiro';
        }

        return [
            'logo' => 'https://picsum.photos/id/' . rand(1, 500). '/200',
            'background' => 'https://picsum.photos/id/' . rand(1, 500). '/1920/500',
            'name' => $name,
            'slug' => Str::slug($name, '-'),
            'products_with_stock' => rand(0, 1),
            'address' => fake()->address(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'rating' => rand(1, 5),
            'delivery' => $delivery,
            'take_out' => $takeOut,
            'kind_of_attention' => $kindOfAttention
        ];
    }
}

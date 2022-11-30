<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Store::create([
            'logo' => 'https://img.mesa247.pe/archivos/restaurant-costazul-seafood-eirl/costazul-seafood-logo.jpg',
            'name' => 'Costazul Seafood',
            'slug' => 'costazul-seafood',
            'address' => 'Ca. Berlin 899, Miraflores',
            'delivery' => 1,
            'take_out' => 1,
            'rating' => '4.3'
        ]);

        Store::create([
            'logo' => 'https://img.mesa247.pe/archivos/restaurante/logo/2022/06/restaurante-la-terraza-del-pardo-1.png',
            'name' => 'la Terraza del Pardo',
            'slug' => 'la-terraza-del-pardo',
            'address' => 'Calle 2 de Mayo 403, Miraflores',
            'delivery' => 1,
            'take_out' => 1,
            'rating' => '5'
        ]);

        Store::create([
            'logo' => 'https://img.mesa247.pe/archivos/costumbres-argentinas-sac/costumbres-argentinas-logo.jpg',
            'name' => 'Costumbres Argentinas',
            'slug' => 'costumbres-argentinas',
            'address' => 'Av. República de Panamá 6562 Barranco, Barranco',
            'delivery' => 1,
            'take_out' => 1,
            'rating' => '4.7'
        ]);

        Store::create([
            'logo' => 'https://img.mesa247.pe/archivos/makoto-miraflores/makoto-miraflores-logo.jpg',
            'name' => 'Makoto - Miraflores',
            'slug' => 'makoto-miraflores',
            'address' => 'Calle 2 de Mayo 413, Miraflores',
            'delivery' => 1,
            'take_out' => 1,
            'rating' => '4.9'
        ]);
    }
}

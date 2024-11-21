<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $shops = [
            [
                'seller_id' => 1,
                'name' => 'Tech Haven Store',
                'description' => 'Your one-stop shop for all things technology'
            ],
            [
                'seller_id' => 2,
                'name' => 'Fashion Studio Boutique',
                'description' => 'Trendy and stylish fashion for everyone'
            ],
            [
                'seller_id' => 3,
                'name' => 'Home Essentials Shop',
                'description' => 'Everything you need for your home'
            ]
        ];

        foreach ($shops as $shop) {
            Shop::create($shop);
        }
    }
}

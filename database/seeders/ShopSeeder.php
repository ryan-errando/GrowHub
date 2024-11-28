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
            ],
            [
                'seller_id' => 2,
                'name' => 'Fashion Studio Boutique',
            ],
            [
                'seller_id' => 3,
                'name' => 'Home Essentials Shop',
            ]
        ];

        foreach ($shops as $shop) {
            Shop::create($shop);
        }
    }
}

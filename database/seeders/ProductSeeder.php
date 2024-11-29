<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $techProducts = [
            [
                'shop_id' => 1,
                'name' => 'Gaming Laptop',
                'description' => 'High-performance gaming laptop with RTX 3080',
                'price' => 199999, // $1,999.99
                'image' => ''
            ],
            [
                'shop_id' => 1,
                'name' => 'Wireless Earbuds',
                'description' => 'Premium wireless earbuds with noise cancellation',
                'price' => 19999, // $199.99
                'image' => ''
            ],
            [
                'shop_id' => 1,
                'name' => '4K Monitor',
                'description' => '32-inch 4K gaming monitor with 144Hz',
                'price' => 59999, // $599.99
                'image' => ''
            ]
        ];

        // Fashion Studio Products (Shop ID: 2)
        $fashionProducts = [
            [
                'shop_id' => 2,
                'name' => 'Designer Handbag',
                'description' => 'Luxury leather handbag',
                'price' => 29999, // $299.99
                'image' => ''
            ],
            [
                'shop_id' => 2,
                'name' => 'Summer Dress',
                'description' => 'Floral print summer dress',
                'price' => 7999, // $79.99
                'image' => ''
            ],
            [
                'shop_id' => 2,
                'name' => 'Designer Sunglasses',
                'description' => 'Premium UV protection sunglasses',
                'price' => 14999, // $149.99
                'image' => ''
            ]
        ];

        // Home Essentials Products (Shop ID: 3)
        $homeProducts = [
            [
                'shop_id' => 3,
                'name' => 'Smart Coffee Maker',
                'description' => 'WiFi-enabled programmable coffee maker',
                'price' => 12999, // $129.99
                'image' => ''
            ],
            [
                'shop_id' => 3,
                'name' => 'Robot Vacuum',
                'description' => 'Smart robot vacuum with mapping',
                'price' => 39999, // $399.99
                'image' => ''
            ],
            [
                'shop_id' => 3,
                'name' => 'Air Purifier',
                'description' => 'HEPA air purifier for large rooms',
                'price' => 24999, // $249.99
                'image' => ''
            ]
        ];

        foreach ($techProducts as $product) {
            Product::create($product);
        }

        foreach ($fashionProducts as $product) {
            Product::create($product);
        }

        foreach ($homeProducts as $product) {
            Product::create($product);
        }
    }
}

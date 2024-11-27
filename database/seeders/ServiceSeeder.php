<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $techServices = [
            [
                'shop_id' => 1,
                'name' => 'Computer Repair',
                'description' => 'Professional computer repair service',
                'price_per_hour' => 6500, // $65.00
                'minimum_hours' => 1,
                'maximum_hours' => 8,
                'is_available' => true,
                'image' => ''
            ],
            [
                'shop_id' => 1,
                'name' => 'Tech Support',
                'description' => 'Remote technical support',
                'price_per_hour' => 4500, // $45.00
                'minimum_hours' => 1,
                'maximum_hours' => 4,
                'is_available' => true,
                'image' => ''
            ]
        ];

        // Fashion Studio Services (Shop ID: 2)
        $fashionServices = [
            [
                'shop_id' => 2,
                'name' => 'Personal Styling',
                'description' => 'One-on-one styling consultation',
                'price_per_hour' => 8000, // $80.00
                'minimum_hours' => 2,
                'maximum_hours' => 6,
                'is_available' => true,
                'image' => ''
            ],
            [
                'shop_id' => 2,
                'name' => 'Clothing Alterations',
                'description' => 'Professional clothing alterations',
                'price_per_hour' => 4000, // $40.00
                'minimum_hours' => 1,
                'maximum_hours' => 3,
                'is_available' => true,
                'image' => ''
            ]
        ];

        // Home Essentials Services (Shop ID: 3)
        $homeServices = [
            [
                'shop_id' => 3,
                'name' => 'Home Organization',
                'description' => 'Professional home organization service',
                'price_per_hour' => 5500, // $55.00
                'minimum_hours' => 3,
                'maximum_hours' => 8,
                'is_available' => true,
                'image' => ''
            ],
            [
                'shop_id' => 3,
                'name' => 'Appliance Installation',
                'description' => 'Professional appliance installation',
                'price_per_hour' => 7000, // $70.00
                'minimum_hours' => 1,
                'maximum_hours' => 4,
                'is_available' => true,
                'image' => ''
            ]
        ];

        foreach ($techServices as $service) {
            Service::create($service);
        }

        foreach ($fashionServices as $service) {
            Service::create($service);
        }

        foreach ($homeServices as $service) {
            Service::create($service);
        }
    }
}

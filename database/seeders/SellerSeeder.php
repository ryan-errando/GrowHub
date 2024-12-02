<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sellers = [
            [
                'name' => 'Tech Haven',
                'email' => 'tech.haven@gmail.com',
                'password' => Hash::make('password'),
                'image' => '',
                'phone' => '12345678',
                'address' => 'jambi'
            ],
            [
                'name' => 'Fashion Studio',
                'email' => 'fashion.studio@gmail.com',
                'password' => Hash::make('password'),
                'image' => '',
                'phone' => '12345678',
                'address' => 'tangerang'
            ],
            [
                'name' => 'Home Essentials',
                'email' => 'home.essentials@gmail.com',
                'password' => Hash::make('password'),
                'image' => '',
                'phone' => '12345678',
                'address' => 'jakarta'
            ]
        ];

        foreach ($sellers as $seller) {
            Seller::create($seller);
        }
    }
}

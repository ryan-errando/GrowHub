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
                'email' => 'tech.haven@example.com',
                'password' => Hash::make('password123'),
                'profile_picture' => 'sellers/tech-haven.jpg'
            ],
            [
                'name' => 'Fashion Studio',
                'email' => 'fashion.studio@example.com',
                'password' => Hash::make('password123'),
                'profile_picture' => 'sellers/fashion-studio.jpg'
            ],
            [
                'name' => 'Home Essentials',
                'email' => 'home.essentials@example.com',
                'password' => Hash::make('password123'),
                'profile_picture' => 'sellers/home-essentials.jpg'
            ]
        ];

        foreach ($sellers as $seller) {
            Seller::create($seller);
        }
    }
}

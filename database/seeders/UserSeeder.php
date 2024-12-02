<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@gmail.com',
                'password' => Hash::make('password'),
                'profile_picture' => '',
                'address' => 'Jakarta'
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@gmail.com',
                'password' => Hash::make('password'),
                'profile_picture' => '',
                'address' => 'Tangerang'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

    }
}

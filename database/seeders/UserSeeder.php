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
        // Create an Admin user
        $users = [
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'middle_name' => null,
                'gender' => 'male',
                'date_of_birth' => '1990-01-01',
                'role' => 'admin',
                'status' => 'active',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'first_name' => 'Cashier',
                'last_name' => 'User',
                'middle_name' => null,
                'gender' => 'female',
                'date_of_birth' => '1995-05-10',
                'role' => 'cashier',
                'status' => 'active',
                'username' => 'cashier',
                'email' => 'cashier@gmail.com',
                'password' => Hash::make('password'),
            ]
        ];

        foreach ($users as $user) {
            User::factory()->create($user);
        }

    }
}
<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Category::factory(4)->create();

        Customer::create([
            'name' => 'robin',
            'balance' => 101.75,
        ]);

        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            // more seeder here
        ]);
    }
}
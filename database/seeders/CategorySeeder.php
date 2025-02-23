<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [
            [
                'type' => 'Food & Snacks',
                'description' => 'A selection of quick and tasty treats to satisfy cravings anytime.'
            ],
            [
                'type' => 'Beverages',
                'description' => 'Refreshing drinks to keep you hydrated and energized throughout the day.'
            ],
            [
                'type' => 'Canned & Packaged Goods',
                'description' => 'Convenient and long-lasting pantry essentials for everyday meals.'
            ],
            [
                'type' => 'Rice & Grains',
                'description' => 'Staple food items to keep meals filling and nutritious.'
            ],
            [
                'type' => 'Frozen & Fresh Products',
                'description' => 'Everyday essentials perfect for home-cooked meals and refreshments.'
            ],
            [
                'type' => 'Personal Care & Hygiene',
                'description' => 'Must-have grooming and hygiene products for daily self-care.'
            ],
            [
                'type' => 'Household Essentials',
                'description' => 'Cleaning and maintenance necessities for a tidy and safe home.'
            ],
            [
                'type' => 'Baby & Child Care',
                'description' => 'Special care products ensuring comfort and nourishment.'
            ],
            [
                'type' => 'Electronics & Accessories',
                'description' => 'Handy tech essentials to keep you connected and prepared.'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
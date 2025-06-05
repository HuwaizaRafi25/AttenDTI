<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'General',
            'Training',
            'Policy Updates',
            'New Hire',
        ];

        foreach ($categories as $categoryName) {
            Category::create(['category_name' => $categoryName]);
        }
    }
}

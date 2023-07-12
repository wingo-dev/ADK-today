<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ["name" => "Arts & Culture", "id" => 1,],
            ["name" => "Nightlife", "id" => 2,],
            ["name" => "Food & Spirits", "id" => 3,],
            ["name" => "Classes & Workshops", "id" => 4,],
            ["name" => "Kids", "id" => 5,],
            ["name" => "Pets", "id" => 6,],
            ["name" => "Family", "id" => 7,],
            ["name" => "Sports", "id" => 8,],
            ["name" => "Health & Fitness", "id" => 9,],
            ["name" => "Business & Networking", "id" => 10,],
            ["name" => "Community", "id" => 11,],

        ];

        Category::insert($categories);
    }
}

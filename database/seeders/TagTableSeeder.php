<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ["name" => "Theater", "category_id" => 1,],
            ["name" => "Concerts", "category_id" => 1,],
            ["name" => "Live Music", "category_id" => 1,],
            ["name" => "Performing Arts", "category_id" => 1,],
            ["name" => "Visual Arts", "category_id" => 1,],
            ["name" => "Galas", "category_id" => 1,],
            ["name" => "Film Screenings", "category_id" => 1,],
            ["name" => "Literary", "category_id" => 1,],
            ["name" => "Sightseeing & Tours", "category_id" => 1,],

        ];
        Tag::insert($tags);
    }
}

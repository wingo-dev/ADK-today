<?php

namespace Database\Seeders;

use App\Models\County;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $counties = [
            ["name" => "Clinton County", "id" => 1],
            ["name" => "Essex County", "id" => 2],
            ["name" => "Franklin County", "id" => 3],
            ["name" => "Fulton County", "id" => 4],
            ["name" => "Hamilton County", "id" => 5],
            ["name" => "Herkimer County", "id" => 6],
            ["name" => "Lewis County", "id" => 7],
            ["name" => "Oneida County", "id" => 8],
            ["name" => "Saratoga County", "id" => 9],
            ["name" => "St. Lawrence County", "id" => 10],
            ["name" => "Warren County", "id" => 11],
            ["name" => "Washington County", "id" => 12],
        ];

        County::insert($counties);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Town;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TownTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $towns = [
            ["name" => "Arietta", "county_id"    => 5],
            ["name" => "Benson", "county_id" => 5],
            ["name" => "Hope", "county_id"   => 5],
            ["name" => "Indian Lake", "county_id"    => 5],
            ["name" => "Inlet", "county_id"  => 5],
            ["name" => "Lake Pleasant", "county_id"  => 5],
            ["name" => "Long Lake", "county_id"  => 5],
            ["name" => "Morehouse", "county_id"  => 5],
            ["name" => "Wells", "county_id"  => 5],
            ["name" => "Speculator", "county_id" => 5],
            ["name" => "Blue Mountain Lake", "county_id" => 5],
            ["name" => "Cedar River", "county_id"    => 5],
            ["name" => "Cold River", "county_id" => 5],
            ["name" => "Gilman", "county_id" => 5],
            ["name" => "Hoffmeister", "county_id"    => 5],
            ["name" => "Lake Desolation", "county_id"    => 5],
            ["name" => "Lewey Lake", "county_id" => 5],
            ["name" => "Piseco", "county_id" => 5],
            ["name" => "Sabael", "county_id"    => 5],
            ["name" => "Raquette Lake", "county_id" => 5],
            ["name" => "Upper Benson", "county_id"  => 5],
            ["name" => "Wells", "county_id" => 5],
            ["name" => "West Canada Lake", "county_id"  => 5],

        ];
        Town::insert($towns);
    }
}

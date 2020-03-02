<?php

use App\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::create([
            'name' => "Liverpool",
            "county" => "England"
        ]);

        Team::create([
            'name' => "Chelsea",
            "county" => "England"
        ]);

        Team::create([
            'name' => "Man City",
            "county" => "England"
        ]);

        Team::create([
            'name' => "Arsenal",
            "county" => "England"
        ]);
    }
}

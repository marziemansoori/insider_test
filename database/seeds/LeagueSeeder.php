<?php

use App\League;
use Illuminate\Database\Seeder;

class LeagueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        League::create([
            'name' => "Premier League",
            "season" => "2019-2020",
            "from" => 2019,
            "to" => 2020,
            "county" => "England"
        ]);
    }
}

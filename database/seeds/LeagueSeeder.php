<?php

use App\League;
use App\Team;
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
        $teams = Team::all();

        /** @var Team $team */
        foreach ($teams as $team) {
            $teamsArray[] = [
                'id' => $team->getObjectId(),
                'name' => $team->name
            ];
        }

        League::create([
            'name' => "Premier League",
            "season" => "2019-2020",
            "from" => 2019,
            "to" => 2020,
            "county" => "England",
            'teams' => $teamsArray
        ]);
    }
}

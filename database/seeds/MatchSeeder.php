<?php

use App\League;
use App\Match;
use App\Team;
use Illuminate\Database\Seeder;

class MatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var League $league */
        $league = League::first();

        $teams = Team::all();

        $index = 1;
        /** @var Team $team */
        foreach ($teams as $team) {
            foreach ($teams as $team2) {
                if ($team->name == $team2->name) {
                    continue;
                }

                Match::create([
                    'league_id' => $league->getObjectId(),
                    'league_name' => 'Premier League',
                    'home_team' => [
                        'id' => $team->getObjectId(),
                        'name' => $team->name
                    ],
                    'away_team' => [
                        'id' => $team2->getObjectId(),
                        'name' => $team2->name
                    ],
                    'game_status' => "finished",
                    'week' => $index
                ]);

                Match::create([
                    'league_id' => $league->getObjectId(),
                    'league_name' => 'Premier League',
                    'home_team' => [
                        'id' => $team2->getObjectId(),
                        'name' => $team2->name
                    ],
                    'away_team' => [
                        'id' => $team->getObjectId(),
                        'name' => $team->name
                    ],
                    'game_status' => "finished",
                    'week' => $index
                ]);

                $index++;
            }
        }
    }
}

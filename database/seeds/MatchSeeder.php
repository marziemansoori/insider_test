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

                $data = [
                    'league_id' => $league->getObjectId(),
                    'league_name' => 'Premier League',
                    'game_status' => "finished",
                    'week' => $index,
                ];

                $firstMatch = Match::create(array_merge([
                    'home_team' => [
                        'id' => $team->getObjectId(),
                        'name' => $team->name
                    ],
                    'away_team' => [
                        'id' => $team2->getObjectId(),
                        'name' => $team2->name
                    ],
                    'result' => [
                        'home_team' => rand(0, 5),
                        'away_team' => rand(0, 5)
                    ],
                ], $data));

                $secondMatch = Match::create(array_merge([
                    'home_team' => [
                        'id' => $team2->getObjectId(),
                        'name' => $team2->name
                    ],
                    'away_team' => [
                        'id' => $team->getObjectId(),
                        'name' => $team->name
                    ],
                    'result' => [
                        'home_team' => rand(0, 4),
                        'away_team' => rand(0, 5)
                    ],
                ], $data));

                $index++;

                if($firstMatch->result['home_team'] > 0) {
                    $index = $firstMatch->result['home_team'];
                    while ($index > 0) {
                        $firstMatchIncidents[] = [
                            'type' => 'goal',
                            'team_id' => $firstMatch->home_team['id']
                        ];
                        $index--;
                    }
                }

                if($firstMatch->result['away_team'] > 0) {
                    $index = $firstMatch->result['away_team'];
                    while ($index > 0) {
                        $firstMatchIncidents[] = [
                            'type' => 'goal',
                            'team_id' => $firstMatch->away_team['id']
                        ];
                        $index--;
                    }
                }


                if($secondMatch->result['home_team'] > 0) {
                    $index = $secondMatch->result['home_team'];
                    while ($index > 0) {
                        $secondMatchIncidents[] = [
                            'type' => 'goal',
                            'team_id' => $secondMatch->home_team['id']
                        ];
                        $index--;
                    }
                }

                if($secondMatch->result['away_team'] > 0) {
                    $index = $secondMatch->result['away_team'];
                    while ($index > 0) {
                        $secondMatchIncidents[] = [
                            'type' => 'goal',
                            'team_id' => $secondMatch->away_team['id']
                        ];
                        $index--;
                    }
                }

                $firstMatch->incidents = $firstMatchIncidents ?? null;
                $firstMatch->save();
                $secondMatch->incidents = $secondMatchIncidents ?? null;
                $secondMatch->save();

                $firstMatchIncidents = [];
                $secondMatchIncidents = [];
            }
        }
    }
}

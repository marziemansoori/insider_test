<?php

namespace App\libs;


use App\Match;

class Standing
{
    public static function getStanding($matches)
    {
        $played = count($matches);
        $result = [];

        /** @var Match $match */
        foreach ($matches as $match) {
            $homeTeamStringId = (string)$match->home_team['id'];
            $awayTeamStringId = (string)$match->away_team['id'];

            $result[$homeTeamStringId] = [
                'team_name' => $match->home_team['name'],
                'played' => $played,
                'win' => ($match->result['home_team'] > $match->result['away_team'])
                    ? (isset($result[$homeTeamStringId]['win']) ? $result[$homeTeamStringId]['win'] + 1 : 1)
                    : (isset($result[$homeTeamStringId]['win']) ? $result[$homeTeamStringId]['win'] : 0),
                'draw' => ($match->result['home_team'] == $match->result['away_team'])
                    ? (isset($result[$homeTeamStringId]['draw']) ? $result[$homeTeamStringId]['draw'] + 1 : 1)
                    : (isset($result[$homeTeamStringId]['draw']) ? $result[$homeTeamStringId]['draw'] : 0),
                'loose' => ($match->result['home_team'] < $match->result['away_team'])
                    ? (isset($result[$homeTeamStringId]['loose']) ? $result[$homeTeamStringId]['loose'] + 1 : 1)
                    : (isset($result[$homeTeamStringId]['loose']) ? $result[$homeTeamStringId]['loose'] : 0),
                'goal_for' => isset($result[$homeTeamStringId]['goal_for'])
                    ? $result[$homeTeamStringId]['goal_for'] + $match->result['home_team']
                    : $match->result['home_team'],
                'goal_against' => isset($result[$homeTeamStringId]['goal_against'])
                    ? $result[$homeTeamStringId]['goal_against'] + $match->result['away_team']
                    : $match->result['away_team'],
            ];

            $result[$awayTeamStringId] = [
                'team_name' => $match->away_team['name'],
                'played' => $played,
                'win' => ($match->result['away_team'] > $match->result['home_team'])
                    ? (isset($result[$awayTeamStringId]['win']) ? $result[$awayTeamStringId]['win'] + 1 : 1)
                    : (isset($result[$awayTeamStringId]['win']) ? $result[$awayTeamStringId]['win'] : 0),
                'draw' => ($match->result['away_team'] == $match->result['home_team'])
                    ? (isset($result[$awayTeamStringId]['draw']) ? $result[$awayTeamStringId]['draw'] + 1 : 1)
                    : (isset($result[$awayTeamStringId]['draw']) ? $result[$awayTeamStringId]['draw'] : 0),
                'loose' => ($match->result['away_team'] < $match->result['home_team'])
                    ? (isset($result[$awayTeamStringId]['loose']) ? $result[$awayTeamStringId]['loose'] + 1 : 1)
                    : (isset($result[$awayTeamStringId]['loose']) ? $result[$awayTeamStringId]['loose'] : 0),
                'goal_for' => isset($result[$awayTeamStringId]['goal_for'])
                    ? $result[$awayTeamStringId]['goal_for'] + $match->result['away_team']
                    : $match->result['away_team'],
                'goal_against' => isset($result[$awayTeamStringId]['goal_against'])
                    ? $result[$awayTeamStringId]['goal_against'] + $match->result['home_team']
                    : $match->result['home_team'],
            ];
        }

        foreach ($result as $teamId => $standing) {
            $result[$teamId]['points'] = $standing['win'] * 3;
            $result[$teamId]['points'] = $result[$teamId]['points'] + $standing['draw'] * 1;
            $result[$teamId]['goal_difference'] = $standing['goal_for'] - $standing['goal_against'];
        }

        return $result;
    }
}

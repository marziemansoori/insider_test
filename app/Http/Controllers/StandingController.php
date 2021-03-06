<?php

namespace App\Http\Controllers;

use App\League;
use App\libs\PredictChampion;
use App\libs\Standing;
use App\Match;

class StandingController extends Controller
{
    public function index($week = 1)
    {
        /** @var League $premierLeague */
        $premierLeague = League::first();
        $matches = Match::where('week', '<=', (integer)$week)->where('league_id', $premierLeague->getObjectId())->get();
        $teams = $premierLeague->teams;
        $standings = (new Standing())
            ->setTeams($teams)
            ->setMatches($matches)
            ->getStanding();

        // TODO Do not hard code
        if($week < 12) {
            $predictions = (new PredictChampion($standings))->get();
        } else {
            $predictions = null;
        }

        return view('standing.index', compact('standings', 'matches', 'predictions'));
    }
}

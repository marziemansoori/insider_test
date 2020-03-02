<?php

namespace App\Http\Controllers;

use App\League;
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

        return view('standing.index', compact('standings', 'matches'));
    }
}

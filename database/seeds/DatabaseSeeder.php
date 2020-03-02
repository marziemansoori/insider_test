<?php

use App\League;
use App\Match;
use App\Team;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        League::query()->delete();
        Team::query()->delete();
        Match::query()->delete();

        $this->call(TeamSeeder::class);
        $this->call(LeagueSeeder::class);
        $this->call(MatchSeeder::class);
    }
}

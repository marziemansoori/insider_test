<?php


namespace App\libs;


class PredictChampion
{
    private $standings;

    public function __construct($standings)
    {
        $this->standings = $standings;
    }

    public function get()
    {
        $allPoints = 0;
        foreach($this->standings as $standing) {
            $allPoints += $standing['points'];
        }

        foreach ($this->standings as $teamId => $standing) {
            $predict[$teamId] = [
                'team_name' => $standing['team_name'],
                'predict' => round((($standing['points'] * 100) / $allPoints), 1)
            ];
        }

        return $predict ?? [];
    }
}

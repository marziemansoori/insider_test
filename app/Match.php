<?php

namespace App;


/**
 * Class Match
 * @package App
 *
 * @property mixed $id
 * @property mixed league_id
 * @property string league_name
 * @property string game_status
 * @property integer week
 * @property object result
 * @property object home_team
 * @property object away_team
 */
class Match extends MongoModel
{
    protected $dates = ['play_time'];

    public static $weekStrings = [
        1 => 'First', 2 => 'Second', 3 => 'Third', 4 => '4th', 5 => '5th', 6 => '6th',
        7 => '7th', 8 => '8th', 9 => '9th', 10 => '10th', 11 => '11th', 12 => '12th',
    ];
}

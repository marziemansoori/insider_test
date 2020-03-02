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
}

<?php

namespace App;


use Jenssegers\Mongodb\Eloquent\Model;

class MongoModel extends Model
{
    protected $connection = 'mongodb';

    public function getObjectId()
    {
        return objectId($this->id);
    }

    public function getStringId()
    {
        return (string)$this->id;
    }
}

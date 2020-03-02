<?php

use MongoDB\BSON\ObjectId;

function objectId($string)
{
    return new ObjectId($string);
}

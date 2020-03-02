<?php

function objectId($string)
{
    return new \MongoDB\BSON\ObjectId($string);
}

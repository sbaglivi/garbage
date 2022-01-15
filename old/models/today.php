<?php

include_once __DIR__."\..\helpers\functions.php";
include_once __DIR__."\..\helpers\garbageDb.php";

$db = new Database();
$data = $db->getCollectionTimesByWeekday(date("l"));

require __DIR__."/../views/index.php";
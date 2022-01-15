<?php
// echo(__DIR__."</br>");
// echo($_SERVER["DOCUMENT_ROOT"]."</br>");
// echo(__FILE__."</br>");
// echo(dirname(__FILE__)."</br>");
// echo(realpath(__DIR__."/../helpers/garbageDb.php")."<br>");
// echo(__DIR__."/../helpers/garbageDb.php");

include_once __DIR__."\..\helpers\garbageDb.php";
include_once __DIR__."/../helpers/functions.php";

$db = new Database();
$data = $db->getCollectionTimes();

require __DIR__."/../views/index.php";
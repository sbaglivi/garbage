<?php

$request = $_SERVER["REQUEST_URI"];

switch($request){
  case '/':
    require "models/index.php";
    break;
  case '/today':
    require "models/today.php";
    break;
  default:
    require "views/404.php";
    break;
}
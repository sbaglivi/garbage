<?php

require "helpers/garbageDb.php";
require "helpers/functions.php";
$db = new Database();
$request = $_SERVER["REQUEST_URI"];
$request_method = $_SERVER["REQUEST_METHOD"];
/* I get all the requests here, from here I need to redirect traffic to the API routes to controller files that return the relative JSON 
(I don't konw if I should check the request method here in conjunction with the request url or in the controller file)
- route to search (no filters = getall, filters = weekday, garbagetype, id), route to post (requires type, start and end time, weekday), route to update (requires id), route to delete (requires id)


*/
// var_dump(parse_url($request));
switch(parse_url($request, PHP_URL_PATH)){
  case '':
    require "";
    break;
  case '/posts':
    require("models/posts.php");
    break;
}

// switch($request){
//   case '/':
//     require "models/index.php";
//     break;
//   case '/today':
//     require "models/today.php";
//     break;
//   default:
//     require "views/404.php";
//     break;
// }
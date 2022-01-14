<?php

require "helpers/garbageDb.php";
require "helpers/functions.php";
require "router.php";
$db = new Database();
/* I get all the requests here, from here I need to redirect traffic to the API routes to controller files that return the relative JSON 
(I don't konw if I should check the request method here in conjunction with the request url or in the controller file)
- route to search (no filters = getall, filters = weekday, garbagetype, id), route to post (requires type, start and end time, weekday), route to update (requires id), route to delete (requires id)


*/
// var_dump(parse_url($request));
$request = $_SERVER["REQUEST_URI"];
$request_method = $_SERVER["REQUEST_METHOD"];
$request_path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$router = new Router();
$router->get("/", "models/posts.php");
// using a public method to instance the class and then return it, then you can chain non static methods on it. public static function | new static (or self); from within static function;
require $router->render($request_path, $request_method);
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
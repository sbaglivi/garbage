<?php

$router = new Router();
// Read
$router->get("/", "PagesController@showPickups");
$router->get("/pickups", "PagesController@showPickups");
// Search
$router->get("/search", "PagesController@searchPickups");
// Create
$router->get("/pickups/add", "PagesController@showAddForm");
$router->post("/pickups", "PagesController@createPickup");
// Update
$router->put("/pickups", "PagesController@updatePickup");
// Delete
$router->delete("/delete", "PagesController@deletePickup");
// using a public method to instance the class and then return it, then you can chain non static methods on it. public static function | new static (or self); from within static function;
return $router;

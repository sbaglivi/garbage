<?php
$router = new Router();

// Routes for an example application that interacts with the database through the API
$router->get("/", "PagesController@showIndex");
$router->get("/search", "PagesController@showSearch");

// API ROUTES
// Read
$router->get("/api", "PagesController@getPickups");
// Search
$router->get("/api/search", "PagesController@searchPickups");
// Create
$router->post("/api/pickups", "PagesController@createPickup");
// Update
$router->put("/api/pickups", "PagesController@updatePickup");
// Delete
$router->delete("/api/delete", "PagesController@deletePickup");

return $router;

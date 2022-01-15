<?php
require "vendor/autoload.php";
require "helpers/functions.php";
$request_method = $_SERVER["REQUEST_METHOD"];
$request_path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
// echo_nl($request_path);
// $request_fragments = explode("/", $request_path);
$router = require("routes/routes.php");
$router->render($request_path, $request_method);

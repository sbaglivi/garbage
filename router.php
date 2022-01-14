<?php

class Router {
    protected $getRoutes = [];
    protected $postRoutes = [];
    protected $deleteRoutes = [];
    public function post($path, $model){
        if(!array_key_exists($path, $this->postRoutes)){
            $this->postRoutes[$path] = $model;
        } else {
            throw new Exception("There's already a POST path for $path");
        }
    }     
    public function get($path, $model){
        if(!array_key_exists($path, $this->getRoutes)){
            $this->getRoutes[$path] = $model;
        } else {
            throw new Exception("There's already a GET path for $path");
        }
    }     
    public function render($path, $method){
        switch($method){
            case "GET":
                return array_key_exists($path, $this->getRoutes) ? $this->getRoutes[$path] : "models/404.php";
            case "POST":
                return array_key_exists($path, $this->postRoutes) ? $this->postRoutes[$path] : "models/404.php";
            case "GET":
                return array_key_exists($path, $this->deleteRoutes) ? $this->deleteRoutes[$path] : "models/404.php";
            default:
                throw new Exception("Invalid HTTP Method, accepted are: GET, POST, DELETE");
        }
    }
}

<?php
// TEMP
class Router
{
  protected $getRoutes = [];
  protected $putRoutes = [];
  protected $postRoutes = [];
  protected $deleteRoutes = [];
  public function post($path, $model)
  {
    if (!array_key_exists($path, $this->postRoutes)) {
      $this->postRoutes[$path] = $model;
    } else {
      throw new Exception("There's already a POST path for $path");
    }
  }
  public function put($path, $model)
  {
    if (!array_key_exists($path, $this->putRoutes)) {
      $this->putRoutes[$path] = $model;
    } else {
      throw new Exception("There's already a PUT path for $path");
    }
  }
  public function get($path, $model)
  {
    if (!array_key_exists($path, $this->getRoutes)) {
      $this->getRoutes[$path] = $model;
    } else {
      throw new Exception("There's already a GET path for $path");
    }
  }
  public function delete($path, $model)
  {
    if (!array_key_exists($path, $this->deleteRoutes)) {
      $this->deleteRoutes[$path] = $model;
    } else {
      throw new Exception("There's already a DELETE path for $path");
    }
  }
  protected function callController($controllerName, $action)
  {
    $controller = new $controllerName;
    if (!method_exists($controller, $action)) {
      throw new Exception("$action does to exist in $controllerName");
    }
    $controller->$action();
  }
  protected function findMatch($path, $routesArray)
  {
    $partialPath = $path;
    // dump($routesArray);
    while ($partialPath !== "") {
      if (array_key_exists($partialPath, $routesArray)) {
        return $routesArray[$partialPath];
      }
      // echo_nl('|' . $partialPath . '|');
      $partialPath = substr($partialPath, 0, strrpos($partialPath, "/"));
    }
    die("No path found for $path");
  }

  public function render($path, $method)
  {
    switch ($method) {
      case "GET":
        // array_key_exists($path, $this->getRoutes) ? $this->callController(...explode("@", $this->getRoutes[$path])) : die("No $method method defined for path $path");
        $this->callController(...explode("@", $this->findMatch($path, $this->getRoutes)));
        break;
      case "PUT":
        $this->callController(...explode("@", $this->findMatch($path, $this->putRoutes)));
        break;
      case "POST":
        $this->callController(...explode("@", $this->findMatch($path, $this->postRoutes)));
        break;
      case "DELETE":
        $this->callController(...explode("@", $this->findMatch($path, $this->deleteRoutes)));
        break;
      default:
        throw new Exception("Invalid HTTP Method, accepted are: GET, POST, PUT, DELETE");
    }
  }
}

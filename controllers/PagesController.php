<?php

class PagesController
{
  protected $db;
  public function __construct()
  {
    require __DIR__ . "/../helpers/config.php";
    $this->db = new Database($dbconfig);
  }
  // Views for the example application
  public function showIndex()
  {
    require __DIR__ . "/../views/index.php";
  }
  public function showSearch()
  {
    require __DIR__ . "/../views/search.php";
  }

  // API Methods
  public function getPickups()
  {
    $data = $this->db->fetchAll();
    http_response_code(200);
    header("Content-type:application/json");
    echo (json_encode(["data" => $data]));
  }
  public function createPickup()
  {
    $result = $this->db->insert($_POST["type"], $_POST["weekday"], $_POST["startTime"], $_POST["endTime"]);
    if (!$result) {
      http_response_code(409);
      echo (json_encode(["error" => "There's already a pickup identical to the one you tried to insert"]));
      return;
    }
    http_response_code(201);
  }
  public function deletePickup()
  {
    preg_match("/^\/api\/delete\/(\d+)$/", parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), $results);
    if (count($results) !== 2) {
      http_response_code(400);
      echo (json_encode(["error" => "The request is not properly formatted. It should be /api/delete/:id"]));
      return;
    }
    $id = $results[1];
    $result = $this->db->delete($id);
    if ($result === 0) {
      http_response_code(409);
      echo (json_encode(["error" => "There is no pickup with the id provided"]));
    } else {
      http_response_code(200);
    }
  }
  public function updatePickup()
  {
    parse_str(file_get_contents("php://input"), $data);
    $errorMessage = $this->db->update($data["id"], $data["type"], $data["startTime"], $data["endTime"], $data["weekday"]);
    if ($errorMessage === "") {
      http_response_code(200);
      return;
    }
    http_response_code(409);
    echo (json_encode(["error" => $errorMessage]));
  }
  public function searchPickups()
  {
    $params = [];
    $queryString = parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY);

    foreach (explode("&", $queryString) as $i => $query) {
      [$queryName, $queryValue] = explode("=", $query);
      if ($queryName === "") {
        break;
      }
      $params[$queryName] = $queryValue;
    }
    $data = $this->db->get($params);
    header("Content-type: application/json");
    echo (json_encode(["data" => $data]));
  }
}

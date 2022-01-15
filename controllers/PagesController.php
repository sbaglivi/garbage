<?php
class PagesController
{
  protected $db;
  public function __construct()
  {
    require __DIR__ . "/../helpers/config.php";
    $this->db = new Database($dbconfig);
  }
  public function showPickups()
  {
    // db fetch all
    $data = $this->db->fetchAll();
    require __DIR__ . "/../views/index.php";
  }
  public function createPickup()
  {
    // dump($_POST);
    // db create pick up
    $this->db->insert($_POST["type"], $_POST["weekday"], $_POST["startTime"], $_POST["endTime"]);
    redirect("/");
  }
  public function showAddForm()
  {
    require __DIR__ . "/../views/add.php";
  }
  public function deletePickup()
  {
    // I can't specify the form action in html if I want to keep it api like since I need it to contain the id from the input, I tried submitting it from javascript but it doesn't seem to do anything.
    // db delete pick up
    // http_response_code(201);
    $request_fragments = explode("/", parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
    $this->db->delete($request_fragments[2]);
    echo (json_encode(["redirect" => "/"]));
  }
  public function updatePickup()
  {
    // db update pick up
    redirect("/");
  }
  public function searchPickups()
  {
    // db search pickups
    require __DIR__ . "/../views/index.php";
  }
}

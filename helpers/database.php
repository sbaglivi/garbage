<?php
const column_values = ["weekday", "type", "id"];
class Database
{
  protected $pdo;
  public function __construct($dbconfig)
  {
    $this->pdo = new PDO('mysql:host=' . $dbconfig["host"] . ';dbname=' . $dbconfig["dbname"], $dbconfig["user"], $dbconfig["password"]);
  }
  public function fetchAll()
  {
    try {
      $stmt = $this->pdo->prepare("SELECT * FROM collectiontime");
      $stmt->execute();
    } catch (Exception $e) {
      throw $e;
    }
    return $stmt->fetchAll(PDO::FETCH_CLASS, "Pickup");
  }
  public function getCollectionTimesByWeekday($weekday)
  {
    $stmt = $this->pdo->prepare("SELECT * FROM collectiontime WHERE weekday = :weekday");
    $stmt->bindParam(':weekday', $weekday);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_CLASS, "Pickup");
  }
  public function get($queryArray)
  {
    // RIGHT NOW THE KEY NAME IS NOT SANITIZED OUTSIDE OF CHEKCING IF IN PRESET COLUMN VALUES
    try {
      if ($queryArray == []) {
        $stmt = $this->pdo->prepare("SELECT * FROM collectiontime");
      } else {
        $queryString = "SELECT * FROM collectiontime WHERE";
        foreach ($queryArray as $i => $query) {
          $key = key($query);
          if (!in_array($key, column_values)) {
            throw new Exception("Invalid column name $key");
          }
          $value = current($query);
          if ($i === 0) {
            $queryString = $queryString . " $key = :$value";
            continue;
          }
          $queryString = $queryString . " AND $key = :$value";
        }
        echo ("</br>$queryString</br>");

        $stmt = $this->pdo->prepare($queryString);
        foreach ($queryArray as $i => $query) {
          $key = key($query);
          $value = current($query);
          echo ("$key : $value</br>");
          $stmt->bindParam(":$value", $value);
        }
      }
      $stmt->execute();
    } catch (Exception $e) {
      throw $e;
    }
    return $stmt->fetchAll(PDO::FETCH_CLASS, "Pickup");
  }
  public function insert($type, $weekday, $startTime, $endTime)
  {
    $stmt = $this->pdo->prepare("INSERT INTO collectiontime (type, weekday, starttime, endtime) VALUES (:type, :weekday, :starttime, :endtime)");
    $stmt->execute([":type" => $type, ":weekday" => $weekday, ":starttime" => $startTime, ":endtime" => $endTime]);
  }
  public function delete($id)
  {
    $stmt = $this->pdo->prepare("DELETE FROM collectiontime WHERE id = :id");
    $stmt->execute([":id" => $id]);
  }
}

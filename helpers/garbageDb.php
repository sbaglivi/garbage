<?php
include_once __DIR__ . "/../garbageCollectionClass.php";
const column_values = ["weekday", "type", "id"];
class Database
{
  public function __construct()
  {
    $this->pdo = new PDO('mysql:host=localhost;dbname=garbage', 'root', 'toor');
  }
  public function getCollectionTimes()
  {
    $stmt = $this->pdo->prepare("SELECT * FROM collectiontime");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_CLASS, "GarbageCollection");
  }
  public function getCollectionTimesByWeekday($weekday)
  {
    $stmt = $this->pdo->prepare("SELECT * FROM collectiontime WHERE weekday = :weekday");
    $stmt->bindParam(':weekday', $weekday);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_CLASS, "GarbageCollection");
  }
  public function get($queryArray)
  {
    // RIGHT NOW THE KEY NAME IS NOT SANITIZED OUTSIDE OF CHEKCING IF IN PRESET COLUMN VALUES
    if ($queryArray == []) {
      $stmt = $this->pdo->prepare("SELECT * FROM collectiontime");
    } else {
      $queryLen = count($queryArray);
      $queryString = "SELECT * FROM collectiontime WHERE";
      foreach ($queryArray as $i => $query) {
        $key = key($query);
        if (!in_array($key, column_values)) {
          echo ("Invalid column name $key");
          return;
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
        //  $stmt->bindParam(":$key", $key); 
        $stmt->bindParam(":$value", $value);
      }
    }
    $stmt->execute();
    echo ($stmt->rowCount());
    return $stmt->fetchAll(PDO::FETCH_CLASS, "GarbageCollection");
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

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
  public function get($queryArray)
  {
    try {
      if ($queryArray == []) {
        $stmt = $this->pdo->prepare("SELECT * FROM collectiontime");
        $stmt->execute();
      } else {
        $queryString = "SELECT * FROM collectiontime WHERE";
        $firstParam = true;
        foreach (array_keys($queryArray) as $key) {
          if (!in_array($key, column_values)) {
            throw new Exception("Invalid column name $key");
          }
          if ($firstParam) {
            $queryString = $queryString . " $key = ?";
            $firstParam = false;
            continue;
          }
          $queryString = $queryString . " AND $key = ?";
        }

        $stmt = $this->pdo->prepare($queryString);
        $stmt->execute(array_values($queryArray));
      }
    } catch (Exception $e) {
      throw $e;
    }
    return $stmt->fetchAll(PDO::FETCH_CLASS, "Pickup");
  }
  public function insert($type, $weekday, $startTime, $endTime)
  {

    try {
      $stmt = $this->pdo->prepare("SELECT * FROM collectiontime WHERE type = ? AND weekday = ? AND starttime = ? and endtime = ?");
      $stmt->execute([$type, $weekday, $startTime, $endTime]);
      if ($stmt->rowCount() > 0) return false;
      $stmt = $this->pdo->prepare("INSERT INTO collectiontime (type, weekday, starttime, endtime) VALUES (:type, :weekday, :starttime, :endtime)");
      $stmt->execute([":type" => $type, ":weekday" => $weekday, ":starttime" => $startTime, ":endtime" => $endTime]);
      return true;
    } catch (PDOException $e) {
      throw $e;
    }
  }
  public function delete($id)
  {
    $stmt = $this->pdo->prepare("DELETE FROM collectiontime WHERE id = :id");
    $stmt->execute([":id" => $id]);
    return $stmt->rowCount();
  }
  public function update($id, $type, $startTime, $endTime, $weekday)
  {
    try {
      $stmt = $this->pdo->prepare("SELECT * FROM collectiontime WHERE id = ?");
      $stmt->execute([$id]);
      if ($stmt->rowCount() === 0) {
        return "No rows with id $id";
      }
      $stmt = $this->pdo->prepare("SELECT * FROM collectiontime WHERE id = ? AND type = ? AND starttime = ? AND endtime = ? AND weekday = ?");
      $stmt->execute([$id, $type, $startTime, $endTime, $weekday]);
      if ($stmt->rowCount() > 0) {
        return "Element with id $id is already equal to the data provided";
      }
      $stmt = $this->pdo->prepare("UPDATE collectiontime SET type = ?, starttime = ?, endtime = ?, weekday = ? WHERE id = ?");
      $stmt->execute([$type, $startTime, $endTime, $weekday, $id]);
      if ($stmt->rowCount() === 1) {
        return "";
      }
      return "Could not update";
    } catch (PDOException $e) {
      throw $e;
    }
  }
}

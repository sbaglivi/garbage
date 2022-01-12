<?php
include_once __DIR__."/../garbageCollectionClass.php";
class Database {
    public function __construct(){
        $this->pdo = new PDO('mysql:host=localhost;dbname=garbage', 'root', 'toor');
    }
    public function getCollectionTimes(){
        $stmt = $this->pdo->prepare("SELECT * FROM collectiontime");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "GarbageCollection");
    }
    public function getCollectionTimesByWeekday($weekday){
       $stmt = $this->pdo->prepare("SELECT * FROM collectiontime WHERE weekday = :weekday");
       $stmt->bindParam(':weekday', $weekday);
       $stmt->execute();
       return $stmt->fetchAll(PDO::FETCH_CLASS, "GarbageCollection");
    }
}
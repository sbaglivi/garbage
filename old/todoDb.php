<?php
include_once "./todoClass.php";
class DBConnection {
    public $pdo;
    public function __construct(){
        try {
            $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=test', 'root', 'toor');
        } catch (PDOException $e) {
            die($e);
        };
        return $this;
    }
    public function getAllTodos(){
        $stmnt = $this->pdo->prepare("SELECT * FROM todos");
        $stmnt->execute();
        return $stmnt->fetchAll(PDO::FETCH_CLASS, "Todo");
    }

}

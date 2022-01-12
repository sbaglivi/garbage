<?php
include_once "./garbageDb.php";
$db = new Database();
$data = $db->getCollectionTimes();
// $pdo = new PDO("mysql:host=localhost;port=3306;dbname=test",'root','toor');
// $stmnt = $pdo->prepare("SELECT * FROM todos");
// $stmnt->execute();
// $data = $stmnt->fetchAll();
// weekday starttime endtime garbagetype
function printCollectionTime($collectionTimeList){
    foreach ($collectionTimeList as $collectionTime){
        // echo($todo->id." - ".$todo->text.($todo->done ? " - Done!" : " - Not done")."</br>");
        echo($collectionTime->id.": ".$collectionTime->type." ".substr($collectionTime->startTime, 0, 5)." - ".substr($collectionTime->endTime,0,5)." ".$collectionTime->weekday."</br>");
    }
}
printCollectionTime($data);
$data = $db->getCollectionTimesByWeekday("Monday");
echo("On Monday we collect:</br>");
printCollectionTime($data);
// var_dump($data);
echo("Today we collect:</br>");
$data = $db->getCollectionTimesByWeekday(date("l"));
printCollectionTime($data);
echo("Hello World!");
echo date("l");


echo('worked');
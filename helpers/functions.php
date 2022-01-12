<?php
function printCollectionTime($collectionTimeList){
    foreach ($collectionTimeList as $collectionTime){
        // echo($todo->id." - ".$todo->text.($todo->done ? " - Done!" : " - Not done")."</br>");
        echo($collectionTime->id.": ".$collectionTime->type." ".substr($collectionTime->startTime, 0, 5)." - ".substr($collectionTime->endTime,0,5)." ".$collectionTime->weekday."</br>");
    }
}
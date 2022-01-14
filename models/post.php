<?php
dump($_POST);
$db->insert($_POST["type"], $_POST["weekday"], $_POST["startTime"], $_POST["endTime"]);
header("Location: /");

<?php
echo_nl($_REQUEST["id"]);
$db->delete($_REQUEST["id"]);
header("Location: /");

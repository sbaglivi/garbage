<?php 
if ($_SERVER["REQUEST_METHOD"] !== "GET"){
  echo("The /posts route only accepts GET requests");
  return;
}
$params = [];
echo("query = ");
var_dump(parse_url($request, PHP_URL_QUERY));
echo("</br>");
foreach(explode("&", parse_url($request, PHP_URL_QUERY)) as $i => $query){
  [$queryName, $queryValue] = explode("=",$query);
  if ($queryName === ""){
    break;
  }
  array_push($params, [$queryName => $queryValue]);
}
var_dump($params);
echo($params == []);
echo("count = ".count($params));
$data = $db->get($params);
require __DIR__."/../views/index.php";
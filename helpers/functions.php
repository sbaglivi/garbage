<?php
function dump($var)
{
  echo ("</br><pre>");
  var_dump($var);
  echo ("</pre></br>");
}
function echo_nl($text)
{
  echo ($text . "</br>");
}
function redirect($path)
{
  header("Location: $path");
}

<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header("Content-type: application/json; charset=utf-8");
error_reporting(E_ALL);
ini_set("display_errors", 0);

require('films.php');
$userFilms = [];

function get_film($id) {
  $films = get_films();
  $result = $films;
  return $result;
}



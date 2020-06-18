<?php
header('Access-Control-Allow-Headers: *');
header("Content-type: application/json; charset=utf-8");
error_reporting(E_ALL);
ini_set("display_errors", 0);

require('films.php');
//require('usersfilms.php');

$res = get_film(1);
print_r($res);

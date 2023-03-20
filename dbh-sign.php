<?php
/*
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "ecommercesignup";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if(!$conn){
    die("Connection Failed: ".mysqli_connect_error());
}*/

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ecommercesignup');
define('DB_PORT', 3307);

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

if(!$link){
    die("Connection Failed: ".mysqli_connect_error());
}
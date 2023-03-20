<?php
/*
define('DB_SERVER', 'fdb33.awardspace.net');
define('DB_USERNAME', '4146299_bulacan');
define('DB_PASSWORD', 'jonojohn123');
define('DB_NAME', '4146299_bulacan');
define('DB_PORT', 3306);

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$link){
    die("Connection Failed: ".mysqli_connect_error());
}
*/

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ecommercesignup');
define('DB_PORT', 3307);

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

if(!$link){
    die("Connection Failed: ".mysqli_connect_error());
}

?>
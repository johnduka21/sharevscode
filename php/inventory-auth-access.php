<?php
    require_once 'php/dbh.php';
    require_once 'inventory-login.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header("location: inventory-login.php?page=login");
    } else if(isset($_SESSION['login'])) {
        header("location: inventory-dashboard.php");
    }
?>
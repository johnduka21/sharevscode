<?php
    session_start();
    session_unset();
    session_destroy();

    header("location: ../ecom-sign-in.php");
    exit();
?>
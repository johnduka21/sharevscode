<?php
   session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/960bfa3deb.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulacan Pet Fish | Admin Login</title>
    <link rel="stylesheet" href="css/inventory-login.scss">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
</head>

<?php
    require "php/dbh.php";
    //Inventory Login Code
    if(isset($_POST['login'])){
        $username = mysqli_real_escape_string($link, $_POST['username']);
        $password= mysqli_real_escape_string($link, $_POST['password']);
        $query = "SELECT * FROM `admin_login` WHERE `admin_user`='$username' AND `admin_pass`='$password'";
        $result = mysqli_query($link, $query);
        if(mysqli_num_rows($result)==1){
            echo"<script>alert('Login Successfully.');</script>";
            $_SESSION['adminlogin']= $username;
            echo("<script>location.href = 'inventory-dashboard.php';</script>");
        }
        else {
            echo"<script>alert('Incorrect Login.');</script>";
        }
    }
?>

<body>
    <div class="main-container">
        <div class="login-container">
            <div class="top-container">
                <img class ="logo" src="images/PlaceholderFavIcon.ico" alt="">
                <h2>Bulacan Pet Fish Supply</h2>
                <p>Admin Login</p>
            </div>

            <form method="POST">
                <div class="enter-user">
                    <label for="username">Username </label>
                    <input type="text" name="username" required>
                </div>
                <div class="enter-pass">
                    <label>Password </label>
                    <input type="password" name="password" required>
                </div>
                <button class="login-btn" type="submit" name="login">LOGIN</button>
            </form>
        </div>
    </div>
</body>
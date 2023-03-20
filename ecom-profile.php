<?php
include 'ecom-header.php';
$usersid = $_SESSION['usersid'];

$select_users = "SELECT * FROM users WHERE usersId='$usersid'";
$run_users = mysqli_query($link, $select_users);
if(mysqli_num_rows($run_users) > 0){
$row = mysqli_fetch_array($run_users);

if(isset($_POST["update-profile"])){
  // require_once 'dbh.php';
  // require_once 'functions.php';
  
  $fname = mysqli_real_escape_string($link, $_POST["fname"]);
  $lname = mysqli_real_escape_string($link, $_POST["lname"]);
  $email = mysqli_real_escape_string($link, $_POST["email"]);
  $contact = mysqli_real_escape_string($link, $_POST["contact"]);
  $address = mysqli_real_escape_string($link, $_POST["address"]);
  $barangay = mysqli_real_escape_string($link, $_POST["barangay"]);
  $city = mysqli_real_escape_string($link, $_POST["city"]);
  $postal = mysqli_real_escape_string($link, $_POST["postal"]);
  $username = mysqli_real_escape_string($link, $_POST["username"]);
  $oldPwd = mysqli_real_escape_string($link, $_POST["old-password"]);
  $newPwd = mysqli_real_escape_string($link, $_POST["new-password"]);
  $pwdRepeat = mysqli_real_escape_string($link, $_POST["pwdrepeat"]);

  $update_profile = "UPDATE users SET usersFirstName='$fname', usersLastName='$lname', usersEmail='$email', user_contact='$contact', user_address='$address', user_brgy='$barangay', user_city='$city', user_postal='$postal', usersUid='$username' WHERE usersId='$usersid'";
  
  $run_update = mysqli_query($link, $update_profile);

  if(isset($_POST['new-password'])){
    if($newPwd !== $pwdRepeat){
      echo "<script>alert('Something went wrong. Passwords don't match.')</script>";
      header("location: ecom-profile.php?passdontmatch");
      exit();
    } else {
      if(password_verify($oldPwd, $row['usersPwd'])){
        $hashedPwd = password_hash($newPwd, PASSWORD_DEFAULT);
        $update_password = "UPDATE `users` SET usersPwd='$hashedPwd' WHERE usersId='$usersid'";
        $run_pass = mysqli_query($link, $update_password);
      } else {
        echo "<script>alert('Something went wrong. Wrong old password.')</script>";
        header("location: ecom-profile.php?wrongoldpass");
        exit();
      }
    }
  }

  if($run_update){
    echo "<script>alert('Profile updated successfully!')</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/960bfa3deb.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>
    <link rel="stylesheet" href="css/ecom-sign-up-new.scss">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
</head>

<body>
<div class="main-container">
  <div class="login-container">
    <div class="logo-flex">
        <img class ="logo" src="images/PlaceholderFavIcon.ico" alt="">
    </div>

    <form action="" method="post" enctype="multipart/form-data">
    <!-- Sign-Up Header -->
    <div class="top-part">
        <h3>Welcome <?php echo $row['usersFirstName']?>!</h3>

        <!-- Sign-Up Header -->
        <h1>Edit Profile</h1>
    </div>

    <!-- Enter Fname -->
    <label for="fname">First Name: </label>
    <input type="text" name="fname" placeholder="First Name..." value ="<?php echo $row['usersFirstName']?>">

    <!-- Enter Lname -->
    <label for="lname">Last Name: </label>
    <input type="text" name="lname" placeholder="Last Name..." value="<?php echo $row['usersLastName']?>">

    <!-- Enter Email -->
    <label for="email">Email: </label>
    <input type="text" name="email" value="<?php echo $row['usersEmail']?>" placeholder ="Email...">

    <!-- Enter Contact -->
    <label for="contact">Phone Number (09--): </label>
    <!-- <input type="number" name="contact" maxlength="11" placeholder ="Phone Number..."> -->
    <input name="contact" value="<?php echo $row['user_contact']?>" placeholder ="Phone Number..." oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" min="11" maxlength = "11">

    <!-- Enter Address -->
    <label for="address">Address (House No, Street): </label>
    <input type="text" name="address" value="<?php echo $row['user_address']?>" placeholder ="Address...">
    <label for="address">Barangay </label>
    <input type="text" name="barangay" value="<?php echo $row['user_brgy']?>" placeholder ="Brgy...">
    <label for="address">City</label>
    <input type="text" name="city" value="<?php echo $row['user_city']?>" placeholder ="City...">
    <label for="address">Postal Code</label>
    <input type="text" name="postal" value="<?php echo $row['user_postal']?>" placeholder ="Postal code...">

    <!-- Enter Username -->
    <label for="username">Username: </label>
    <input type="text" name="username" value="<?php echo $row['usersUid']?>" placeholder ="Username...">

    <!-- Enter Password -->
    <label for="password">Old Password: </label>
    <input type="password" name="old-password" placeholder ="Old Password...">

    <!-- Enter Password -->
    <label for="password">New Password: </label>
    <input type="password" name="new-password" placeholder ="New Password...">

    <!-- Confirm Password -->
    <label for="password">Confirm Password: </label>
    <input type="password" name="pwdrepeat" placeholder ="Repeat Password...">
    
    <!-- Click Login Button -->
    <button style="background-color: #0062E4;" class="login-btn" onClick="javascript: return confirm('Are You Sure You Want to Update Your Profile?');" type="submit" name="update-profile">Update Profile</button>
    </form>
  </div>
</div>

<?php } ?>

</body>
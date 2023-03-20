<?php
include 'ecom-header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/960bfa3deb.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
    <title>Profile</title>
    <link rel="stylesheet" href="css/ecom-profile.scss">
</head>
<body>
<?php if(isset($_SESSION['usersuid'])){?>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

<body>
  <div class="main-content">
    <!-- Header -->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 200px; background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Your Orders</h1>
            <p class="text-white mt-0 mb-5">This is your profile page. Here you can edit your profile, change password, and view your current and completed orders.</p>
            <a href="#!" class="btn btn-info">Edit Profile</a>
            <a href="#!" class="btn btn-info">My Orders</a>
            <a href="#!" class="btn btn-info">Completed Orders</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                </div>
              </div>
              <div class="text-center">
                <h1>
                  1
                </h1>
                <div class="h5 font-weight-300">
                <h3>
                  My Orders
                </h3>
                </div>
                <hr class="my-4">
                <p>Scroll down to view your orders.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">My account</h3>
                </div>
              </div>
            </div>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Points</th>
                        <th>Points</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dom</td>
                        <td>6000</td>
                    </tr>
                    <tr class="active-row">
                        <td>Melissa</td>
                        <td>5150</td>
                    </tr>
                    <!-- and so on... -->
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-6 m-auto text-center">
        <div class="copyright">
        </div>
      </div>
    </div>
  </footer>
</body>
<?php } ?>
</body>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Garbage Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
  <link rel="stylesheet" href="bootstrap-3.4.1-dist/css/bootstrap.min.css">
  <script src="jquery.min.js"></script>
  <script src="bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
  <style>
   .body_img {
    background-image: url('img.jpeg');
    background-repeat: no-repeat;
    background-attachment: fixed;  
    background-size: cover;
  }
</style>
</head>
<body>

  <?php
  session_start();
  ?>

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="Home.php">Garbage Management system</a>
      </div>
      <ul class="nav navbar-nav navbar-left">
       <?php if(isset($_SESSION['USERTYPEID']) and ($_SESSION['USERTYPEID'] == 2 || $_SESSION['USERTYPEID'] == 1)) { ?>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Complaints<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="Complaints.php">Create Complaint</a></li>
            <li><a href="ViewComplaints.php">View Complaints</a></li>
          </ul>
        </li>
      <?php } ?>
    </ul>
    <?php if(isset($_SESSION['USERTYPEID'])) { ?>
      <ul class="nav navbar-nav navbar-left">
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Payments<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php if(isset($_SESSION['USERTYPEID']) and $_SESSION['USERTYPEID'] == 1) { ?>
              <li><a href="Payment.php">Create Payment</a></li>
            <?php } ?>
            <li><a href="ViewPayments.php">View Payments</a></li>
          </ul>
        </li>
      </ul>
    <?php } ?>
    <?php if(isset($_SESSION['USERTYPEID'])) { ?>
      <ul class="nav navbar-nav navbar-left">
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Locations<span class="caret"></span></a>
          <ul class="dropdown-menu">
           <?php if(isset($_SESSION['USERTYPEID']) and $_SESSION['USERTYPEID'] == 1) { ?>
            <li><a href="Locations.php">Create Location</a></li>
          <?php } ?>
          <li><a href="ViewLocations.php">View Locations</a></li>
        </ul>
      </li>
    </ul>
  <?php } ?>

  <?php if(isset($_SESSION['USERTYPEID'])) { ?>
    <ul class="nav navbar-nav navbar-left">
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Collection<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <?php if(isset($_SESSION['USERTYPEID']) and $_SESSION['USERTYPEID'] != 3) { ?>
            <li><a href="Request.php">Create Collection Request</a></li>
          <?php } ?>
          <li><a href="ViewRequests.php">View Collection Request</a></li>
        </ul>
      </li>
    </ul>
  <?php } ?>
  
  <?php if(isset($_SESSION['USERTYPEID'])) { ?>
    <ul class="nav navbar-nav navbar-left">
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">View Users<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="ViewHouseOwners.php">View House Owners</a></li>
          <li><a href="ViewWorkers.php">View Workers</a></li>
        </ul>
      </li>
    </ul>
  <?php } ?>
  <ul class="nav navbar-nav navbar-right">
    <?php

      // Set session variables
    if(!isset($_SESSION['USERID']))
    {
      ?>
      <li ><a href="Registration.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li  ><a href="Login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      <?php
    }
    else
    {
      ?>
      <li   ><a href="?logout"><span class="glyphicon glyphicon-log-out" ></span> Logout</a></li>
      <?php
    }
    ?>
  </ul>
</div>
</nav>

</body>
</html>

<?php

if (isset($_GET['logout']))
{

  // remove all session variables
  session_unset();

// destroy the session
  session_destroy();
  echo "<script> location.href='http://localhost/GMS/Home.php'; </script>";
  exit;

} 



?>

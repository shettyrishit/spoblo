<?php

include_once("class/config.php");

$pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
if ($_SERVER["SERVER_PORT"] != "80")
{
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
} 
else 
{
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
}
$_SESSION['prevpageurl']= $pageURL;
?>

<!doctype html>

<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title></title>
    <script>window.status = ' ';</script>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css"> <!-- Bootstrap -->
    <link rel="stylesheet" href="css/magnific-popup.css">  <!-- magnific -->    
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" ><!-- font-awesome -->
    <link rel="stylesheet" href="css/owl.carousel.css"><!-- owl.carousel -->
    <link rel="stylesheet" href="css/jquery.gritter.css" type="text/css"  /><!-- gritter -->
    <link rel="stylesheet" href="css/star-rating.css">  <!-- star-rating -->
    <link rel="stylesheet" href="css/bootstrap-fileupload.css"  />
    <link rel="stylesheet" href="css/main.css"> <!-- Main css -->
    
    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script> <!-- Modernizr -->
</head>
<body ><!-- oncontextmenu="return false;" -->

<!-- Header Start -->
<header>
  <div class="container"> 
    <div class="logo">
      <a href="index.php">
        <img src="img/logo.png" alt="img" />
      </a>
    </div>
    <div class="mainmenu">
      <ul>
        <li><a href="academi.php">Academies</a></li>
        <li><a href="videos.php">Videos</a></li>
        <!-- <li><a href="#">Blog</a></li> -->
        <li><a href="about.php">About Us</a></li>

        <?php

          if (isset($_SESSION['spoblo_userid']) && isset($_SESSION['spoblo_role'])) {
            ?>
            <li class="login">
                <a href="#" data-toggle="dropdown" class="toggle ">
                    <span>Hi <b><?php echo $_SESSION['spoblo_name']; ?></b> <i class="fa fa-angle-down"></i></span>
                </a>

                <?php
                if ($_SESSION['spoblo_role']=='admin')
                {
                  ?>
                   <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                      <li><a  href="spoblo_admin/spoblo-dashboard.php">Admin Panel</a></li>
                      <li><a  href="logout.php">Logout</a></li>
                    </ul>
                  <?php
                }
                else
                {
                  ?>
                   <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">

                      <?php
                      if ($_SESSION['spoblo_role']=='Coach')
                      {
                        ?>
                         <li><a  href="coach-profile.php">My Profile</a></li>
                        <?php
                      }
                      else if ($_SESSION['spoblo_role']=='Student') 
                      {
                        ?>
                        <li><a  href="student-profile.php">My Profile</a></li>
                        <?php
                      }
                      ?>                   
                      
                      <li><a  href="changepassword.php">Change Password</a></li>
                      <li><a  href="logout.php">Logout</a></li>
                    </ul>
                  <?php
                }
                ?>  
            </li>
            <?php
          }
          else
          {
            ?>
             <li class="login"><a href="login.php" class="btn4">Login</a></li>
            <?php
          }
        ?>
      </ul>
    </div> 
  </div>
</header>
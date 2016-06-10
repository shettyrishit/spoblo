<?php

include_once("../class/config.php");

?>

<!DOCTYPE html>

<html>

<head>

    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Spoblo Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- CORE CSS FRAMEWORK - START -->
    <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/fonts/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css"/>
    <!-- CORE CSS FRAMEWORK - END -->

    
    <!-- Single File upload -->
    <link href="assets/css/bootstrap-fileupload.css" rel="stylesheet" />
    <link href="assets/plugins/select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>


    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START --> 
    <link href="assets/plugins/datatables/css/jquery.dataTables.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" type="text/css" media="screen"/>        
    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 

    <!-- Multi select drop down --> 
    <link href="assets/plugins/multi-select/css/multi-select.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- Multi select drop down end--> 


    <!-- CORE CSS TEMPLATE - START -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
    <!-- CORE CSS TEMPLATE - END -->

    </head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
    <body class=" "><!-- START TOPBAR -->
    <div class='page-topbar '>
    <a href="../index.php">
    <div class='logo-area'>
    </div>

    </a>

    <div class='quick-area'>

        <div class='pull-left'>

            <ul class="info-menu left-links list-inline list-unstyled">

                <li class="sidebar-toggle-wrap">

                    <a href="#" data-toggle="sidebar" class="sidebar_toggle">

                        <i class="fa fa-bars"></i>

                    </a>

                </li>

            </ul>

        </div>    

         <div class='pull-right'>

                    <ul class="info-menu right-links list-inline list-unstyled">

                        <li class="profile">

                            <a href="#" data-toggle="dropdown" class="toggle">

                                <img src="../img/b25.png" alt="user-image" class="img-circle img-inline">

                                <span>Welcome <b><?php echo $_SESSION['spoblo_name']; ?></b> <i class="fa fa-angle-down"></i></span>

                            </a>

                            <?php

                            if ($_SESSION['spoblo_role']=='admin')
                            {

                              ?>

                               <ul class="dropdown-menu profile animated fadeIn">

                                    <!-- <li><a href="../myprofile.php">My profile</a></li> -->

                                    <li><a href="#">Settings</a></li>

                                    <li><a href="../logout.php">Logout</a></li>

                                </ul>

                              <?php

                            }

                            ?>

                            

                        </li>

                    </ul>           

                </div>     

    </div>

</div>
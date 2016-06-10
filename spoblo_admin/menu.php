<?php


?>

<div class="page-sidebar-wrapper" id="main-menu-wrapper"> 
    <!-- USER INFO - START -->
    <div class="profile-info row">
        <div class="profile-image col-md-4 col-sm-4 col-xs-4">
            <a href="#">
                <img src="../img/w65.png" class="img-responsive img-circle">
            </a>
        </div>


        <div class="profile-details col-md-8 col-sm-8 col-xs-8">
            <h3>
                <a href="#"><?php echo $_SESSION['spoblo_name']; ?></a>
                <span class="profile-status online"></span>
            </h3>

            <?php 
            if ($_SESSION['spoblo_role']=='admin') {
                ?>
                <p class="profile-title">admin</p>
                <?php
            }
            ?>
        </div>
    </div>

    <!-- USER INFO - END -->


    <ul class='wraplist'> 
        <?php 
            if ($_SESSION['spoblo_role']=='admin') {                
                ?>
                <li> 
                    <a href="index.php">
                        <i class="fa fa-dashboard"></i>
                        <span class="title">Dashboard</span>
                    </a>
                </li> 
                <li> 
                    <a href="javascript:;"> 
                            <i class="fa fa-suitcase"></i>
                            <span class="title">Masters</span> 
                            <span class="arrow"></span> 
                    </a>
                    <ul class="sub-menu" style="display: none;">
                            <li> 
                                <a href="ujavascript:;">
                                    <span class="title">Academy</span>
                                    <span class="arrow "></span>
                                </a> 
                                <ul class="sub-menu">
                                    <li> 
                                        <a href="spoblo_add_academy.php"> 
                                            <span class="title">Add Academy</span> 
                                        </a> 
                                        <a href="spoblo_academywise_photos.php"> 
                                            <span class="title">Add Academy Wise Photos</span> 
                                        </a>
                                        <!-- <a href="spoblo_academywise_videos.php"> 
                                            <span class="title">Add Academy Wise Videos</span> 
                                        </a> -->
                                    </li>
                                </ul>
                            </li>

                            <li> 
                                <a href="spoblo_registration.php">
                                    <span class="title">Regisration</span>
                                </a> 
                            </li>
                            <li> 
                                <a href="spoblo_assigncoach_tostudent.php">
                                    <span class="title">Coach Assign</span>
                                </a> 
                            </li>
                    </ul>
                </li>

                <li> 
                    <a href="javascript:;"> 
                            <i class="fa fa-list"></i>
                            <span class="title">Listings</span> 
                            <span class="arrow"></span> 
                    </a>

                    <ul class="sub-menu" style="display: none;">
                            <li> 
                                <a href="spoblo_academy.php">
                                    <span class="title">Academy</span>
                                </a> 
                            </li>
                            <li> 
                                <a href="spoblo_users.php">
                                    <span class="title">Users</span>
                                </a> 
                            </li>
                            <li> 
                                <a href="spoblo_listing_coachwise_students.php">
                                    <span class="title">Coach Wise Students</span>
                                </a> 
                            </li>
                    </ul>
                </li>

                 <li> 
                    <a href="spoblo_getintouch.php">
                        <i class="fa fa-phone"></i>
                        <span class="title">Get In Touch Details</span>
                    </a>
                </li> 
                <?php
            }
            ?>
    </ul>
</div>
<!-- MAIN MENU - END
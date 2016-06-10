<?php

include('../class/config.php');



if ((isset($_SESSION['spoblo_userid'])) && (isset($_SESSION['spoblo_role'])) && ($_SESSION['spoblo_role']=="admin")) {





?>



        <?php include("header.php"); ?>

        <!-- END TOPBAR -->

        <!-- START CONTAINER -->

        <div class="page-container row-fluid">



            <!-- SIDEBAR - START -->

            <div class="page-sidebar ">

            <!-- MAIN MENU - START -->

            <?php include("menu.php"); ?>

            <!-- MAIN MENU - END -->

            </div>

            <!--  SIDEBAR - END -->



            <!-- START CONTENT -->

            <section id="main-content" class=" ">

                <section class="wrapper main-wrapper" style=''>



                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                        <div class="page-title">



                            <div class="pull-left">

                                <h1 class="title">Dashboard</h1>                            

                            </div>





                        </div>

                    </div>

                    <div class="clearfix"></div>





                    <div class="col-lg-10">

                        <section class="box nobox">

                            <div class="content-body">

      



                                <div class="row">

                                    <div class="col-md-3 col-sm-6 col-xs-12">

                                        <div class="r4_counter db_box">

                                            <i class="pull-left fa fa-users icon-md icon-rounded icon-purple"></i>

                                            <a href="#" style="text-decoration: none;">
                                            <div class="stats">
                                                <h4><strong><?php //echo $get_statistics[0]["TotalUsers"]; ?></strong></h4>
                                                <span>Total Academy</span>
                                            </div>
                                            </a>

                                        </div>

                                    </div>

                                    <div class="col-md-3 col-sm-6 col-xs-12">

                                        <div class="r4_counter db_box">

                                            <i class='pull-left fa fa-phone icon-md icon-rounded icon-warning'></i>
                                            <a href="#" style="text-decoration: none;">
                                            <div class="stats">
                                                <h4><strong><?php //echo $get_statistics[0]["TotalContact"]; ?></strong></h4>
                                                <span>Total Coach</span>
                                            </div>
                                            </a>

                                        </div>

                                    </div>

                                </div> <!-- End .row -->                                



                            </div>

                        </section></div>



                </section>

            </section>



            <div class="chatapi-windows "></div>    

        </div>

        <!-- END CONTAINER -->





        <?php include("footer.php"); ?>

<?php

}

else

{

    header("location:ui-404.html");

}

?>
<?php

include_once('../class/config.php');

include_once('../class/spoblo_common_master.php');



$spoblo_common_master  = new spoblo_common_master;







if ((isset($_SESSION['spoblo_userid'])) && (isset($_SESSION['spoblo_role'])) && ($_SESSION['spoblo_role']=="admin")) {



/* for get in touch listing */

$get_getintouch_data=$spoblo_common_master->get_getintouch_data();





/* store page url  */

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

                                <h1 class="title">GET IN TOUCH LIST</h1>                            

                            </div>

                            <div class="pull-right hidden-xs">

                                <ol class="breadcrumb">

                                    <li>

                                        <a href="index.php"><i class="fa fa-home"></i>Home</a>

                                    </li>

                                    <li class="active">

                                        <strong>GET IN TOUCH LIST</strong>

                                     </li>

                                </ol>

                            </div>

                        </div>

                    </div>

                    <div class="clearfix"></div>



                    <div class="col-lg-12">

                    <section class="box ">

                        <header class="panel_header">

                            <h2 class="title pull-left">GET IN TOUCH LISTING</h2>

                        </header>

                        <div class="content-body">    

                                <div class="row">

                                <div class="col-md-12 col-sm-12 col-xs-12">



                                    <!-- ********************************************** -->

                                    <?php

                                    if (!empty($get_getintouch_data)) {

                                    ?>

                                    <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">

                                        <thead>

                                            <tr>

                                                <th>Sr.No.</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Message</th>   
                                                <th>Date</th>                                                        

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php 

                                                $count=0;

                                                foreach ($get_getintouch_data as $value) {

                                                    $id             =$value['id'];  

                                                    $name           =$value["name"];                                                                        

                                                    $email          =$value['email'];                                                                     

                                                    $message        =$value['mesaage'];

                                                    $date           =date("d-m-Y",strtotime($value['created']));

                                                    $count++;

                                                    ?>

                                                    <tr>

                                                        <td><?php echo $count; ?></td>

                                                        <td><?php echo $name; ?></td>

                                                        <td><?php echo $email; ?></td>

                                                        <td><?php echo $message; ?></td>

                                                        <td><?php echo $date; ?></td>        

                                                    </tr>  

                                                <?php

                                                }

                                            ?>

                                        </tbody>

                                    </table>

                                    <?php

                                    }

                                    else

                                    {

                                        echo "No recored found.";

                                    }

                                    ?>

                                    <!--  *********************************************** -->

                                </div>

                            </div>

                        </div>

                    </section>

                </div>



                </section>

            </section>

            <div class="chatapi-windows "></div>    

        </div>

        <!-- END CONTAINER -->

        <?php include("footer.php"); ?>

<?php

include_once("spoblo_alertmessage_script.php");

}

else

{

    header("location:ui-404.html");

}

?>
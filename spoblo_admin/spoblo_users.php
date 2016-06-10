<?php

include_once('../class/config.php');

include_once('../class/spoblo_academy_master.php');

include_once('../class/spoblo_user_master.php');



$spoblo_academy_master  = new spoblo_academy_master;

$spoblo_user_master     = new spoblo_user_master;

 





if ((isset($_SESSION['spoblo_userid'])) && (isset($_SESSION['spoblo_role'])) && ($_SESSION['spoblo_role']=="admin")) {



/* search submit */

if (isset($_POST['user-search-submit'])) {

    $role       =$_POST['role'];

    $search_id  =$_POST['academy-name'];

    $get_searchingwise_users=$spoblo_user_master->get_searchingwise_users($role,$search_id);

}

else

{

    $get_searchingwise_users=$spoblo_user_master->get_searchingwise_users('','');

}





/* for academy drop down*/

$academy_data=$spoblo_academy_master->get_New_academy();   









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

                                <h1 class="title">Users List</h1>                            

                            </div>

                            <div class="pull-right hidden-xs">

                                <ol class="breadcrumb">

                                    <li>

                                        <a href="index.php"><i class="fa fa-home"></i>Home</a>

                                    </li>

                                    <li>

                                        <a href="#">Listings</a>

                                    </li>

                                    <li class="active">

                                        <strong>Users</strong>

                                     </li>

                                </ol>

                            </div>

                        </div>

                    </div>

                    <div class="clearfix"></div>

                    

                    



                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

                        <section class="box ">

                            <header class="panel_header">

                                <h2 class="title pull-left">Users Search</h2>

                            </header>

                            <div class="content-body">

                                <div class="row">

                                    <form action="spoblo_users.php" method="POST" id="academywise-photos-form" enctype="multipart/form-data">

                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div id="errordiv" class="alert alert-danger" role="alert" style="display:none;">
                                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                <span class="sr-only">Error:</span>
                                                <lable id="error"><b></b></lable> 
                                        </div>   
                                        <div id="successdiv" class="alert alert-success" role="alert" style="display:none;">
                                          <span data-class="check"><i class="fa fa-check"></i><span></span></span>
                                          <span class="sr-only">Success:</span>
                                          <lable id="success"><b></b></lable> 
                                        </div>                                     
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-xs-4">                                        

                                        <div class="form-group">

                                            <label class="form-label" for="field-6">Role *</label>

                                            <div class="controls">

                                                <select id="role" name="role" class="form-control">

                                                    <option value="">Select Role</option>

                                                    <option value="Coach">Coach</option>

                                                    <option value="Student">Student</option>

                                                </select>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-4 col-sm-4 col-xs-4">                                        

                                        <div class="form-group">

                                            <label class="form-label" for="field-6">Academy Name *</label>

                                            <div class="controls">

                                                <select id="academy-name" name="academy-name" class="form-control">

                                                    <option value="">Select Academy Name</option>

                                                    <?php 

                                                    foreach ($academy_data as $avalue) {

                                                        $academy_id     =$avalue['id'];

                                                        $academy_name   =$avalue['name'];

                                                        $city           =$avalue['city'];

                                                        if ($city=="Pune") {

                                                            ?>

                                                            <option value="<?php echo $academy_id; ?>"><?php echo "(".$city.")&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp - ".$academy_name; ?></option>

                                                            <?php

                                                        }

                                                        else

                                                        {

                                                            ?>

                                                            <option value="<?php echo $academy_id; ?>"><?php echo "(".$city.")&nbsp&nbsp&nbsp - ".$academy_name; ?></option>

                                                            <?php

                                                        }

                                                    }

                                                    ?>

                                                </select>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-4 col-sm-4">

                                        <div class="form-group">

                                            <label class="form-label" for="field-6"></label>

                                            <div class="controls">

                                                <button type="submit" id="user-search-submit" name="user-search-submit" class="btn btn-success"><span data-class="search"><i class="fa fa-search"></i><span></span></span></button>

                                            </div>   

                                        </div> 

                                    </div>

                                    </form>

                                </div>

                            </div>

                        </section>

                    </div>









                <div class="col-lg-12">

                    <section class="box ">

                        <header class="panel_header">

                            <h2 class="title pull-left">Serch Wise Users Listing</h2>

                        </header>

                        <div class="content-body">    

                                <div class="row">

                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <!-- ********************************************** -->



                                    <?php



                                    if (!empty($get_searchingwise_users)) {

                                    ?>

                                    <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">

                                        <thead>

                                            <tr>

                                                <th>Sr.No.</th>

                                                <th>Role</th>

                                                <th>Name</th>

                                                <th>Email</th>

                                                <th>Created</th> 

                                                <th>Action</th>                                                                 

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php 

                                                $count=0;

                                                foreach ($get_searchingwise_users as $value) {

                                                    $id             = $value['id'];

                                                    $role           = $value['role'];

                                                    $name           = $value["name"];                                                                        

                                                    $email          = $value['email'];                                                                     

                                                    $created        = $value['created'];

                                                    $count++;

                                                    ?>

                                                    <tr>

                                                        <td><?php echo $count; ?></td>

                                                        <td><?php echo $role; ?></td>

                                                        <?php 
                                                        if ($role=="Coach") {
                                                            ?>
                                                            <td><a href="../coach-profile.php?user_id=<?php echo $id; ?>"><?php echo $name; ?></a></td>
                                                            <?php
                                                        }
                                                        else if ($role=="Student") {
                                                            ?>
                                                            <td><a href="../student-profile.php?user_id=<?php echo $id; ?>"><?php echo $name; ?></a></td>
                                                            <?php
                                                        }

                                                        ?>

                                                        <td><?php echo $email; ?></td>

                                                        <td><?php echo $created; ?></td>

                                                        <td>
                                                            <a href="#" role="button" data-toggle="modal" onclick="delete_confirm(<?php echo $id; ?>);"><span data-class="trash-o"><i class="fa fa-trash-o"></i></span></a>

                                                            &nbsp;&nbsp;&nbsp;&nbsp;

                                                            <a href="spoblo_rolewise_videos_upload.php?user=<?php echo $id; ?>" role="button" data-toggle="modal" ><span data-class="upload"><i class="fa fa-upload"></i></span></a>

                                                        </td>

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



        <script type="text/javascript">



            $( "#academywise-photos-form" ).submit(function( event ) {

                var role            =$('#role').val();



                var status=true;

                var text=' Please select role !';



                if (role==='') 

                {

                    $('#role').css('border', 'solid 1px red');    

                    status = false;

                }

                else { $('#role').css('border', '1px solid #ccc'); }





                if(status) 

                {

                  return true;

                }

                else

                {

                    $('#errordiv').show();

                    $('#error').text(text);

                    return false;

                }

            });





            function delete_confirm(userid)
            {
                var status = confirm("Are you very sure, You want to delete this user along with all videos ? ");
                if (status) 
                {
                    window.location="../class/masterdelete_operations.php?id="+userid+"&m=delete_user";
                }
            }

        </script>

<?php

include_once("spoblo_alertmessage_script.php");

}

else

{

    header("location:ui-404.html");

}

?>
<?php
include_once('../class/config.php');
include_once('../class/spoblo_academy_master.php');
include_once('../class/spoblo_user_master.php');

$spoblo_academy_master  = new spoblo_academy_master;
$spoblo_user_master     = new spoblo_user_master;


$get_searchingwise_students='';
if ((isset($_SESSION['spoblo_userid'])) && (isset($_SESSION['spoblo_role'])) && ($_SESSION['spoblo_role']=="admin")) {

/* search submit */
if (isset($_POST['coach-search-submit'])) {
    $academy_id   =$_POST['academy-name'];
    $coach_id     =$_POST['coach-name'];
    $get_searchingwise_students=$spoblo_user_master->get_searchingwise_students($academy_id,$coach_id);
    header("location:$pageURL");
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
                                <h1 class="title">Coach Wise Students List</h1>                            
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
                                        <strong>Coach Wise Students List</strong>
                                     </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

                        <section class="box ">

                            <header class="panel_header">

                                <h2 class="title pull-left">Search</h2>

                            </header>

                            <div class="content-body">

                                <div class="row">

                                    <form action="spoblo_listing_coachwise_students.php" method="POST" id="search-form" enctype="multipart/form-data">

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
                                            <label class="form-label" for="field-6">Academy Name *</label>
                                            <div class="controls">
                                                <select id="academy-name" name="academy-name" class="form-control" onchange="get_academywise_coach(this.value);">
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

                                    
                                    <div class="col-md-4 col-sm-4 col-xs-4">        
                                        <div class="form-group" >
                                            <label class="form-label" >Coach *</label>
                                            <div class="controls" id="coachdiv">
                                            <div id="responseCoach">                                    
                                                <select name='coach-name' id='coach-name' class="form-control">
                                                    <option value="">Select Coach</option>                   
                                                </select>
                                            </div>  
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label" for="field-6"></label>
                                            <div class="controls">
                                                <button type="submit" id="coach-search-submit" name="coach-search-submit" class="btn btn-success"><span data-class="search"><i class="fa fa-search"></i><span></span></span></button>
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

                                    if (!empty($get_searchingwise_students)) {
                                    ?>
                                    <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sr.No.</th>
                                                <th>Profile Photo</th>
                                                <th>Academy Name</th>
                                                <th>Coach Name</th>
                                                <th>Student Name</th>
                                                <th>Email</th>
                                                <th>Contact No.</th> 
                                                <th>Registration Date</th> 
                                                <th>Action</th>                                                                 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $count=0;
                                                foreach ($get_searchingwise_students as $value) {
                                                    $id             = $value['id'];
                                                    $coachtableid	= $value['coachtableid'];
                                                    $photo_path     = $value['photo_path'];
                                                    $academyname    = $value["academyname"];
                                                    $coachname      = $value['coachname'];   
                                                    $name           = $value['name'];                                                                     
                                                    $email          = $value['email'];  
                                                    $contactno      = $value['contactno'];
                                                    $created        = $value['created'];
                                                    $count++;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $count; ?></td>
                                                        <td>
                                                            <?php 
                                                            echo $baseurl;
                                                            if (!empty($photo_path)) {
                                                                echo "<img src='$photo_path' alt='profile-photo' class='profileimage'>";   
                                                            }
                                                            else
                                                            {
                                                                echo "<img src='../img/pnoimage.png' alt='profile-photo' class='profileimage'>";
                                                            }
                                                            ?>                                                          
                                                        </td>
                                                        <td><?php echo $academyname; ?></td>
                                                        <td><?php echo $coachname; ?></td>
                                                        <td><a href="../profile.php?user_id=<?php echo $id; ?>"><?php echo $name; ?></a></td>
                                                        <td><?php echo $email; ?></td>
                                                        <td><?php echo $contactno; ?></td>
                                                        <td><?php echo date("d-m-Y",strtotime($created)); ?></td>
                                                        <td>
                                                            <a href="../class/masterdelete_operations.php?id=<?php echo $coachtableid; ?>&m=delete_student_enrollment" role="button" data-toggle="modal" onclick='return (confirm("Are you very sure, You want to deselect this student from the coach enrollment ? "))'><span data-class="trash-o"><i class="fa fa-trash-o"></i></span></a>
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
                                        echo "Please Search Academy And Coach Wise Students.";
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

            function get_academywise_coach(academy_id)
            {
                var URL='php/spoblo_mapping.php?academy_id='+academy_id;
                jQuery('#responseCoach').load(URL); 
            }

            $( "#search-form" ).submit(function( event ) {
                var academy_name   =$('#academy-name').val();
                var coach_name     =$('#coach-name').val();
                var status=true;
                var text='';
                if (academy_name==='') 
                {
                    $('#academy-name').css('border', 'solid 1px red');    
                    text=' Please select Academy !';
                    status = false;
                }
                else { $('#academy-name').css('border', '1px solid #ccc'); }
                if (coach_name==='') 
                {
                    $('#coach-name').css('border', 'solid 1px red');    
                    text=' Please select Academy Wise Coach!';
                    status = false;
                }
                else { $('#coach-name').css('border', '1px solid #ccc'); }

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

        </script>
<?php

include_once("spoblo_alertmessage_script.php");
}
else
{
    header("location:ui-404.html");
}
?>
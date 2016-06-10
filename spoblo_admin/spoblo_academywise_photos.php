<?php
include_once('../class/config.php');
include_once('../class/spoblo_academy_master.php');

$spoblo_academy_master = new spoblo_academy_master;

 


if ((isset($_SESSION['spoblo_userid'])) && (isset($_SESSION['spoblo_role'])) && ($_SESSION['spoblo_role']=="admin")) {

/* search submit */
if (isset($_POST['academy-search-submit'])) {
	$search_id=$_POST['academy-name'];
	$get_academywise_gallery_data=$spoblo_academy_master->get_academywise_gallery($search_id);
}

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
                                <h1 class="title">Add Academy Wise Gallery Photos</h1>                            
                            </div>
                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="index.php"><i class="fa fa-home"></i>Home</a>
                                    </li>
                                    <li>
                                        <a href="#">Masters</a>
                                    </li>
                                    <li class="active">
                                        <strong>Add Academy Wise Gallery Photos</strong>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Add Academy Wise Gallery Photos Search</h2>
                                <div class="actions panel_actions pull-right">
                                    <a class="btn btn-success" href="spoblo_academywise_photos_upload.php"><i class="fa fa-plus"></i> Gallery Photos Upload</a>
                                </div>
                            </header>
                            <div class="content-body">
                                <div class="row">
                                    <form action="spoblo_academywise_photos.php" method="POST" id="academywise-photos-form" enctype="multipart/form-data">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div id="errordiv" class="alert alert-danger" role="alert" style="display:none;">
                                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                <span class="sr-only">Error:</span>
                                                <lable id="error"><b></b></lable> 
                                        </div>                                        
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-xs-10">                                        
                                        <div class="form-group">
                                            <label class="form-label" for="field-6">Academy Name *</label>
                                            <div class="controls">
                                                <select id="academy-name" name="academy-name" class="form-control">
                                                    <option value="">Select Academy Name</option>
                                                    <?php 
                                                    foreach ($academy_data as $avalue) {
                                                    	$academy_id 	=$avalue['id'];
                                                    	$academy_name 	=$avalue['name'];
                                                    	$city 			=$avalue['city'];
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
                                                <button type="submit" id="academy-search-submit" name="academy-search-submit" class="btn btn-success"><span data-class="search"><i class="fa fa-search"></i><span></span></span></button>
                                            </div>   
                                        </div> 
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Add Academy Wise Gallery Photos Listing</h2>
                            </header>
                            <div class="content-body">
                                <div class="row">
                                    
                                    
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div id="successdiv" class="alert alert-success" role="alert" style="display:none;">
                                            <span data-class="check"><i class="fa fa-check"></i><span></span></span>
                                            <span class="sr-only">Success:</span>
                                            <lable id="success"><b></b></lable> 
                                        </div>
										
										<?php 
										if (!empty($get_academywise_gallery_data)) {
										
										?>
										<div class="galleryImages">
                                              <?php
                                                foreach ($get_academywise_gallery_data as $gvalue) {
                                                  $i_id        =$gvalue['id'];
                                                  $image_path  =str_replace('../../','../',$gvalue['image_path']);
                                                  	?>
                                                     	<div class=''>
                                                            <div class='galleryImg'>
                                                              <img src='<?php echo $image_path; ?>' alt='' />
                                                              <a href='../class/masterdelete_operations.php?id=<?php echo $i_id; ?>&m=gallery_image&path=<?php echo $image_path; ?>' onclick='return (confirm("Are you sure you want to delete this partner image ?"))' >
                                                              	<div class='imgClose'><img src='multiple_image_upload/x.png' alt='img' /></div>
                                                              </a>
                                                            </div> 
                                                          </div> 
                                                    <?php
                                                }
                                              ?>
                                          </div>
                                        <?php
                                    	}
                                    	else
                                    	{
                                    		echo "No Records Found.";
                                    	}
                                    	?>
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
                var city            =$('#city').val();
                var academy_name    =$('#academy-name').val();

                var status=true;
                var text=' Please fill all mandatory fileds !';

                if (city==='') 
                {
                    $('#city').css('border', 'solid 1px red');    
                    status = false;
                }
                else { $('#city').css('border', '1px solid #ccc'); }
                if (academy_name==='') 
                {
                    $('#academy-name').css('border', 'solid 1px red');    
                    status = false;
                }
                else { $('#academy-name').css('border', '1px solid #ccc');  }

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
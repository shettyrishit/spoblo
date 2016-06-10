<?php
include_once("../class/config.php");
include_once('../class/spoblo_academy_master.php');

$spoblo_academy_master = new spoblo_academy_master;

if ((isset($_SESSION['spoblo_userid'])) && (isset($_SESSION['spoblo_role'])) && ($_SESSION['spoblo_role']=="admin")) {


$academy_data=$spoblo_academy_master->get_New_academy(0); 


$_SESSION['sf_title']="Salefiesta - Partners Logo Upload";

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

        <!-- START HEADER -->
        <?php include("header.php"); ?>
        <link rel="stylesheet" type="text/css" href="multiple_image_upload/muplode_style.css">

        <!-- END HEADER -->
        
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
                                <h1 class="title">ADD ACADEMY WISE GALLERY PHOTOS UPLOAD</h1>                            
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
                                        <strong>ADD ACADEMY WISE GALLERY PHOTOS UPLOAD</strong>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                      
                        <div class="col-lg-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">ADD ACADEMY WISE GALLERY PHOTOS UPLOAD FORM</h2>
                            </header>
                            <div class="content-body">    
                                  <div class="row">
                                    
                                        <form action="php/spoblo-academy-master.php" method="post" id="academywise-photosupload-form" enctype="multipart/form-data" >
                                            <div class="col-md-8">

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

                                      
                                                <div id="filediv" class="filediv1" >
                                                  <input type="file" id="file" name="file[]" tabindex="1" accept="image/*" >
                                                </div>  
                                                <button type="button" id="add_more" class="btn"  style="clear:both; " tabindex="2"> Add More Images</button>            
                                       
                                                <button type="submit" id="academywise-gallery" name="academywise-gallery" class="btn btn-success">Save</button>
                                                <a href="spoblo_academywise_photos.php" class="btn btn-secondary">Cancel</a>
                                            </div>
                                        </form>
                                </div>
                            </div>
                        </section>
                        </div>


                </section>
            </section>

            <div class="chatapi-windows "></div>    
            </div>
            <!-- END CONTAINER -->
            
        <!-- Footer -->    
        <?php include("footer.php"); ?>
        
        <script src="multiple_image_upload/muplode_style_js.js"></script>

        <script type="text/javascript">
          $( "#academywise-photosupload-form" ).submit(function( event ) {
              var val          =$("#file").val();
              var academy_name =$('#academy-name').val();

              var status=true;
              var text='Please fill all mandatory fileds !';

              if (academy_name==='') 
              {                
                  $('#academy-name').css('border', 'solid 1px red');           
                  status = false;
              }else {  $('#academy-name').css('border', 'solid 1px #ccc');  }
              if (val==='')
              {
                  $('#file').css('border', 'dashed 1px red');   
                  text='Please select atlest one image!';
                  status = false;
              }else {  $('#file').css('border', 'solid 1px #ccc');  }

              if (status) 
              {
                return true;
              }
              else
              {
                  $('#errordiv').show();
                  $('#error').text(text);                  
                  $('#successdiv').hide();
                  document.getElementById('academywise-gallery').disabled = true; 
                  return false;             
              }
          });
        </script>
        <!-- End Footer -->

<?php

include_once("spoblo_alertmessage_script.php");

}
else
{
    header("location:ui-404.html");
}
?>
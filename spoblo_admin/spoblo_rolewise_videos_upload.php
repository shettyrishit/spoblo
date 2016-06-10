<?php
include_once("../class/config.php");
include_once('../class/spoblo_academy_master.php');
$spoblo_academy_master = new spoblo_academy_master;

if ((isset($_SESSION['spoblo_userid'])) && (isset($_SESSION['spoblo_role'])) && ($_SESSION['spoblo_role']=="admin")) {

$academy_data=$spoblo_academy_master->get_New_academy(0); 

if (isset($_GET['user'])) {
 $user=$_GET['user'];
}


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

                                <h1 class="title">ADD USER WISE VIDEO UPLOAD</h1>                            

                            </div>

                            <div class="pull-right hidden-xs">

                                <ol class="breadcrumb">

                                    <li>

                                        <a href="index.php"><i class="fa fa-home"></i>Home</a>

                                    </li>

                                    <li>

                                        <a href="#">LISTINGS</a>

                                    </li>

                                    <li class="active">

                                        <strong>ADD USER WISE VIDEO UPLOAD</strong>

                                    </li>

                                </ol>

                            </div>

                        </div>

                    </div>

                    <div class="clearfix"></div>

                      

                        <div class="col-lg-12">

                        <section class="box ">

                            <header class="panel_header">

                                <h2 class="title pull-left">ADD USER WISE VIDEO UPLOAD FORM</h2>

                            </header>

                            <div class="content-body">    

                                  <div class="row">

                                    

                                        <form action="php/spoblo-rolewise-video-master.php" method="post" id="rolewise-videoupload-form" enctype="multipart/form-data" >

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



                                                <input type="hidden" id="hdn_userid" name="hdn_userid" value="<?php echo $user; ?>">

                                                <input type="hidden" id="hdn_thumbnail" name="hdn_thumbnail" value="" style="width:500px">



                                                

                                                <div class="form-group">

                                                    <label class="form-label" for="field-1">Video Name *</label>

                                                    <div class="controls">

                                                        <input type="text" class="form-control" id="videoname" name="videoname" placeholder="Enter Video Name" value="">

                                                    </div>

                                                </div>



                                                <div class="form-group">

                                                    <label class="form-label" for="field-6">Video Description *</label>

                                                    <div class="controls">

                                                        <textarea class="form-control" cols="5" id="video_description" name="video_description" placeholder="Enter Video Description"></textarea>

                                                    </div>

                                                </div>



                                                <div class="form-group">

                                                    <label class="form-label" for="field-6">Upload Video</label>

                                                    <div class="controls">

                                                            <div class="fileupload fileupload-new" data-provides="fileupload">

                                                              <div class="fileupload-new thumbnail" style="width: 300px; height: 160px;">

                                                                    <img src="../img/noimage.png" alt="" style="width: 300px;" />

                                                              </div>

                                                              <img class="fileupload-preview fileupload-exists"  id="thumbnail"  />



                                  



                                                              <!-- <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 195px; max-height: 150px; line-height: 20px;"></div> -->

                                                              <div style="padding-top:10px;">

                                                                <span class="btn btn-file">

                                                                    <span class="fileupload-new"  tabindex="26" >Select Video</span>

                                                                    <span class="fileupload-exists">Change</span>

                                                                    <input type="file" class="default" id="rolewise_video" name="rolewise_video" accept="video/*"  >

                                                                </span>

                                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>

                                                              </div>

                                                            </div>   

                                                    </div>

                                                </div>      

                                                

                                                <!-- <div id="filediv" class="filediv1" >

                                                        <input type="file" id="file" name="file[]" accept="video/*">

                                                      </div>  

                                                      <button type="button" id="add_more" class="btn"  style="clear:both;" onclick="add()">  Add More Videos</button>       -->      

                                       

                                                <input type="submit" id="rolewise-video" name="rolewise-video" class="btn btn-success">

                                                <a href="spoblo_users.php" class="btn btn-secondary">Cancel</a>

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



        <script type="text/javascript">

        $( "#rolewise-videoupload-form" ).submit(function( event ) {

              var val         = $("#rolewise_video").val();
              var videoname   = $("#videoname").val();
              var status=true;
              var text='Please fill all mandatory fileds !';

              if (val==='')
              {
                  $('.thumbnail').css('border', 'solid 1px red');   
                  text='Please select video!';
                  status = false;
              }else { 
                  $('.thumbnail').css('border', 'solid 1px #ccc');
                  if (!val.match(/(?:mp4|avi|mov|3gp|mpeg)$/)) {
                    text="Format Not Supported!";
                    status=false;
                  }
                  else if (val.size>41943040) 
                  {
                      text="Please upload video less than 40 MB!";
                      status=false;
                  }
              }

              if (videoname==='')
              {
                  $('#videoname').css('border', 'solid 1px red');   
                  text="Enter Video Name!";
                  status = false;
              }else { 
                  $('#videoname').css('border', 'solid 1px #ccc');
              }

              if (status) 
              {
                return true;
              }
              else
              {
                  $('#errordiv').show();
                  $('#error').text(text);                  
                  $('#successdiv').hide();
                  return false;           
              }

        });



      var input = document.getElementById('rolewise_video');
      var img = document.getElementById('thumbnail');

      input.addEventListener('change', function(event) {
        var file = this.files[0];
        var url = URL.createObjectURL(file);
        var video = document.createElement('video');
        video.src = url;

          var snapshot = function() {
            var canvas = document.createElement('canvas');
            var ctx = canvas.getContext('2d');
            ctx.drawImage(video, 1, 1, 300, 150);
            img.src = canvas.toDataURL('image/jpg');
            $('#hdn_thumbnail').val(img.src);
            video.removeEventListener('canplay', snapshot);
          };
        video.addEventListener('canplay', snapshot);
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




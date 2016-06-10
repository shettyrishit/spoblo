<?php
include_once("../class/config.php");
include_once('../class/spoblo_academy_master.php');


$spoblo_academy_master = new spoblo_academy_master;

if ((isset($_SESSION['spoblo_userid'])) && (isset($_SESSION['spoblo_role'])) && ($_SESSION['spoblo_role']=="admin")) {

$academy_data=$spoblo_academy_master->get_New_academy(0); 

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
                                <h1 class="title">ADD ACADEMY WISE VIDEOS UPLOAD</h1>                            
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
                                        <strong>ADD ACADEMY WISE VIDEOS UPLOAD</strong>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                        <div class="col-lg-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">ADD ACADEMY WISE VIDEOS UPLOAD FORM</h2>
                            </header>
                            <div class="content-body">    
                                  <div class="row">

                                        <form action="php/spoblo-academy-master.php" method="post" id="academywise-videoupload-form" enctype="multipart/form-data" >
                                            <input type="hidden" id="hdn_thumbnail" name="hdn_thumbnail[]" value="" style="width:500px">

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
                                                                $academy_id   =$avalue['id'];
                                                                $academy_name =$avalue['name'];
                                                                $city         =$avalue['city'];
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
                              
                                                <!-- <div id="filediv" class="filediv1" >                                                            
                                                              <input type="file" id="file" name="file[]"  accept="video/*">                                                            
                                                      </div>                                                              
                                                      <button type="button" id="add_more" class="btn"  style="clear:both; " > Add More Images</button> 
                                                -->
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
                                                                    <input type="file" class="default" id="academi_video" name="academi_video[]" accept="video/*"  multiple >
                                                                </span>
                                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                              </div>
                                                            </div>   
                                                    </div>
                                                </div>              

                                       
                                                <button type="submit" id="academywise-video" name="academywise-video" class="btn btn-success">Save</button>
                                                <a href="spoblo_academywise_videos.php" class="btn btn-secondary">Cancel</a>

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
        <!-- Footer End --> 

        <script type="text/javascript">

          $( "#academywise-videoupload-form" ).submit(function( event ) {
              var val          =$("#academi_video").val();
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
                  $('.thumbnail').css('border', 'dashed 1px red');   
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

          var input = document.getElementById('academi_video');
          var img = document.getElementById('thumbnail');

          input.addEventListener('change', function(event) {
            var file = this.files[0];
            var url = URL.createObjectURL(file);
            var video = document.createElement('video');
            video.src = url;
              var snapshot = function() {

                var canvas = document.createElement('canvas');
                var ctx = canvas.getContext('2d');

                ctx.drawImage(video, 0, 0, 300, 150);
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
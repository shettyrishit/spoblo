<?php
include_once("class/config.php");
include_once("class/spoblo_rolewise_video_master.php");
include_once("class/spoblo_user_master.php");
include_once("class/encrypt-decrypt.php");


$Encryption                   = new Encryption;
$spoblo_rolewise_video_master = new spoblo_rolewise_video_master;
$spoblo_user_master           = new spoblo_user_master;


$rowid            ='';
$video_name       ='';
$video_description='';
$vrowid           ='';


if ((isset($_SESSION['spoblo_userid'])) && (isset($_SESSION['spoblo_role']))) {
if (isset($_GET['row'])) {
  $rowid=$_GET['row'];
}


$user_id=$_SESSION['spoblo_userid'];
$decode=$Encryption->decode($rowid); 
$get_user_data=$spoblo_user_master->get_user_data('id',$user_id);


/*=========================== For Show More Button ================================*/
$get_total_rows = 0;
$results = $conn->query("SELECT COUNT(*) FROM spoblo_playerscomments_master");
if($results){
$get_total_rows = $results->fetch_row(); 
}

//break total records into pages
$total_pages = ceil($get_total_rows[0]/$item_per_page); 

/*===========================Store Url================================*/


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

<!-- Header Start -->

<?php include_once("header.php"); ?>

<!-- Header Ends -->

<!-- <link href="style.css" rel="stylesheet" type="text/css">

 -->

<div class="mainContainer MainBnrContainer">

  <!-- Start Here -->

  <div class="academi-detail">

    <!-- Video gallery -->

    <div class="topVideos sections">

      <div class="container">

        <div class="row">

          <?php

            $academy_uservideos=$spoblo_rolewise_video_master->get_For_all('spoblo_rolewise_video_master','id',$decode); 

            if (!empty($academy_uservideos)) { 
                foreach ($academy_uservideos as $vvalue) {
                  $vrowid       =$vvalue['id'];
                  $video_path   =$vvalue['video_path'];
                  $video_path   =str_replace("../../", "", $vvalue['video_path']);                  
                  $video_name   =$vvalue['video_name'];
                  $video_description   =$vvalue['video_description'];

                  //$decoded_video_path=$Encryption->decode($video_path); 
                  //$decoded_video_path=str_replace("../../", "", $decoded_video_path);
                  ?>        
                    <div class="col-md-12">
                    <video width="100%" controls>
                      <source src="<?php echo $video_path; ?>" type="video/mp4">
                      <source src="<?php echo $video_path; ?>" type="video/ogg">
                    </video>
                    </div>
                  <?php
                }            
            }
            else
            {
              echo "Video Not Found!";
            }
            ?> 

        </div>

      </div>



    </div>

    <!-- Video gallery End -->

      <!-- REviews -->

    <div class="topVideos sections">

      <div class="container">

        <div class="row">

          <div class="col-md-12">

            <div class="siteTitle">

              <h2><?php echo $video_name; ?></h2>

              <P><?php echo $video_description; ?></P>

            </div>

          </div> 

          <div class="col-md-12 acdCoaches acdReview"> 

            <div class="row"> 

              <div class="col-md-12">

                <div class="cocheImg">

                  <img src="img/coches.png" alt="">

                </div>

                <div class="cochesInfo">
                  <div class="row">
                    <form action="php/spoblo_comments.php" method="post" id="comments-form" enctype="multipart/form-data">
                      <input type="hidden" id="hdnvideo_id" name="hdnvideo_id" value="<?php echo $vrowid; ?>">
                      <input type="hidden" id="hdn_thumbnail" name="hdn_thumbnail" value="" style="width:500px">

                      <div class="col-md-10">
                        <div class="reviewTextarea">
                          <textarea name="comments" id="comments" class="comments"></textarea>                          
                        </div>
                        <span id="mcomments" class="errormsg" style="margin-top: 0px;"></span>
                      </div>
                      <div class="col-md-2">
                      <div class="wrtReview wrtCommnt">
                        <!-- <a href="profile.php" class="btn4">Back</a> -->
                        <input type="button" class="btn4"  value="Back" onclick="window.location.href='profile.php'">
                        <div class="clearfix"></div>
                        <input type="submit" class="btn4 spac" id="comments-submit" name="comments-submit" value="Post" >
                        <!-- <a href="#" >Post</a> -->
                      </div>
                      </div>

                      <div class="clearfix"></div>
                      

                      <div class="col-md-12">
                        <div class="uploadSectionUpBox">
                          <div class="uploadSectionUp">
                            <img src="img/upImg.png" alt="img" class="upl" />
                            <div class="uploadSection">
                              <input type="file" id="comment_image" name="comment_image[]" accept="image/*" multiple="multiple"/>
                            </div>
                          </div> 
                          <div class="uploadSectionUp">
                            <img src="img/video.png" alt="img" class="upl" />
                            <div class="uploadSection uploadSection1"> 
                              <input type="file" id="comment_video" name="comment_video" accept="video/*"/> 
                            </div>
                          </div>
                        </div>
                      </div>
 
                    </form>
                  </div>
                </div>

              </div> 
              <div class="col-md-12">
                <hr>
              </div>


              <!-- ================================== Comments ===================================================== -->

              <div id="results"></div>

              <!-- ================================== Comments End ===================================================== -->            

            </div>
            <div class="wrtReview">
              <div align="center">
              <button class="btn4 load_more" id="load_more_button">Show More </button>
              <div class="animation_image" style="display:none;" > Loading... </div>
              </div>
              <!-- <a href="#" class="btn4">Show More </a> -->
            </div>
          </div>
        </div>

      </div>



    </div>

    <!-- REviews End -->

  </div>

  <!-- Academy End -->



  <!-- Get In Touch -->

  <div id="loading"></div>

  <?php include_once("getintouch.php"); ?>

  <!-- Get In Touch Ends -->



</div>

<!-- mainContainer -->

   

<!-- Footer Start -->

<?php include_once("footer.php"); ?>

<!-- Footer Ends -->

<script type="text/javascript">

  $( "#comments-form" ).submit(function( event ) {
      var comments      =$('#comments').val();
      var status=true;
      var text=' Please fill all mandatory fileds !';
      if (comments==='') 
      {
          $('#comments').css('border', 'solid 1px #00E0FC');   
          $('#mcomments').text("Comments is required!");
          status = false;
      } else { 
          $('#comments').css('border-bottom', 'solid 1px #cbcbcb '); 
          $('#mcomments').text(''); 
      }

      if(status) 
      {
        return true;
      }
      else
      {
        return false;
      }

  });


  var input = document.getElementById('comment_video');
  var video = document.getElementById('thumbnail');

  input.addEventListener('change', function(event) {
    var file = this.files[0];
    var url = URL.createObjectURL(file);
    var video = document.createElement('video');
    video.src = url;

      var snapshot = function() {
        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');
        ctx.drawImage(video, 1, 1, 300, 150);
        video.src = canvas.toDataURL('image/jpg');
        $('#hdn_thumbnail').val(video.src);
        video.removeEventListener('canplay', snapshot);
      };
    video.addEventListener('canplay', snapshot);
  });

  $(document).ready(function() {

  var track_click = 0; //track user click on "load more" button, righ now it is 0 click
  var total_pages = <?php echo $total_pages; ?>;
  var videoid     = <?php echo $vrowid; ?>;

  $('#results').load("php/spoblo_comments.php", {'page':track_click,'videoid':videoid }, function() {track_click++;}); //initial data to load

  $(".load_more").click(function (e) { //user clicks on butto
    $(this).hide(); //hide load more button on click
    $('.animation_image').show(); //show loading image
    if(track_click <= total_pages) //make sure user clicks are still less than total pages
    {
      //post page number and load returned data into result element
      $.post('php/spoblo_comments.php',{'page': track_click,'videoid':videoid }, function(data) {
        $(".load_more").show(); //bring back load more button
        $("#results").append(data); //append data received from server
        //scroll page to button element
        // /$("html, body").animate({scrollTop: $("#loading").offset().top}, 600);
        //hide loading image
        $('.animation_image').hide(); //hide loading image once data is received

        track_click++; //user click increment on load button
      }).fail(function(xhr, ajaxOptions, thrownError) { 
        $(".load_more").show(); //bring back load more button
        $('.animation_image').hide(); //hide loading image once data is received
      });

      if(track_click >= total_pages-1)
      {
        //reached end of the page yet? disable load button
        $(".load_more").attr("disabled", "disabled");
      }
     }
  });


  $('.popup-image').magnificPopup({
          type: 'image',
          closeOnContentClick: true,
          mainClass: 'mfp-img-mobile' 
      });

  $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false, 
        fixedContentPos: false
      });
});

</script>

<?php
include_once("spoblo_alertmessage_script.php");
}
else
{
    header("location:spoblo_admin/ui-404.html");
}
?>
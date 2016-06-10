<?php
include_once("class/config.php");
include_once("class/spoblo_academy_master.php");
include_once("class/spoblo_user_master.php");
$spoblo_academy_master= new spoblo_academy_master;
$spoblo_user_master   = new spoblo_user_master;

$academyname  ='';
$name         ='';
$about_academy='';
$address_map  ='';
$facebook_link='';
$city         ='';
$logo_path    ='';
$id           ='';

if (isset($_GET['name'])) {
  $academyname=$_GET['name'];
}

$academy_data=$spoblo_academy_master->get_For_all('spoblo_academy_master','name',$academyname);  
foreach ($academy_data as $value) {
  $id           =$value['id'];
  $name         =$value['name'];
  $about_academy=$value['about_academy'];
  $address_map  =$value['address_map'];
  $facebook_link=$value['facebook_link'];
  $city         =$value['city'];
  $logo_path    =str_replace('../../','', $value['logo_path']);

}

?>

<!-- Header Start -->

<?php include_once("header.php"); ?>
<!-- Header Ends -->



<div class="mainContainer MainBnrContainer">

  <!-- Start Here -->

  <div class="acaHeader">
    <?php 
    if (empty($logo_path)) {
      $logo_path="img/aca.jpg";
    }
    ?>
    <div class="acaImg" style="background:url('<?php echo $logo_path; ?>') no-repeat center center; background-size:cover;">
      <img src="img/aca.jpg" alt="img" style="opacity:0;" />
    </div>
    <input id="input-3" value="4" class="rating-loading">
    <h2><?php echo $name; ?></h2>
    <p><?php echo $city; ?></p>
    <div class="findUsFb">
      <a href="<?php echo $facebook_link; ?>" target="_blank"><img src="img/fb-w.png" alt="fb">Find us on <span>Facebook</span></a>
    </div>
  </div>


  <div class="academi-detail">

    <!-- ======================================== Image gallery ======================================== -->
    <div class="topVideos sections">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="siteTitle description">
              <h2>DESCRIPTION</h2>
              <p><?php echo $about_academy; ?></p>
            </div>
          </div> 

          <!-- Set up your HTML -->
          
            <?php
              $academy_gallery=$spoblo_academy_master->get_For_all('spoblo_academywise_gallery_master','academy_id',$id); 
              if (!empty($academy_gallery)) {

                echo "<div class='col-md-12'><div class='owl-carousel'>";

                foreach ($academy_gallery as $gvalue) {
                  $image_path=str_replace('../../','', $gvalue['image_path']);
                  ?> 
              
                  <div class="item">
                    <a class="test-popup-link" href="<?php echo $image_path; ?>"><img src="<?php echo $image_path; ?>" alt="img" oncontextmenu="return false;"/></a>
                  </div>
                  <?php
                }           
                echo "</div></div>";
              }
             ?>  

        </div>
      </div>
    </div>
    <!--======================================== Image gallery End ========================================-->




    <!--========================================= Packages ================================================-->
    <?php
    $academy_packages=$spoblo_academy_master->get_For_all('spoblo_academywise_package_master','academy_id',$id); 
    if (!empty($academy_packages)) { ?>
    <div class="topVideos sections">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="siteTitle">
              <h2>Packages</h2>
            </div>
          </div> 
          <div class="col-md-12 packages">
            <div class="row">
              <?php                    
                        foreach ($academy_packages as $vvalue) {
                          $package_name       =$vvalue['package_name'];
                          $package_price      =$vvalue['package_price'];
                          $package_description=$vvalue['package_description'];
                          ?> 
               
                            <div class="col-md-4-inline">
                              <div class="packagesList">
                                <h3 class="packageHeading"><?php echo $package_name; ?></h3>
                                <div class="packageInfo">
                                  <h4><span data-class="inr"><i class="fa fa-rupee"></i></span> <?php echo $package_price; ?></h4>
                                  <p><?php echo $package_description; ?></p>
                                  <a href="#" class="btn4">Buy Now</a>
                                  <p class="pTearms"><span>*teram & conditions</span></p>
                                </div>
                              </div> 
                            </div> 
                  
                          <?php
                        }           
                      ?>           

            </div> 
          </div> 
        </div>
      </div>
    </div>
    <?php
    }
    ?>
    <!-- ======================================== Packages End ======================================== -->



    <!-- ========================================= Video gallery ========================================= -->

      <?php
         $academy_videos=$spoblo_academy_master->get_academy_wise_students_videos($id); 
          if (!empty($academy_videos)) { ?>
          <div class="topVideos sections">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <div class="siteTitle">
                    <h2>VIDEOS</h2>
                    <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam at porttitor sem. Aliquam erat volutpat. Donec placerat nisl magna, et faucibus arcu condimentum sed. </p> -->
                  </div>
                </div> 
                <div class="col-md-12 topVideoBox"> 
                  <div class="popup-gallery">
                      <?php                    
                        foreach ($academy_videos as $vvalue) {
                          $video_id   =$vvalue['video_id'];
                          $video_path =str_replace("../../", "",$vvalue['video_path']);
                          $thumbnail  =str_replace("../../", "",$vvalue['thumbnail']);
                          ?> 
                            <div class="demoLink">
                              <a href="video.php?video=<?php echo $video_path; ?>" class="magnific-youtube item" data-title="item 2">
                                  <video width='100%' height=auto controls ><source src="<?php echo $video_path; ?>" ></video>
                              </a> 
                            <div class="clearfix"></div>
                            </div>                  
                          <?php
                        }           
                      ?>
                    </div>
                </div>
              </div>
            </div>
          </div>
        <?php
        }
      ?>
    <!-- ========================================= Video gallery End ========================================= -->

     <!-- ========================================= Student ========================================= -->
    <?php
    $academywise_coach=$spoblo_user_master->get_searchingwise_users('Student',$id); 
    if (!empty($academywise_coach)) { ?>
    <div class="topVideos sections">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="siteTitle">
              <h2>STUDENTS</h2>
              <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam at porttitor sem. Aliquam erat volutpat. Donec placerat nisl magna, et faucibus arcu condimentum sed. </p> -->
            </div>
          </div> 

          <div class="col-md-12 acdCoaches"> 
            <div class="row">

                <?php                    
                  foreach ($academywise_coach as $cvalue) {
                    $userid =$cvalue['id'];
                    $name   =$cvalue['name'];
                    $about_user =$cvalue['about_user'];
                    $photo_path=str_replace("../", "", $cvalue['photo_path']);
                    ?> 
         
                      <div class="col-md-4">
                        <div class="cocheImg">
                          <?php 
                          if (empty($photo_path)) {
                            $photo_path="img/coches.png";
                          }
                          ?>
                          <img src="<?php echo $photo_path; ?>" alt="profile photo" class='profileimg'>
                        </div>

                        <div class="cochesInfo">
                          <h3><?php echo $name; ?></h3>
                          <h4><?php echo $about_user; ?></h4>
                          <a href="student-profile.php?user_id=<?php echo $userid; ?>">Read More +</a>
                        </div>
                      </div>
                    <?php
                  }           
                ?>

            </div>
            <!-- <div class="wrtReview">
              <a href="#" class="btn4">View All</a>
            </div> -->
          </div>
        </div>
      </div>
    </div>
    <?php
    }
    ?>
    <!-- ========================================= Student End ========================================= -->





    <!-- ========================================= COACHES ========================================= -->
    <?php
    $academywise_coach=$spoblo_user_master->get_searchingwise_users('Coach',$id); 
    if (!empty($academywise_coach)) { ?>
    <div class="topVideos sections">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="siteTitle">
              <h2>COACHES</h2>
              <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam at porttitor sem. Aliquam erat volutpat. Donec placerat nisl magna, et faucibus arcu condimentum sed. </p> -->
            </div>
          </div> 

          <div class="col-md-12 acdCoaches"> 
            <div class="row">

                <?php                    
                  foreach ($academywise_coach as $cvalue) {
                    $userid =$cvalue['id'];
                    $name   =$cvalue['name'];
                    $about_user =$cvalue['about_user'];
                    $photo_path=str_replace("../", "", $cvalue['photo_path']);
                    ?> 
         
                      <div class="col-md-4">
                        <div class="cocheImg">
                          <?php 
                          if (empty($photo_path)) {
                            $photo_path="img/coches.png";
                          }
                          ?>
                          <img src="<?php echo $photo_path; ?>" alt="profile photo" class='profileimg'>
                        </div>

                        <div class="cochesInfo">
                          <h3><?php echo $name; ?></h3>
                          <h4><?php echo $about_user; ?></h4>
                          <a href="coach-profile.php?user_id=<?php echo $userid; ?>">Read More +</a>
                        </div>
                      </div>
                    <?php
                  }           
                ?>

            </div>
            <!-- <div class="wrtReview">
              <a href="#" class="btn4">View All</a>
            </div> -->
          </div>
        </div>
      </div>
    </div>
    <?php
    }
    ?>
    <!-- ========================================= COACHES End ========================================= -->




    <!-- ========================================= Reviews ========================================= -->
    <!-- <div class="topVideos sections">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="siteTitle">
              <h2>Reviews</h2>
            </div>
          </div> 
          <div class="col-md-12 acdCoaches acdReview"> 
            <div class="row"> 
              <div class="col-md-12">
                <div class="cocheImg">
                  <img src="img/coches.png" alt="">
                </div>
                <div class="cochesInfo">
                  <h3>Joye Walls <span>7 Hour ago</span></h3>
                  <input id="input-4" value="4" class="rating-loading">
                  <h4>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</h4>
                 <a href="#" class="reviewMenu"><img src="img/menu-icon.png" alt=""></a>
                </div>
              </div>
              <div class="col-md-12">
                <div class="cocheImg">
                  <img src="img/coches.png" alt="">
                </div>
                <div class="cochesInfo">
                  <h3>Joye Walls <span>7 Hour ago</span></h3>
                  <input id="input-5" value="4" class="rating-loading">
                  <h4>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</h4>
                <a href="#" class="reviewMenu"><img src="img/menu-icon.png" alt=""></a>
                </div>
              </div>
            </div>
            <div class="wrtReview">
              <a href="#" class="btn4">Write your review</a>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    <!-- ========================================= Reviews End ========================================= -->

    <!-- Academy Map -->
    <?php
    if (!empty($address_map) || $address_map!='') {
       echo "<div class='map'>$address_map</div>";
    }
    ?>    
    <!-- Academy End -->

  </div>

  <!-- Academy End -->

<!-- Get In Touch -->
<?php include_once("getintouch.php"); ?>
<!-- Get In Touch Ends -->

</div>

<!-- mainContainer -->

<!-- Footer Start -->
<?php include_once("footer.php"); ?>
<!-- Footer Ends -->
<script type="text/javascript">
$('#input-3').rating({displayOnly: true, step: 0.5});
$('#input-4').rating({step: 0.5});
$('#input-5').rating({step: 0.5});

$('.map').click(function () {
    $('.map iframe').css("pointer-events", "auto");
});

$( ".map" ).mouseleave(function() {
  $('.map iframe').css("pointer-events", "none"); 
});

</script>
<?php include_once("spoblo_alertmessage_script.php"); ?>
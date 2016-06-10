<?php
include_once("class/config.php");
include_once("class/spoblo_common_master.php");

$spoblo_common_master =new spoblo_common_master;

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
<!doctype html>

<!-- Header Start -->
<?php include_once("header.php"); ?>
<!-- Header Ends -->

<div class="mainContainer MainBnrContainer">
  <!-- Start Here -->
  
  <div class="acaHeader">
    <h2>ABOUT VIDEOS</h2>
  </div>
 
        <section id="videoGallery" class="container mainVideoGallery">
             
          <div class="btn-toolbar filters videoBtn">
              <div class="" data-toggle="buttons">
                  <label data-filter="four" class="btn btn-primary vgBtn">
                      <input type="radio"><span class="uLine"></span> Favourites
                  </label>
                  <label data-filter="one" class="btn btn-primary vgBtn">
                      <input type="radio"><span class="uLine"></span>  Coaching Videos
                  </label>
                  <label data-filter="two" class="btn btn-primary vgBtn">
                      <input type="radio"><span class="uLine"></span>  Drill Videos
                  </label>
                  <label data-filter="three" class="btn btn-primary vgBtn">
                      <input type="radio"><span class="uLine"></span>  Interviews
                  </label>
                  <label data-filter="" class="btn btn-primary vgBtn active">
                      <input type="radio"><span class="uLine"></span>  All
                  </label>
              </div>
          </div>

          <div class="row">
              <div id="masonry" class="videoGal">

                  <?php

                  $get_videos=$spoblo_common_master->get_videos();

                  if (!empty($get_videos)) {
                   
                  foreach ($get_videos as $value) {
                    $name         =$value['name'];
                    $video_path   =str_replace("../../", "",$value['video_path']);
                    $name         =$value['name'];
                    $video_name       =$value['video_name'];
                    $video_description=$value['video_description'];
                    //$academy_id   =$value['academy_id'];


                    ?>
                    <div data-filter="" class="card-container">
                      <div class="card">
                        <div class="popup-gallery">
                          <a href="video.php?video=<?php echo $video_path; ?>" class="magnific-youtube item" data-title="item 2">
                            <video width='100%' height=auto controls ><source src="<?php echo $video_path; ?>" ></video>
                          </a>
                          <!-- <p>Player Name: <?php echo $name; ?></p>
                          <p>Video Title: <?php echo $video_name; ?></p>
                          <p>Description: <?php echo $video_description; ?></p> -->
                        </div>
                      </div>
                    </div>
                    <?php
                  }

                  }
                  else
                  {
                   echo "<div class='norecordfound'>No Records Found</div>";
                  }


                  ?>

                  <!-- <div data-filter="four" class="card-container">
                      <div class="card">
                        <div class="popup-gallery">
                          <a href="http://coleccion.educ.ar/coleccion/experiencias/datos/wp-content/uploads/2012/11/Alicia-Garcia-Directora-Escuela-Geary-San-Rafael.mp4" class="magnific-youtube item" data-title="item 2">
                            <img src="img/topVideo.jpg" alt="img" />
                            <div class="howVideoPlay"><img src="img/play.png" alt="img" /></div>
                          </a>
                          <p>Student Name</p>
                          <p>Academy Name</p>
                        </div>
                      </div>
                  </div>
                  
                  <div data-filter="one" class="card-container">
                      <div class="card">
                        <div class="popup-gallery">
                          <a href="http://coleccion.educ.ar/coleccion/experiencias/datos/wp-content/uploads/2012/11/Alicia-Garcia-Directora-Escuela-Geary-San-Rafael.mp4" class="magnific-youtube item" data-title="item 2">
                            <img src="img/topVideo.jpg" alt="img" />
                            <div class="howVideoPlay"><img src="img/play.png" alt="img" /></div>
                          </a>
                          <p>Student Name</p>
                          <p>Academy Name</p>
                        </div>
                      </div>
                  </div>
                  
                  <div data-filter="two" class="card-container">
                      <div class="card">
                        <div class="popup-gallery">
                          <a href="http://coleccion.educ.ar/coleccion/experiencias/datos/wp-content/uploads/2012/11/Alicia-Garcia-Directora-Escuela-Geary-San-Rafael.mp4" class="magnific-youtube item" data-title="item 2">
                            <img src="img/topVideo.jpg" alt="img" />
                            <div class="howVideoPlay"><img src="img/play.png" alt="img" /></div>
                          </a>
                          <p>Student Name</p>
                          <p>Academy Name</p>
                        </div>
                      </div>
                  </div>
                  
                  <div data-filter="three" class="card-container">
                      <div class="card"> 
                        <div class="popup-gallery">
                          <a href="http://coleccion.educ.ar/coleccion/experiencias/datos/wp-content/uploads/2012/11/Alicia-Garcia-Directora-Escuela-Geary-San-Rafael.mp4" class="magnific-youtube item" data-title="item 2">
                            <img src="img/topVideo.jpg" alt="img" />
                            <div class="howVideoPlay"><img src="img/play.png" alt="img" /></div>
                          </a>
                          <p>Student Name</p>
                          <p>Academy Name</p>
                        </div>
                      </div>
                  </div>
                  
                  <div data-filter="two" class="card-container">
                      <div class="card">
                        <div class="popup-gallery">
                          <a href="http://coleccion.educ.ar/coleccion/experiencias/datos/wp-content/uploads/2012/11/Alicia-Garcia-Directora-Escuela-Geary-San-Rafael.mp4" class="magnific-youtube item" data-title="item 2">
                            <img src="img/topVideo.jpg" alt="img" />
                            <div class="howVideoPlay"><img src="img/play.png" alt="img" /></div>
                          </a>
                          <p>Student Name</p>
                          <p>Academy Name</p>
                        </div>
                      </div>
                  </div> -->

              </div>
          </div>


        </section> <!-- videoGallery end -->

<!-- Get In Touch -->
<?php include_once("getintouch.php"); ?>
<!-- Get In Touch Ends -->

</div>
<!-- mainContainer -->

<!-- Footer Start -->
<?php include_once("footer.php"); ?>
<!-- Footer Ends -->
<script type="text/javascript">
  $(function () {
      var self = $("#masonry");

      self.imagesLoaded(function () {
          self.masonry({
              gutterWidth: 15,
              isAnimated: true,
              itemSelector: ".card-container"
          });
      });

      $(".filters .btn").click(function(e) {
          e.preventDefault();

          var filter = $(this).attr("data-filter");

          self.masonryFilter({
              filter: function () {
                  if (!filter) return true;
                  return $(this).attr("data-filter") == filter;
              }
          });
      });
  });
</script>
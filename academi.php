<?php
include_once("class/config.php");
include_once("class/spoblo_academy_master.php");

$spoblo_academy_master = new spoblo_academy_master;
$academy_data=$spoblo_academy_master->get_New_academy();   



?>

<!-- Header Start -->
<?php include_once("header.php"); ?>
<!-- Header Ends -->

<div class="mainContainer">
  <!-- Start Here -->
  
  <!-- Academy Starts -->
  <div class="academi">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="siteTitle">
            <h2>Academy</h2>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam at porttitor sem. Aliquam erat volutpat. Donec placerat nisl magna, et faucibus arcu condimentum sed. </p> -->
          </div>
        </div>
      
        <?php
        if (!empty($academy_data)) {
            foreach ($academy_data as $value) {
              $id             = $value['id'];                                                    
              $logo_path      = str_replace('../../','', $value['logo_path']);
              $name           = $value["name"];                                                                        
              $about_academy  = $value['about_academy'];                                                                     
              $city           = $value['city'];

              ?>
              <!-- Academy List -->
              <div class="col-md-6">
                <div class="acadamyList">
                  <?php 
                  if (empty($logo_path)) {
                    $logo_path="img/academy.jpg";
                  }
                  ?>
                  <div class="acadamyListImg" style="background: url('<?php echo $logo_path; ?>') no-repeat center center;background-size: cover;">
                    <a href="academi-details.php?name=<?php echo $name; ?>"><img src="img/academy.jpg" alt="academy-photo"></a>
                  </div>
                  <div class="acadamyListIInfo">
                    <a href="academi-details.php?name=<?php echo $name; ?>"><h3><?php echo $name; ?></h3></a>
                    <p><?php echo $city; ?></p>
                    <p><?php echo mb_strimwidth($about_academy, 0, 70, ".."); ?></p>
                    <a href="academi-details.php?name=<?php echo $name; ?>">Read More...</a>
                  </div>          
                </div>
              </div>
              <!-- Academy List End -->
            <?php
            }
          }
          else
          {
              echo "No recored found.";
          }
          ?>

      </div>
    </div>
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
<?php include_once("spoblo_alertmessage_script.php"); ?>
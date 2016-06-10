<?php
include_once("class/config.php");
include_once("class/spoblo_rolewise_video_master.php");
include_once("class/spoblo_user_master.php");
include_once("class/encrypt-decrypt.php");


$Encryption                   = new Encryption;
$spoblo_rolewise_video_master = new spoblo_rolewise_video_master;
$spoblo_user_master           = new spoblo_user_master;

$user_id ='';
$role    ='';
$record  ='';

/*if (isset($_GET['role'])) {
  $role=$_GET['role'];
}
else
{
  $role=$_SESSION['spoblo_role'];
}*/

if (isset($_GET['user_id'])) {
  $user_id=$_GET['user_id'];
}
else
{
  $user_id=$_SESSION['spoblo_userid'];
}
$get_user_data=$spoblo_user_master->get_user_data('id',$user_id);


//echo $_SERVER['DOCUMENT_ROOT'];

?>



<!-- Header Start -->
<?php include_once("header.php"); ?>
<!-- Header Ends -->


<div class="mainContainer MainBnrContainer">
  <!-- Start Here -->
  <div class="acaHeader">
    <div class="acaImg">
      <?php
      if (!empty($get_user_data[0]['photo_path'])) {
          echo "<img src='".str_replace('../', '', $get_user_data[0]['photo_path'])."' alt='profile-photo' />";
      }
      else
      {
          echo "<img src='img/profile.png' alt='profile-photo' />";
      }
      ?>
    </div>

    <h2><?php echo $get_user_data[0]['name']; ?></h2>

    <p class="profileCont">

      <span><img src='img/mail.png' alt='email'>  <?php echo $get_user_data[0]['email']; ?></span>

      <?php

      if (!empty($get_user_data[0]['contactno'])) {

        echo "<span><img src='img/call.png' alt='phone'>  ".$get_user_data[0]['contactno']."</span>";

      }

      ?>      

    </p>

    <p>

      <?php

      if (!empty($get_user_data[0]['about_user'])) {

        echo $get_user_data[0]['about_user'];

      }

      else

      {

        echo "Update About Your Self.";

      }

      ?>

     

    </p>

	

  	<?php

  	if (isset($_SESSION['spoblo_userid']) && $_SESSION['spoblo_role']!='admin' ) {

  		echo "<a href='#test-popup' class='open-popup-link editBtn'><img src='img/edit.png' alt=''></a>";

  	}

    ?>

  </div>



  <div class="academi-detail">



    <!-- ======================================== Profile Update ======================================== -->

    <?php $get_user_data_edit=$spoblo_user_master->get_user_data('id',$_SESSION['spoblo_userid']); ?>

    <div id="test-popup" class="white-popup mfp-hide updateProfile">

      <div class="cocheImg">

        <form id="profile_update_form" action="php/spoblo_profileupdate.php" method="post" enctype="multipart/form-data" >

            <div class="controls">

                  <div class="fileupload fileupload-new fileuploadMainInfo" data-provides="fileupload">

                    <div class="fileupload-new fileuploadMain thumbnail">



                      <?php                                               

                      if (!empty($user_id)) 

                      {

                          if (!empty($get_user_data_edit[0]['photo_path'])) {

                            echo "<div class='' style='background:url(".str_replace('../', '', $get_user_data_edit[0]['photo_path']).") no-repeat center center;background-size:cover; width: 150px; height: 150px;'><img src='".str_replace('../', '', $get_user_data_edit[0]['photo_path'])."' alt='photoimage' style='opacity:0;' /></div>";                                                     

                          } else { echo "<img src='img/profile.png' alt='photoimage' />"; }

                      } else { echo "<img src='img/profile.png' alt='photoimage' />"; }

                      ?>

                          

                    </div>



                    <div class="fileupload-preview fileuploadMain fileupload-exists thumbnail" style="line-height: 20px;"></div>

                    <div style="padding-top:10px;">

                      <span class="btn btn-file btn4">



                          <?php 

                              if (!empty($get_user_data_edit[0]['photo_path'])) {

                                  echo "<span class='fileupload-new'>Update image</span>";

                              }

                              else { echo "<span class='fileupload-new'>Select image</span>"; }

                          ?>



                          <a href="#" class=""><span class="fileupload-exists">Change</span></a>

                          <input type="file" class="default" id="profile_photo" name="profile_photo" accept="image/*"  >                          

                      </span>         

                      <a href="#" class="fileupload-exists btn btn4" data-dismiss="fileupload" >Remove</a>         

                    </div>

                    

                  </div>   

                 

            </div>



            <div class="note">

              Note: Profile Photo Dimenstion Maximum 180 * 180.

            </div>



            <input type="text" class="updateProf" id="name" name="name" placeholder="Enter your name" value="<?php echo $get_user_data_edit[0]['name']; ?>">

            <span id="pname" class="perrormsg"></span>

            <input type="text" class="updateProf" id="email" name="email" placeholder="Enter your email" value="<?php echo $get_user_data_edit[0]['email']; ?>">

             <span id="pemail" class="perrormsg"></span>

            <input type="text" class="updateProf" id="contact" name="contact" placeholder="Enter your contact no." value="<?php echo $get_user_data_edit[0]['contactno']; ?>">

            <textarea  class="updateProf" cols="30" rows="10" id="about_user" name="about_user" placeholder="About Your Self"><?php echo $get_user_data_edit[0]['about_user']; ?></textarea>

            <input type="button" class="btn btn2" id="profile-update" name="profile-update" value="Update"  ><!-- onclick="return validateImage();"  -->

        </form>

      </div>

    </div>

    <!-- ======================================== Profile Update End ======================================== -->



    





    <!-- ========================================== Video gallery ==========================================-->
<?php

        $academy_uservideos=$spoblo_rolewise_video_master->get_For_all('spoblo_rolewise_video_master','user_id',$user_id); 
        if (!empty($academy_uservideos)) { 
        $record=1; 
          ?>
          <div class="topVideos sections">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <div class="siteTitle">
                    <h2>VIDEOS</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam at porttitor sem. Aliquam erat volutpat. Donec placerat nisl magna, et faucibus arcu condimentum sed. </p>
                  </div>
                </div>           
                <div class="col-md-12 topVideoBox"> 
                  <div class="popup-gallery">
                      <?php                    
                        foreach ($academy_uservideos as $vvalue) {
                          $rowid      =$vvalue['id'];
                          //$video_path =$vvalue['video_path'];
                          $video_path =str_replace("../../", "", $vvalue['video_path']);
                          $thumbnail  =str_replace("../../", "", $vvalue['thumbnail']);
                          $encode=$Encryption->encode($rowid); 
                          //$decode=$Encryption->decode($video_path);
                          //$video_path=str_replace('../../','', $decode);
                          ?> 
                            <div class="demoLink">
                              <a href="video.php?video=<?php echo $video_path; ?>" class="magnific-youtube item" data-title="item 2">
                                  <!-- <img src="<?php echo $thumbnail; ?>" alt="img" style="width: 277px; height: 200px;" />  -->
                                  <video width='100%' height=auto controls ><source src="<?php echo $video_path; ?>" type='video/mp4'></video>
                                  <!-- <div class="howVideoPlay"><img src="img/play.png" alt="img" /></div> -->
                              </a> 
                              <div class="clearfix"></div>
                              <?php 
                              if ((isset($_SESSION['spoblo_email'])) && ($_SESSION['spoblo_email']==$get_user_data[0]['email'])  && ($_SESSION['spoblo_role']!='admin')) { /*&& $_SESSION['spoblo_role']=='Coach' */
                                echo "<a href='comments-feedback.php?row=$encode;' class='videoCmnt'><img src='img/comment.png' alt='comment-icon' class='comment-icon'/>Comment</a>";
                              }
                              else if ($_SESSION['spoblo_role']=='admin')
                              {
                                echo "<a href='comments-feedback.php?row=$encode;' class='videoCmnt'><img src='img/comment.png' alt='comment-icon' class='comment-icon'/>Comment</a>";
                              }
                              ?>
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

    <!-- ==========================================Video gallery End ==========================================-->







  

    <!-- ======================================== Academy Starts ======================================== -->

    <?php         

    if (isset($_SESSION['spoblo_userid']) )/*&& $_SESSION['spoblo_role']!='admin'*/ {

          
    $academy_data=$spoblo_user_master->fetch_data('su.id',$user_id);   

    if (!empty($academy_data)) {

    $record=1; 

    ?>

    <div class="academi">

      <div class="container">

        <div class="row">

          <div class="col-md-12">

            <div class="siteTitle">

              <h2>ACADEMY</h2>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam at porttitor sem. Aliquam erat volutpat. Donec placerat nisl magna, et faucibus arcu condimentum sed. </p>

            </div>

          </div> 

       

          <?php

         

              foreach ($academy_data as $value) {

                $id             = $value['id'];                                                    

                $logo_path      = str_replace('../../','', $value['logo_path']);

                $name           = $value["name"];                                                                        

                $about_academy  = $value['about_academy'];                                                                     

                $city           = $value['city'];



                ?>

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

                      <p><?php echo mb_strimwidth($about_academy, 0, 130, ".."); ?></p>

                      <a href="academi-details.php?name=<?php echo $name; ?>">Read More...</a>

                    </div>          

                  </div>

                </div>

              <?php

              }

            ?>

        </div>

      </div>

    </div>

    <?php }

    } ?>

    <!-- ======================================== Academy End ======================================== -->







    <!-- ======================================== COACHES/students ========================================-->

    <?php

    if (isset($_SESSION['spoblo_userid']) && $_SESSION['spoblo_role']!='Student') {

    $academywise_coach=$spoblo_user_master->get_coach_student_wise_data('Coach',$user_id); 

    if (!empty($academywise_coach)) { 

    $record=1; 

    ?>

    <div class="topVideos sections">

      <div class="container">

        <div class="row">

          <div class="col-md-12">

            <div class="siteTitle">

              <?php 

              echo "<h2>STUDENTS</h2>";

              $roleurl='Student';



              /*if ($role=='Coach') {

                echo "<h2>STUDENTS</h2>";

                $roleurl='Student';

              }

              else

              {

                echo "<h2>COACHES</h2>";

                $roleurl='Coach';

              }*/

              ?>              

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam at porttitor sem. Aliquam erat volutpat. Donec placerat nisl magna, et faucibus arcu condimentum sed. </p>

            </div>

          </div> 



          <div class="col-md-12 acdCoaches"> 

            <div class="row">



                <?php                    

                  foreach ($academywise_coach as $cvalue) {

                    $userid       =$cvalue['id'];

                    $name         =$cvalue['name'];

                    $academy_name =$cvalue['academy_name'];

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

                          <h4>

                          <?php 

                          if ($role=='Coach') {

                            # code...

                          }

                          else if ($role=='Student') {

                            echo "Experience: 5yr";

                          }

                          ?>

                          </h4>

                          <a href="profile.php?user_id=<?php echo $userid; ?>&role=<?php echo $roleurl; ?>">Read More +</a>

                        </div>

                      </div>

                    <?php

                  }           

                ?>



            </div>

            <div class="wrtReview">

              <a href="#" class="btn4">View All</a>

            </div>

          </div>

        </div>

      </div>

    </div>

    <?php

    } 

    }

    ?>

    <!-- ======================================== COACHES/Students End ========================================-->

  





    <?php

    if ($record<=0) {

      echo "<div class='norecordfound'>No Records Found</div>";

    }

    ?>

  </div>



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

    $("#profile-update").bind("click", function () {

        //Get reference of FileUpload.



        var profile_photo =$('#profile_photo').val();



        if (profile_photo==='') 

        {

	   			var status = validate();

	   			if(status) { 

				    $('#profile_update_form').submit();

				} else { return false; }

        }

        else

        {

        		

        		var status = validate();



                if(status) { 



                    var fileUpload = $("#profile_photo")[0];			



		            if (typeof (fileUpload.files) != "undefined") {

		                //Initiate the FileReader object.

		                var reader = new FileReader();

		                //Read the contents of Image File.

		                reader.readAsDataURL(fileUpload.files[0]);

		                reader.onload = function (e) {

		                    //Initiate the JavaScript Image object.

		                    var image = new Image();

		                    //Set the Base64 string return from FileReader as source.

		                    image.src = e.target.result;

		                    image.onload = function () {

		                        //Determine the Height and Width.

		                        var height = this.height;

		                        var width = this.width;



		                        if (height > 180 && width > 180) {

		                            var msg="This Height: " +height+" And Width: "+width+" Not Tolerable For Profile Photo.\nPlease Upload Maximum 180*180 Dimenstion.";   

		                            $.gritter.add({

		                              title: 'Error !',

		                              text: msg,

		                              image: 'img/confirm2.png',

		                              sticky: false,

		                              time: ''

		                            });

		                            return false;

		                        }

		                        else

		                        {

		                          $('#profile_update_form').submit();

		                        }

		                    };

		                }

		            }



                } else { return false; }

        }

    });

});



function validate()

{

	var name          =$('#name').val();

    var email         =$('#email').val();



    var status=true;

    if (name==='') 

    {

        $('#name').css('border', 'solid 1px #00E0FC');   

        $('#pname').text("Name is required!");

        status = false;

    } else { 

        $('#name').css('border', 'solid 1px #cbcbcb '); 

        $('#pname').text(''); 

    }

    if (email==='') 

    {

        $('#email').css('border', 'solid 1px #00E0FC');   

        $('#pemail').text("Email is required!");

        status = false;

    } else { 



        $('#email').css('border', 'solid 1px #cbcbcb '); 

        $('#pemail').text(''); 

        if (!ValidateEmail($("#email").val())) {

          $('#email').css('border', 'solid 1px #00E0FC')

          $('#pemail').text('Invalid email address !');             

          status = false;

        } 

    }



    if(status) { 

	    return true;

	} else { return false; }

}



$(document).ready(function() {



/*    var _URL = window.URL || window.webkitURL;

    $("#profile_photo").change(function(e) {   



          var image, file;

          if ((file = this.files[0])) {

              image = new Image();            

              image.onload = function() {    

                  if (this.width>180 && this.height>180) {   

                    var msg="This Height: " +this.height+" And Width: "+this.width+" Not Tolerable For Profile Photo.\nPlease Upload Maximum 180*180 Dimenstion.";   

                    $.gritter.add({

                      title: 'Error !',

                      text: msg,

                      image: 'img/confirm2.png',

                      sticky: false,

                      time: ''

                    });



                    //document.getElementById("profile-update").disabled=true;

                  }

                  else

                  {

                    //document.getElementById("profile-update").disabled=false;

                  }

              };        

              image.src = _URL.createObjectURL(file);

          }

    });

*/



    $('.test-popup-link').magnificPopup({

      type: 'image'

      // other options

    });

    $('.open-popup-link').magnificPopup({

      type:'inline',

      midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.

    });

});

</script>

<?php include_once("spoblo_alertmessage_script.php"); ?>
<?php


include_once("../class/config.php");
include_once("../class/spoblo_mail_master.php");
include_once("../class/spoblo_comments_master.php");
//include_once("../class/encrypt-decrypt.php");


//$Encryption               = new Encryption;
$spoblo_mail_master 	    = new spoblo_mail_master;
$spoblo_comments_master 	= new spoblo_comments_master;
$count=0;
$counter=0;

if (isset($_POST['comments-submit'])) {

          $userid         =$_SESSION['spoblo_userid'];
          $comments       =$_POST['comments'];
          $hdnvideo_id    =$_POST['hdnvideo_id']; 
          $hdn_thumbnail  =$_POST['hdn_thumbnail'];

          $save_New_comments=$spoblo_comments_master->save_New_comments($userid,$hdnvideo_id,$comments,$datetime);


            if ($save_New_comments>0) 
            { 
                  /* ---------------------------- For Photos --------------------------------- */
                  $images = array_filter($_FILES['comment_image']['name']);

                  if(!empty($images)) //is_uploaded_file($_FILES['comment_image']['tmp_name']))
                  {
                      for ($i = 0; $i < count($_FILES['comment_image']['name']); $i++) 
                      {
                            $target_path = "../spoblo_uploded_files/comments_file/photos/";  
                            $target_path = $target_path."commented-photo-".uniqid().".jpg";

                            if(($_FILES["comment_image"]["size"][$i]<=1024000))                                                   //Approx. 1mb files can be uploaded.
                            {
                                if (move_uploaded_file($_FILES['comment_image']['tmp_name'][$i], $target_path))                   //if file moved to uploads folder
                                {                                  
                                    $save_comment_wise_photos=$spoblo_comments_master->save_comment_wise_photos($save_New_comments,$target_path);
                                    $count=1;
                                    $msg="Your comments successfully posted."; 
                                } 
                                else 
                                {
                                  $count=0;
                                  $msg="Image File Not Uploaded Please Try Again!";
                                  break;
                                }
                            } 
                            else 
                            {
                                $count=0;
                                $msg="Image Size Must Be Less Then 1 MB.";
                                break;
                            }     
                            unset($target_path);
                      }                   
                  }
                  else
                  {
                      $counter=1;
                      $msg="Your comments successfully posted.";  
                  }

                  /* ---------------------------- For Videos --------------------------------- */


                  if(is_uploaded_file($_FILES['comment_video']['tmp_name']))
                  {
                    if ($hdn_thumbnail!='') 
                    { 
                        $ext = explode('.', basename($_FILES['comment_video']['name']));                                       
                        $file_extension = end($ext);                                                                  //store extensions in the variable

                        ///set the target path with a new name of image

                        $target_path  ="../spoblo_uploded_files/comments_file/videos/";  
                        $new_file_name="commented-video-".uniqid().".".$file_extension; 
                        $target_path  =$target_path.$new_file_name;
                        //$encode=$Encryption->encode($target_path);

                        if (move_uploaded_file($_FILES['comment_video']['tmp_name'], $target_path))                  //if file moved to uploads folder
                        {                          
                            $hdn_thumbnail = str_replace('data:image/png;base64,', '', $hdn_thumbnail);
                            $hdn_thumbnail = str_replace(' ', '+', $hdn_thumbnail);
                        
                            $data = base64_decode($hdn_thumbnail);
                            $thumbnilpath = '../spoblo_uploded_files/comments_file/video_thumbnil/thumbnil_'. uniqid() . '.png';
                            $success = file_put_contents($thumbnilpath, $data);

                            $save_comment_wise_videos=$spoblo_comments_master->save_comment_wise_videos($save_New_comments,$target_path,$thumbnilpath);
                            $msg="Your comments successfully posted."; 
                        }
                        else
                        {
                          $count=0;
                          $msg="Video not uploded in file."; 
                        }
                    }
                    else
                    {
                      $count=0;
                      $msg="Video thumbnil not generated."; 
                    }
                  }
                  else
                  {
                    $counter=1;
                    $msg="Your comments successfully posted.";  
                  }
            }
            else
            {
              $count=0;
              $msg="Somthing went wrong, Please try again.";  
            }


            if ($count>0) {    

              if ($counter>0) {                 
                $_SESSION['spoblo_success']=true;
                $_SESSION['spoblo_msg']=$msg;
              }
              else{
                $_SESSION['spoblo_error']=true;
                $_SESSION['spoblo_msg']=$msg;
              }    

            }
            else
            {
              $_SESSION['spoblo_error']=true;
              $_SESSION['spoblo_msg']=$msg;
            }               

            header("location:".$_SESSION['prevpageurl']."");
            exit(); 
}


/*=============================================================================

For view comments

==============================================================================*/

$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
$video_id    = filter_var($_POST["videoid"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

//echo $page_number;
//throw HTTP error if page number is not valid

if(!is_numeric($page_number)){
  header('HTTP/1.1 500 Invalid page number!');
  exit();
}
else
{
  //get current starting point of records
  $position = ($page_number * $item_per_page);

  $get_comments_data=$spoblo_comments_master->get_comments_data($position,$item_per_page,$video_id);
  $comment='';
  foreach ($get_comments_data as $data) {

      
        $commented_id   =$data['commented_id'];


        $comments       =$data['comments'];
        $created        =$data['created'];
        $name           =$data['name'];
        $user_profile_path     =str_replace("../", "", $data['photo_path']);

        $comment="<div class='col-md-12'><div class='cocheMain'>";
          if (!empty($user_profile_path)) {
            $comment=$comment."<div class='cocheImg'><img src='$user_profile_path' alt='profile-photo' ></div>";
          }
          else{
            $comment=$comment."<div class='cocheImg'><img src='img/coches.png' alt=''></div>";
          } 
          $comment=$comment."<div class='cochesInfo'>";
          $comment=$comment."<h3>$name<span>".$spoblo_comments_master->dateDiff($created)." ago</span></h3>";


            $get_commented_images=$spoblo_comments_master->get_commented_images($commented_id);


            foreach ($get_commented_images as $Ivalue) {
              $commented_photo_path     =str_replace("../", "", $Ivalue['photo_path']);
              $comment=$comment."<a href='$commented_photo_path' class='popup-image comentedPic userUpl'><div style='background:url(".$commented_photo_path.");background-size:cover;'><img src='img/commented-photo-bg.jpg' alt='commented-photo'></div></a>";
            }

            $get_commented_videos=$spoblo_comments_master->get_commented_videos($commented_id);
            foreach ($get_commented_videos as $Value) {
              $commented_thumbnil_path  =str_replace("../", "", $Value['video_thumbnil']);
              $commented_video_path     =str_replace("../", "", $Value['video_path']);
              
              $comment=$comment."<div class='popup-gallery-fc'><div class='popup-gallery'><a href='video.php?video=$commented_video_path' class='magnific-youtube item userUpl' data-title='item 2'><video width='100%' height=auto controls ><source src='$commented_video_path' type='video/mp4'></video></a></div></div>";             
            }
                             
          $comment=$comment."<div class='commented-div commentsize'><h4>$comments</h4></div>";
          $comment=$comment."<a class='reviewMenu' href='#' onclick='confirm($commented_id)' ><img src='img/delete.png' alt=''></a>";
          $comment=$comment."</div></div></div>";
        echo $comment;      
  }
}

//sanitize post value


?>

<script type="text/javascript">

function confirm(cid)
{
  //alert("Are you very sure, You want to delete this comment?");
  var URL="class/masterdelete_operations.php?id="+cid+"&m=dlt_commnt";
  window.location=URL;
/*  if (confirm("Are you very sure, You want to delete this comment?")==true) {
      alert("You pressed OK!");
  } else {
      alert("fail");
  }*/
  /*if (status) 
  {
    
  }*/
}

$(document).ready(function() {
    $('.popup-image').magnificPopup({
      type: 'image',
      closeOnContentClick: true,
      mainClass: 'mfp-img-mobile' 
    });


   $('.popup-gallery').each(function() {
    var $container = $(this);
    var $imageLinks = $container.find('.item');

    var items = [];
    $imageLinks.each(function() {
      var $item = $(this);
      var type = 'image';
      if ($item.hasClass('magnific-youtube')) {
        type = 'iframe';
      }

      var magItem = {
        src: $item.attr('href'),
        type: type
      };

      magItem.title = $item.data('title');    
      items.push(magItem);
      });

    $imageLinks.magnificPopup({
      mainClass: 'mfp-fade',
      items: items,
      gallery:{
          enabled:true,
          tPrev: $(this).data('prev-text'),
          tNext: $(this).data('next-text')
      },

      type: 'image',
      callbacks: {
        beforeOpen: function() {
          var index = $imageLinks.index(this.st.el);
          if (-1 !== index) {
            this.goTo(index);
          }
        }
      }
    });
  });

});

</script>
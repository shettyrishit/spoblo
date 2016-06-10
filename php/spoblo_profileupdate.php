<?php
include_once("../class/config.php");
include_once("../class/spoblo_user_master.php");
$spoblo_user_master     = new spoblo_user_master;

$name       ='';
$email      ='';
$msg        ='';
$contact    ='';
$about_user ='';

if (isset($_POST['email'])) {

    $name       =$_POST['name'];
    $email      =$_POST['email'];
    $contact    =$_POST['contact'];
    $about_user =$_POST['about_user'];
    $user_id    =$_SESSION['spoblo_userid'];


    if(!is_uploaded_file($_FILES['profile_photo']['tmp_name']))
    {
            $update_user_profile_data=$spoblo_user_master->update_user_profile_data($name,$email,$contact,$about_user,'',$date,$user_id);  
            $msg="Your Profile Successfully Uploaded.";        
    }
    else
    {
          $target_path = "../spoblo_uploded_files/profile_photos/";  
          $target_path = $target_path."profile-".uniqid().".jpg";

          if(($_FILES["profile_photo"]["size"]<=1024000))   //Approx. 1mb files can be uploaded.
          {
              if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $target_path))                  //if file moved to uploads folder
              {
                  $update_user_profile_data=$spoblo_user_master->update_user_profile_data($name,$email,$contact,$about_user,$target_path,$date,$user_id);           
                  $msg="Your Profile Successfully Uploaded.";
              } 
              else 
              {
                  $msg="Image File Not Uploaded Please Try Again!";
              }
          } 
          else 
          {
              $msg="Image Size Must Be Less Then 1 MB.";
          }
    }        
    unset($target_path);

    if ($update_user_profile_data) {        
        $_SESSION['spoblo_success'] =true;   
    }
    else
    {
        $_SESSION['spoblo_error'] =true; 
    }

    $_SESSION['spoblo_msg']=$msg;

    if ($_SESSION['spoblo_role']=='Coach') {
      header("location:../coach-profile.php");
    }
    else if ($_SESSION['spoblo_role']=='Student') {
      header("location:../student-profile.php");
    }    
    exit(); 
}

?>
<?php
include_once("../../class/config.php");
include_once("../../class/spoblo_rolewise_video_master.php");
include_once("../../class/spoblo_mail_master.php");
include_once("../../class/spoblo_user_master.php");
include_once("../../class/encrypt-decrypt.php");

$Encryption                   = new Encryption;
$spoblo_rolewise_video_master = new spoblo_rolewise_video_master;
$spoblo_mail_master           = new spoblo_mail_master;
$spoblo_user_master           = new spoblo_user_master;

/*=====================================================

Role Wise Video Upload

======================================================*/


if (isset($_POST['rolewise-video'])) {

    $hdn_userid         =$_POST['hdn_userid'];
    $hdn_thumbnail      =$_POST['hdn_thumbnail'];
    $videoname          =$_POST['videoname'];
    $video_description  =$_POST['video_description'];

 
    $check_user_record_present=$spoblo_rolewise_video_master->check_user_record_present($hdn_userid);

    /*for ($i = 0; $i < count($_FILES['file']['name']); $i++)                                           //loop to get individual element from the array
    { */ 

          $validextensions = array("mp4", "avi", "mov","3gp","mpeg");                                   //Extensions which are allowed
          $ext = explode('.', basename($_FILES['rolewise_video']['name']));                                       //explode file name from dot(.) 
          $file_extension = end($ext);                                                                  //store extensions in the variable


          ///set the target path with a new name of image

          $target_path = "../../spoblo_uploded_files/rolewise_videos/";  
          $new_file_name = "video_".uniqid().".".$file_extension; 
          $target_path = $target_path.$new_file_name; 

          //$encode=$Encryption->encode($target_path);
          $encode=$target_path;



          if(!is_uploaded_file($_FILES['rolewise_video']['tmp_name']))
          {
              $msg="Please select video!";
          }
          else
          {
              if(($_FILES["rolewise_video"]["size"]<=41943040))   //Approx. 1mb files can be uploaded.
              {

                if (in_array($file_extension, $validextensions)) {

                  
                  if (move_uploaded_file($_FILES['rolewise_video']['tmp_name'], $target_path))                  //if file moved to uploads folder
                  {

                      $hdn_thumbnail = str_replace('data:image/png;base64,', '', $hdn_thumbnail);
                      $hdn_thumbnail = str_replace(' ', '+', $hdn_thumbnail);

                      $data = base64_decode($hdn_thumbnail);
                      $thumbnilpath = '../../spoblo_uploded_files/video_thumbnil/thumbnil_'. uniqid() . '.png';
                      $success = file_put_contents($thumbnilpath, $data);

                      $save_rolewise_video_master=$spoblo_rolewise_video_master->save_rolewise_video_master($hdn_userid,$thumbnilpath,$encode,$videoname,$video_description);
                      
                      $msg="Video Data Successfully Saved.";
                  } 
                  else 
                  {
                      $msg="Video File Not Uploaded Please Try Again!";
                  }
                }
                else
                {
                    $msg="Video Format Not Supported!";
                }                  
              } 
              else 
              { 
                  $msg="Video Size Must Be Less Then 40 MB.";
              }
          }        
          unset($target_path);
    /*}*/

        $get_user_data=$spoblo_user_master->get_user_data('id',$hdn_userid);
    
        if ($check_user_record_present<=0) {
          

          foreach ($get_user_data as $value) {
            $email    =$value['email'];
            $name     =$value['name'];
            $hash     =trim($value['hash']);
            $password =$value['password'];

            if (!empty($email)) {
              $link="http://www.spoblo.com/verify.php?hash='".$hash."'";
              $send_mail=$spoblo_mail_master->send_first_registration_link($email,$password,$name,$hash,$link);
            }        
          }
        }
        else
        {
          
          $email    =$get_user_data[0]['email'];
          $name     =$get_user_data[0]['name'];
          $send_mail=$spoblo_mail_master->send_view_video_mail($email,$name);
        }

        if ($send_mail) {
          $_SESSION['spoblo_rolewise_video_success'] =true;
        }
        else
        {
          $_SESSION['spoblo_rolewise_video_error'] = true;
          $msg="Mail Error!";
        }

        $_SESSION['alert_msg']=$msg;
        header("location:../spoblo_users.php");

}
?>

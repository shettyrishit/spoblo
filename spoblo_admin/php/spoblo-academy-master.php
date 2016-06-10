<?php
include_once("../../class/config.php");
include_once("../../class/spoblo_academy_master.php");
include_once("../../class/encrypt-decrypt.php");
$spoblo_academy_master = new spoblo_academy_master;
$Encryption = new Encryption;

$name           ='';
$about_academy  ='';
$address_map    ='';
$fb_link        ='';
$Count          ='';
$field1         ='';
$field2         ='';
$edit_a_id      ='';


/*=====================================================
New Academy
======================================================*/

if (isset($_POST['academy-submit'])) {
    $name           =$_POST['name'];
    $about_academy  =$_POST['about_academy'];
    $address_map    =$_POST['address_map'];
    $fb_link        =$_POST['fb_link'];
    $city           =$_POST['city'];
    $Count          =$_POST['hdnrows'];
    $date           =date("Y-m-d");
    $hdn_academiid  =$_POST['hdn_academiid'];


    
    if(!is_uploaded_file($_FILES['academy_logo']['tmp_name']))
    {
        if ($hdn_academiid>0) {
          $target_path='';
          $save_New_academy=$spoblo_academy_master->save_New_academy($hdn_academiid,$name,$about_academy,$address_map,$fb_link,$city,$target_path,$date);

            for ($i=1; $i<=$Count; $i++) { 
              $field1="packagename_".$i;                
              $field2="packageprice_".$i;    
              $field3="description_".$i; 

                $packagename  =$_POST[$field1];
                $packageprice =$_POST[$field2];
                $description  =$_POST[$field3];
                if (!empty($packagename) && !empty($packageprice)) {
                  $save_New_academypackage=$spoblo_academy_master->save_New_academypackage($hdn_academiid,$packagename,$packageprice,$description,$date);
                  $save_New_academypackage=3;
                }
                else
                {
                  $save_New_academypackage=3;
                  break;
                }   
            }
        }
        else
        {
          $msg="Please select academy logo image!";
        }    
    }
    else
    {

      $target_path = "../../spoblo_uploded_files/academy_logo/";
      $target_path = $target_path.str_replace(' ','-',$name).".jpg"; 

      if (move_uploaded_file($_FILES['academy_logo']['tmp_name'], $target_path))            //if file moved to uploads folder
      { 
          $save_New_academy=$spoblo_academy_master->save_New_academy($hdn_academiid,$name,$about_academy,$address_map,$fb_link,$city,$target_path,$date);
      }
      else
      {
          $msg="Image File Not Uploaded Please Try Again!";
      }

      if ($save_New_academy>0) {
         for ($i=1; $i<=$Count; $i++) { 
          $field1="packagename_".$i;                
          $field2="packageprice_".$i;   
          $field3="description_".$i; 

            $packagename  =$_POST[$field1];
            $packageprice =$_POST[$field2];
            $description  =$_POST[$field3];

            if (!empty($packagename) && !empty($packageprice)) {
              $save_New_academypackage=$spoblo_academy_master->save_New_academypackage($hdn_academiid,$packagename,$packageprice,$description,$date);
              if ($hdn_academiid>0) {
                $save_New_academypackage=3;
              }
              else
              {
                $save_New_academypackage=1;
              }
            }
            else
            {
              if ($hdn_academiid>0) {
                $save_New_academypackage=3;
              }
              else
              {
                $save_New_academypackage=1;
              }
              break;
            }   
        }
      }
    }

    if ($save_New_academypackage=='1') {        
        $_SESSION['spoblo_new_academy_success'] =true;
        $_SESSION['alert_msg']="Academy Details Successfully Saved.";
    }
    else if ($save_New_academypackage=='2') {
        $_SESSION['spoblo_new_academy_error']   =true;
        $_SESSION['alert_msg']="Somthing Went Wrong Please Try Again!";
    }
    else if ($save_New_academypackage=='3') {
        $_SESSION['spoblo_new_academy_update']  =true;
        $_SESSION['alert_msg']="Academy Details Successfully Updated.";
    }
    else
    {
        $_SESSION['spoblo_new_academy_error']   =true;        
        $_SESSION['alert_msg']=$msg;
    }

    header("location:".$_SESSION['prevpageurl']."");
    exit(); 
}



/*=====================================================
Academy Wise Photos Upload
======================================================*/


if (isset($_POST['academywise-gallery'])) {
    $academy_id     =$_POST['academy-name'];
    for ($i = 0; $i < count($_FILES['file']['name']); $i++)                                          //loop to get individual element from the array
    {  
          $validextensions = array("jpeg","jpg","png","gif","PNG","JPEG","JPG");                     //Extensions which are allowed
          $ext = explode('.', basename($_FILES['file']['name'][$i]));                                  //explode file name from dot(.) 
          $file_extension = end($ext);                                                                 //store extensions in the variable
          ///set the target path with a new name of image
          $target_path = "../../spoblo_uploded_files/academy_gallery/";  
          $target_path = $target_path."academi-gallery-".uniqid().".jpg";

          if(!is_uploaded_file($_FILES['file']['tmp_name'][$i]))
          {
              $msg="Please select atlest one photo!";
              break;          
          }
          else
          {
              if(($_FILES["file"]["size"][$i]<=1024000))   //Approx. 1mb files can be uploaded.
              {
                if (in_array($file_extension, $validextensions)) {
                  if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path))                  //if file moved to uploads folder
                  {
                      $save_New_academywise_photosgallery=$spoblo_academy_master->save_New_academywise_photosgallery($academy_id,$target_path);                      
                      $msg="Gallery Photos Successfully Saved.";
                  } 
                  else 
                  {
                      $msg="Image File Not Uploaded Please Try Again!";
                  }
                }
                else
                {
                    $msg="Image Format Not Supported!";
                }
              } 
              else 
              {
                  $msg="Image Size Must Be Less Then 1 MB.";
              }
          }        
          unset($target_path);
    }


    if ($save_New_academywise_photosgallery>0) {
      $_SESSION['spoblo_academywise_gallery_success'] =true;
    }
    else
    {
      $_SESSION['spoblo_academywise_gallery_error'] = true;
    }

    $_SESSION['alert_msg']=$msg;
    header("location:".$_SESSION['prevpageurl']."");
    exit(); 
}



/*=====================================================
Academy Wise Video Upload
======================================================*/

if (isset($_POST['academywise-video'])) {
    $academy_id     =$_POST['academy-name'];
    $hdn_thumbnail  =$_POST['hdn_thumbnail'];

    /*for ($i = 0; $i < count($_FILES['file']['name']); $i++)                                          //loop to get individual element from the array
    {*/  
          $validextensions = array("mp4", "avi", "mov","3gp","mpeg");                                  //Extensions which are allowed
          $ext = explode('.', basename($_FILES['academi_video']['name']));                             //explode file name from dot(.) 
          $file_extension = end($ext);                                                                 //store extensions in the variable

          ///set the target path with a new name of image
          $target_path = "../../spoblo_uploded_files/academy_videos/";  
          $target_path = $target_path."academi-video-".uniqid().".".$file_extension;
          $encode=$Encryption->encode($target_path);

          if(!is_uploaded_file($_FILES['academi_video']['tmp_name']))
          {
              $msg="Please select video!";
          }
          else
          {
              if(($_FILES["academi_video"]["size"]<=41943040))   //Approx. 1mb files can be uploaded.
              {
                if (in_array($file_extension, $validextensions)) {

                  if (move_uploaded_file($_FILES['academi_video']['tmp_name'], $target_path))            //if file moved to uploads folder
                  {
                      $hdn_thumbnail = str_replace('data:image/png;base64,', '', $hdn_thumbnail);
                      $hdn_thumbnail = str_replace(' ', '+', $hdn_thumbnail);

                      $data = base64_decode($hdn_thumbnail);
                      $thumbnilpath = '../../spoblo_uploded_files/video_thumbnil/thumbnil_'. uniqid() . '.png';
                      $success = file_put_contents($thumbnilpath, $data);

                      $save_New_academywise_Videogallery=$spoblo_academy_master->save_New_academywise_Videogallery($academy_id,$encode,$thumbnilpath);
                      $msg="Video Successfully Saved.";
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


          if ($save_New_academywise_Videogallery>0) {
            $_SESSION['spoblo_academywise_video_success'] =true;
          }
          else
          {
            $_SESSION['spoblo_academywise_video_error'] = true;
          }


    /*}*/
    $_SESSION['alert_msg']=$msg;
    header("location:".$_SESSION['prevpageurl']."");
    exit(); 
}

?>
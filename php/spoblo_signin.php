<?php
include_once("../class/config.php");
include_once("../class/spoblo_user_master.php");
$spoblo_user_master = new spoblo_user_master;

$Musername      ='';
$Mpassword      ='';


if (isset($_POST['submit'])) {
    $Musername      =$_POST['user_login'];
    $Mpassword      =$_POST['user_pass'];

    $spoblo_user_master_data=$spoblo_user_master->user_login($Musername,$Mpassword);
    $Array = array_filter($spoblo_user_master_data);


    if (!empty($Array)) 
    {
        $username  =$spoblo_user_master_data[0]['email'];
        $userpass  =$spoblo_user_master_data[0]['password'];
        $hash      =$spoblo_user_master_data[0]['hash'];

        if ($hash==null) {
            if($Musername==$username && $Mpassword==$userpass)
            {           
                $_SESSION['spoblo_userid'] =$spoblo_user_master_data[0]['id'];
                $_SESSION['spoblo_name']   =$spoblo_user_master_data[0]['name'];
                $_SESSION['spoblo_role']   =$spoblo_user_master_data[0]['role'];
                $_SESSION['spoblo_email']  =$spoblo_user_master_data[0]['email'];

                if ($_SESSION['spoblo_role']=='admin') {
                    header("location:../spoblo_admin/spoblo-dashboard.php");
                }
                else  if ($_SESSION['spoblo_role']=='Coach') {
                    header("location:../coach-profile.php");    
                } 
                else  if ($_SESSION['spoblo_role']=='Student') {
                    header("location:../student-profile.php");    
                }                    
            }
            else
            {
                $_SESSION['spoblo_error']=true;  
                $_SESSION['spoblo_msg']="Invalid username & password, Please Try Again!"; 
                header("location:".$_SESSION['prevpageurl']."");    
            }     
        }
        else
        {
            $_SESSION['spoblo_error']=true;  
            $_SESSION['spoblo_msg']="Your Profile Is Not Active, Please Activate Your Profile. Check Your Mail For Activation."; 
            header("location:".$_SESSION['prevpageurl']."");   
        }
  
    }
    else
    {
        $_SESSION['spoblo_error']=true;
        $_SESSION['spoblo_msg']="Invalid username & password, Please Try Again!"; 
        header("location:".$_SESSION['prevpageurl']."");    
    }


}
?>
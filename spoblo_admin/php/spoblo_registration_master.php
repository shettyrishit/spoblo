<?php
include_once("../../class/config.php");
include_once("../../class/spoblo_user_master.php");
include_once('../../class/spoblo_common_master.php');
$spoblo_common_master   = new spoblo_common_master;
$spoblo_user_master     = new spoblo_user_master;

$role       ='';
$academy    ='';
$name       ='';
$email      ='';
$password   ='';

if (isset($_POST['registartion-submit'])) {
    $role       =$_POST['role'];
    $academy    =$_POST['academy'];
    $name       =$_POST['name'];
    $email      =$_POST['email'];
    $contact    =$_POST['contact'];
    $password   =$_POST['upassword'];
    $date       =date("Y-m-d");


    $academyList = implode(',', $academy);

    $hash=$spoblo_common_master->generateRandomString(8);
    $save_new_registration_data=$spoblo_user_master->save_new_registration_data($role,$academyList,$name,$email,$contact,$password,$date,$hash);

    if ($save_new_registration_data=='1') {        
        $_SESSION['spoblo_new_registration_success'] =true;
        $_SESSION['alert_msg']="Registration Details Successfully Saved.";
    }

    else if ($save_new_registration_data=='3') {
        $_SESSION['spoblo_new_registration_update']  =true;
        $_SESSION['alert_msg']="Registration Details Successfully Updated.";
    } else {
        $_SESSION['spoblo_new_registration_error']   =true;
        $_SESSION['alert_msg']="Somthing Went Wrong Please Try Again!";
    }

    header("location:".$_SESSION['prevpageurl']."");
    exit(); 
}
else
{
    $_SESSION['spoblo_new_registration_error']   =true;
    $_SESSION['alert_msg']="Somthing Went Wrong Please Try Again!";
    header("location:".$_SESSION['prevpageurl']."");
    exit(); 
}

?>
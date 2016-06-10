<?php
include_once("../class/config.php");
include_once("../class/spoblo_mail_master.php");
include_once("../class/spoblo_common_master.php");
$spoblo_mail_master 	= new spoblo_mail_master;
$spoblo_common_master 	= new spoblo_common_master;

if (isset($_POST['getintouch-submit'])) {

	$name   =$_POST['c_name'];
        $email  =$_POST['c_email'];
        $message=$_POST['c_message'];
        $date   =date("Y-m-d");


        $save_getintouch_data=$spoblo_common_master->save_getintouch_data($name,$email,$message,$date);
        $send_getintouch_email=$spoblo_mail_master->send_getintouch_email($name,$email,$message,$date);

        if ($send_getintouch_email) {
        	$_SESSION['spoblo_success']=true;
		$_SESSION['spoblo_msg']="Thank you for writing to us. The team will review your query and revert with the most suitable options shortly."; 
        }
        else
        {
        	$_SESSION['spoblo_error']=true;
		$_SESSION['spoblo_msg']="Mail Error, Please try again!"; 
        }

	header("location:".$_SESSION['prevpageurl'].""); 
}
?>
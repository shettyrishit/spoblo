<?php
include_once("../class/config.php");
include_once("../class/spoblo_mail_master.php");
include_once("../class/spoblo_user_master.php");
include_once("../class/spoblo_common_master.php");
$spoblo_mail_master 	= new spoblo_mail_master;
$spoblo_user_master 	= new spoblo_user_master;
$spoblo_common_master 	= new spoblo_common_master;

if (isset($_POST['forgotpassword-submit'])) {

		$useremail      =$_POST['useremail'];

        $randomno=$spoblo_common_master->generateRandomString(15); 

        $update_user_data=$spoblo_user_master->update_user_data('token',$randomno,'email',$useremail);

        // Create a url which we will direct them to reset their password
        $pwrurl = "http://www.spoblo.com/resetpassword.php?q=".$randomno;
         
        // Mail them their key
        $send_forgotpassword_email=$spoblo_mail_master->send_forgotpassword_email($useremail,$pwrurl);

        if ($send_forgotpassword_email) {
        	$_SESSION['spoblo_success']=true;
			$_SESSION['spoblo_msg']="Your password recovery key has been sent to your e-mail address."; 
        }
        else
        {
        	$_SESSION['spoblo_error']=true;
			$_SESSION['spoblo_msg']="Somthing went wrong, Please try again!"; 
        }

		header("location:".$_SESSION['prevpageurl'].""); 

}



if (isset($_POST["resetpassword-submit"]))
{
    // Gather the post dat
    $password 	= $_POST["password"];
	$tokan		= $_POST["q"];

    $get_user_data=$spoblo_user_master->get_user_data('token',$tokan);
    $usertokan=$get_user_data[0]['token'];

    if ($tokan==$usertokan)
    {
        $update_user_data=$spoblo_user_master->update_user_data('password',$password,'token',$tokan);
        $_SESSION['spoblo_success']=true;
		$_SESSION['spoblo_msg']="Your password has been successfully reset, please login.";
    }
    else
    {
    	$_SESSION['spoblo_error']=true;
		$_SESSION['spoblo_msg']="Your password reset key is invalid.";
    }

    header("location:../login.php"); 
}


if (isset($_POST["changepassword-submit"]))
{
    // Gather the post dat
    $password   = $_POST["password"];
    if ( (isset($_SESSION['spoblo_userid'])) || (isset($_SESSION['spoblo_rowid'])) ) {

        if (isset($_SESSION['spoblo_userid'])) {
            $id=$_SESSION['spoblo_userid'];
        }
        else if (isset($_SESSION['spoblo_rowid'])) {
            $id=$_SESSION['spoblo_rowid'];
        }

        $update_user_data=$spoblo_user_master->update_user_data('password',$password,'id',$id);
        $_SESSION['spoblo_success']=true;
        $_SESSION['spoblo_msg']="Your password has been successfully changed. Please re-login.";

    }
    else
    {
        $_SESSION['spoblo_error']=true;
        $_SESSION['spoblo_msg']="Somthing went wrong, please contact site admin";
    }
    
    
    unset($_SESSION['spoblo_userid']);
    unset($_SESSION['spoblo_name']);
    unset($_SESSION['spoblo_role']);
    header("location:../index.php");
} 

?>

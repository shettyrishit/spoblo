<?php
include_once("class/config.php");
include_once("class/spoblo_user_master.php");
$spoblo_user_master  = new spoblo_user_master;


if (isset($_SESSION['spoblo_userid'])) {

    unset($_SESSION['spoblo_userid']);
    unset($_SESSION['spoblo_rowid']);
    $_SESSION['spoblo_error']=true;
    $_SESSION['spoblo_msg']='Invalid approach, Please log in.';
    header("location:login.php");
}
else if ( (isset($_GET['hash'])) && (!empty($_GET['hash'])) && (!isset($_SESSION['spoblo_userid'])) ) {


    $hash 	=str_replace("'", "", $_GET['hash']); // Set hash variable


    $get_user_data=$spoblo_user_master->get_user_data('hash',$hash);
    
    if ($hash==$get_user_data[0]['hash']) {
        
        if (!empty($get_user_data)) {
            
            $_SESSION['spoblo_rowid']=$get_user_data[0]['id'];
            $_SESSION['spoblo_success']=true;
            $_SESSION['spoblo_msg']='Your account has been activated, you can change your password and login.';

            $update_user=$spoblo_user_master->update_user($hash);
            header("location:changepassword.php");
        }
        else
        {
            $_SESSION['spoblo_error']=true;
            $_SESSION['spoblo_msg']='The url is either invalid or you already have activated your account. please login.';
            header("location:login.php");
        }
    }
    else
    {
        $_SESSION['spoblo_error']=true;
        $_SESSION['spoblo_msg']='The url is either invalid or you already have activated your account. please login.';
        header("location:login.php");
    }

}else{
    // Invalid approach
    unset($_SESSION['spoblo_userid']);
    unset($_SESSION['spoblo_rowid']);
    $_SESSION['spoblo_error']=true;
    $_SESSION['spoblo_msg']='The url is either invalid or you already have activated your account. please login.';
    header("location:login.php");
}

?>
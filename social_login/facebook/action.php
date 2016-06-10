<?php
include_once("../../class/config.php");
include_once("../../class/spoblo_mail_master.php");

$spoblo_mail_master = new spoblo_mail_master;

$action = $_REQUEST["action"];

switch($action){

    case "fblogin":
    include 'facebook.php';
    $appid      = "711688175639567";
    $appsecret  = "94685a10f1d41e90c9cba7a2d91504b6";
    $facebook   = new Facebook(array(
        'appId' => $appid,
        'secret' => $appsecret,
        'cookie' => TRUE,
    ));
    $fbuser = $facebook->getUser();


    if ($fbuser) {
        try {
             $user_profile = $facebook->api('/me?fields=id,name,email');
             $access_token = $facebook->getAccessToken();
        }

        catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }
        $user_fbid  =$fbuser;
        $username   =$user_profile["name"];
        $email      =$user_profile["email"];

        $query="SELECT * FROM spoblo_users WHERE facebook_id = '".$user_fbid."'";
        $result = mysqli_query($conn, $query);
        $check_select = mysqli_num_rows($result);

        if($check_select>0)
        {         
            while($data = mysqli_fetch_array($result)) {     

                $_SESSION['spoblo_userid'] =$data['id'];
                $_SESSION['spoblo_name']   =$data['name'];
                $_SESSION['spoblo_role']   =$data['role'];

                header("location:../../index.php");
            }          
        }
        else
        {

            $query1="SELECT * FROM spoblo_users WHERE email='".$email."'";
            $result1 = mysqli_query($conn, $query1);
            $check_select1 = mysqli_num_rows($result1);
            if($check_select1>0)
            {   

                $_SESSION['spoblo_error']=true;
                $_SESSION['spoblo_msg']="Email id already registred with us!";  
                header("location:../../login.php");     
            }
            else
            {
                
                $_SESSION['spoblo_name']   =$username;
                $_SESSION['spoblo_role']   ='Student';

                $date=date("Y-m-d");
                $sql="INSERT INTO spoblo_users(name, email, contactno, about_user, password, role, approved, academy_id, facebook_id, created, updated, isactive, hash, token) VALUES ('".$username."','".$email."','','','','Student','y','','".$user_fbid."','".$date."','','1','','')";
                $result = mysqli_query($conn, $sql);
                $insertedid = $conn->insert_id;
                $_SESSION['spoblo_userid']      =$insertedid;

                $mail_register_via_fbuser=$spoblo_mail_master->mail_register_via_fbuser($username,$email);

                if($mail_register_via_fbuser)
                {   

                    $_SESSION['spoblo_success']=true;
                    $_SESSION['spoblo_msg']="You have successfully registred with us.";  
                    header("location:../../index.php");     
                }
                else
                {
                    $_SESSION['spoblo_error']=true;
                    $_SESSION['spoblo_msg']="Mail Error.";  
                    header("location:../../login.php");
                }
                
            }
        }        
    }
}

?>
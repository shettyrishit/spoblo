<?php
include_once("../../class/config.php");
include_once('../../class/spoblo_a_coach_to_s_master.php');

$spoblo_a_coach_to_s_master  = new spoblo_a_coach_to_s_master;

$academy    ='';
$coach      ='';
$student    ='';

if (isset($_POST['assign-submit'])) {

    $academy        =$_POST['academy'];
    $coach          =$_POST['coach-name'];
    $student        =$_POST['student'];


    //$studentList = implode(',', $student);

    foreach ($student as $value) {
        $save_assigncoachtostudent_data=$spoblo_a_coach_to_s_master->save_assigncoachtostudent_data($academy,$coach,$value);
    }

    

    if ($save_assigncoachtostudent_data>0) {        
        $_SESSION['spoblo_success'] =true;
        $_SESSION['alert_msg']="Coach Successfully Assign To Students.";
    }
    else
    {
        $_SESSION['spoblo_error']   =true;
        $_SESSION['alert_msg']="Somthing went wrong, Please try again!";
    }

    header("location:".$_SESSION['prevpageurl']."");
    exit(); 
}
else
{
    $_SESSION['spoblo_error']   =true;
    $_SESSION['alert_msg']="Somthing went wrong, Please try again!";
    header("location:".$_SESSION['prevpageurl']."");
    exit(); 
}

?>
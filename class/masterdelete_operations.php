<?php 

include_once("config.php");
include_once("spoblo_academy_master.php");
include_once("spoblo_user_master.php");
include_once("spoblo_comments_master.php");




$id=0;	

$mode="";



if(isset($_GET['id'])) { $id=$_GET['id']; }

if(isset($_GET['m'])) { $mode=$_GET['m'];	$_SESSION['deletesuccess']=true; }

if(isset($_GET['path'])) { $path=$_GET['path']; }

if($mode=="gallery_image")

{

  if (!empty($path) && file_exists($path))

  {

   	unlink($path);

  }

	$spoblo_academy_master   = new spoblo_academy_master;

	$result=$spoblo_academy_master->DeleteAcedemydata('spoblo_academywise_gallery_master',$id);

  $_SESSION['alert_msg']="Academy Gallery Photo Successfully Deleted.";

}

if($mode=="gallery_video")

{

  if (!empty($path) && file_exists($path))

  {

   	unlink($path);

  }

	$spoblo_academy_master   = new spoblo_academy_master;

	$result=$spoblo_academy_master->DeleteAcedemydata('spoblo_academywise_video_master',$id);

  $_SESSION['alert_msg']="Academy Gallery Video Successfully Deleted.";

}

if ($mode=="delete_user") {

  $spoblo_user_master   = new spoblo_user_master;

  $result=$spoblo_user_master->DeleteUserData($id);

  $_SESSION['alert_msg']="User Successfully Deleted.";

}

if ($mode=="package") {

  $spoblo_academy_master   = new spoblo_academy_master;

  $result=$spoblo_academy_master->DeleteAcedemydata('spoblo_academywise_package_master',$id);

  $_SESSION['alert_msg']="Package Successfully Deleted.";

}

if ($mode=="delete_academi") {

  if (!empty($path) && file_exists($path))

  {

    unlink($path);

  }

  

  $spoblo_academy_master   = new spoblo_academy_master;

  $result0=$spoblo_academy_master->DeleteAcedemydata('spoblo_academy_master',$id);

  $result=$spoblo_academy_master->DeleteOtherdata($id);

  $_SESSION['alert_msg']="Academy Successfully Deleted.";

}



if ($mode=="delete_student_enrollment") {

  $spoblo_academy_master   = new spoblo_academy_master;

  $result=$spoblo_academy_master->DeleteAcedemydata('spoblo_coachwise_student_master',$id);

  $_SESSION['alert_msg']="Student Deselected.";

}

if($mode=="dlt_commnt")
{
  $spoblo_comments_master   = new spoblo_comments_master;
  $result=$spoblo_comments_master->DeleteCommentdata($id);
  $_SESSION['spoblo_msg']="Commnt Successfully Deleted.";
}





if($result){

		if(isset($_SESSION['prevpageurl']))

		{

		  $prevpageurl=$_SESSION['prevpageurl'];

		  header("location:$prevpageurl");

		}

}



?>
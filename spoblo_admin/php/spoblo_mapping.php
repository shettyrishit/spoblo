<?php
include_once('../../class/config.php');
include_once("../../class/spoblo_user_master.php");
$spoblo_user_master 	= new spoblo_user_master;



if(isset($_POST['emailid'])){

	$email 	= mysql_escape_string($_POST['emailid']);

	echo $user_email_map=$spoblo_user_master->user_email_map($email);

}



$academy_id="";	
if(isset($_GET['academy_id']))
{
   	$academy_id=$_GET['academy_id'];
   	echo $spoblo_user_master->retrive_academywise_coach($academy_id);	
} 

if(isset($_GET['academyid']) && isset($_GET['role']))
{
   $academyid=$_GET['academyid'];
   echo $spoblo_user_master->retrive_academywise_students($academyid);	
} 


?>
<?php
include_once("class/config.php");
include_once("class/encrypt-decrypt.php");
$Encryption = new Encryption;

$video='';
if (isset($_GET['video'])) {
	$video=$_GET['video'];
	
	//$decode=$Encryption->decode($video);
	//$video_path=str_replace('../../','', $decode);

	echo "<video width='100%' height=auto controls autoplay><source src=$video type='video/mp4'></video>";
}

?>

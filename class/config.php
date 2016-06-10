<?php 
ini_set('display_errors', 0);
error_reporting(E_ALL & ~ (E_DEPRECATED | E_NOTICE));

if(!isset($_SESSION))
{
session_start();
}
date_default_timezone_set('Asia/Kolkata');
$datetime 	=date("Y-m-d H:i:m");
$date       =date("Y-m-d");

$host       = "free-mysql.cjrymtsenbnz.ap-southeast-1.rds.amazonaws.com";
$user       = "spoblo_website";
$pass       = "spoblo@websitE231";
$database   = "spoblo";
$item_per_page=3;



$conn = new mysqli($host, $user, $pass, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



?>

<?php

class spoblo_academy_master
{



	function __construct()
    {

        include("config.php"); 
        if($conn->connect_errno)
        {
            echo "Failed to connect to database: (" . $conn->connect_errno . ") " . $conn->connect_error;
        }
        else
        {
            $this->db = $conn;
        }
    }


    /*
	=============================================================================================================
	for save new academy from backend //spoblo_admin/spoblo_add_academy.php
	=============================================================================================================
    */
    function save_New_academy($edit_a_id,$name,$about_academy,$address_map,$fb_link,$city,$target_path,$date)
    {
    	try 
	    {
	    	if ($edit_a_id>0) {

	    		if ($target_path!='') {

	    			$sql1="SELECT * FROM spoblo_academy_master WHERE id='".$edit_a_id."'";
					$result1 = $this->db->query($sql1);
			     	
			        while($data=mysqli_fetch_array($result1)) {      
				        $logo_path=$data['logo_path'];
						$logo_path=str_replace('../../','../', $logo_path);
		    			if (!empty($logo_path) && file_exists($logo_path))
					  	{
					    	unlink($logo_path);
					  	}    
			        }
	    		}

	    		$sql="UPDATE spoblo_academy_master SET name='".$name."',about_academy='".$about_academy."',address_map='".$address_map."',facebook_link='".$fb_link."',city='".$city."',updated='".$date."'";

	    		if ($target_path!='') {

	    			$sql=$sql.", logo_path='".$target_path."'";
	    		}	    		
	    		$sql=$sql." WHERE id='".$edit_a_id."'";

	    		$result = $this->db->query($sql);
	    		return '3';
	    	}
	    	else
	    	{
	    		$sql="INSERT INTO spoblo_academy_master(name, about_academy, address_map, facebook_link, city, logo_path, approved, created, updated, isactive) VALUES ('".$name."','".$about_academy."','".$address_map."','".$fb_link."','".$city."','".$target_path."','y','".$date."','','1')";
	    		$result = $this->db->query($sql);
				$insertedacademyid = $this->db->insert_id;
	      		return $insertedacademyid;
	    	}			
 	    } catch (Exception $e) {
	        $_SESSION['db_error'] = $e->getMessage();
	    } 
    }


    /*
	=============================================================================================================
	for save new academy wise package and price from backend //spoblo_admin/spoblo_add_academy.php
	=============================================================================================================
    */

	function save_New_academypackage($save_New_academy,$packagename,$packageprice,$description,$date)
	{
		try 
	    {
			$sql="INSERT INTO spoblo_academywise_package_master(academy_id, package_name, package_price, package_description, created, isactive) VALUES ('".$save_New_academy."','".$packagename."','".$packageprice."','".$description."','".$date."','1')";
			$result = $this->db->query($sql);

	      	return "1";
        } catch (Exception $e) {
	          $_SESSION['db_error'] = $e->getMessage();
	    } 
	}



	/*
	=============================================================================================================
	for save new academy  //spoblo_admin/spoblo_add_academy.php
	=============================================================================================================
    */

	function get_New_academy()
	{
		try 
	    {
			$sql1="SELECT * FROM spoblo_academy_master WHERE isactive='1' ORDER BY name ASC";
			$result1 = $this->db->query($sql1);
	     	$rs=array();
	        while($data=mysqli_fetch_array($result1, MYSQLI_BOTH)) {          
	          $rs[] =$data;          
	        }
	        return $rs;
        } catch (Exception $e) {
	          $_SESSION['db_error'] = $e->getMessage();
	    } 
	}

	/*
	=============================================================================================================
	for save new academy wise gallery images  //spoblo_admin/spoblo_academywise_photos_upload.php
	=============================================================================================================
    */
	function save_New_academywise_photosgallery($academy_id,$target_path)
	{
		try 
	    {
			$sql="INSERT INTO spoblo_academywise_gallery_master(academy_id, image_path, isactive) VALUES ('".$academy_id."','".$target_path."','1')";
			$result = $this->db->query($sql);
	      	return "1";
        } catch (Exception $e) {
	          $_SESSION['db_error'] = $e->getMessage();
	    } 

	}


		/*
	=============================================================================================================
	for delete academy wise gallery photo  //spoblo_admin/spoblo_add_academy.php
	=============================================================================================================
    */
	function DeleteAcedemydata($table,$id)
	{
		try 
	    {
			$sql1="DELETE FROM ".$table." WHERE id='".$id."'";
			$result1 = $this->db->query($sql1);
	        return true;
        } catch (Exception $e) {
	          $_SESSION['db_error'] = $e->getMessage();
	    } 
	}

	function DeleteOtherdata($id)
	{
		try 
	    {
	    	include_once("encrypt-decrypt.php");
			$Encryption = new Encryption;

			$sql="SELECT * FROM spoblo_academywise_video_master WHERE isactive='1' AND academy_id='".$id."'";
			$result = $this->db->query($sql);

	        while($data=mysqli_fetch_array($result)) {          
	          		$video_path=$data['video_path'];
	          		$thumbnail=str_replace('../../','../', $data['thumbnail']);
	    			$decode=$Encryption->decode($video_path);

					$video_path=str_replace('../../','../', $decode);
	    			if (!empty($video_path) && file_exists($video_path))
				  	{
				    	unlink($video_path);
				  	}
				  	if (!empty($thumbnail) && file_exists($thumbnail))
				  	{
				    	unlink($thumbnail);
				  	}
	        }

	    	$sql="DELETE FROM spoblo_academywise_video_master WHERE academy_id='".$id."'";
			$result = $this->db->query($sql);


			$sql1="SELECT * FROM spoblo_academywise_gallery_master WHERE isactive='1' AND academy_id='".$id."'";
			$result1 = $this->db->query($sql1);

	        while($data1=mysqli_fetch_array($result1)) {          
	          		$image_path=$data1['image_path'];
					$image_path=str_replace('../../','../', $image_path);
	    			if (!empty($image_path) && file_exists($image_path))
				  	{
				    	unlink($image_path);
				  	}        
	        }

	    	$sql2="DELETE FROM spoblo_academywise_gallery_master WHERE academy_id='".$id."'";
			$result2 = $this->db->query($sql2);


			$sql3="DELETE FROM spoblo_academywise_package_master WHERE academy_id='".$id."'";
			$result3 = $this->db->query($sql3);

	        return true;
        } catch (Exception $e) {
	          $_SESSION['db_error'] = $e->getMessage();
	    } 
	}

	/*
	=============================================================================================================
	for get academy wise galeery photos  //spoblo_admin/spoblo_add_academy.php
	=============================================================================================================
    */

	function get_academywise_gallery($search_id)
	{
		try 
	    {
			$sql1="SELECT * FROM spoblo_academywise_gallery_master WHERE isactive='1' AND academy_id='".$search_id."'";
			$result1 = $this->db->query($sql1);
	     	$rs=array();
	        while($data=mysqli_fetch_array($result1, MYSQLI_BOTH)) {          
	          $rs[] =$data;          
	        }
	        return $rs;
        } catch (Exception $e) {
	          $_SESSION['db_error'] = $e->getMessage();
	    } 
	}


	/*
	=============================================================================================================
	for save academy wise video data  //spoblo_admin/spoblo_academywise_videos_upload.php
	=============================================================================================================
    */

	function save_New_academywise_Videogallery($academy_id,$target_path,$thumbnilpath)
	{
		try 
	    {
			$sql="INSERT INTO spoblo_academywise_video_master(academy_id, video_path, thumbnail, isactive) VALUES ('".$academy_id."','".$target_path."','".$thumbnilpath."','1')";
			$result = $this->db->query($sql);
	      	return "1";
        } catch (Exception $e) {
	          $_SESSION['db_error'] = $e->getMessage();
	    } 
	}


	/*
	=============================================================================================================
	for get academy wise video  //spoblo_admin/spoblo_academywise_videos.php
	=============================================================================================================
    */
	function get_academywise_video($search_id)
	{
		try 
	    {
			$sql="SELECT * FROM spoblo_academywise_video_master WHERE isactive='1' AND academy_id='".$search_id."'";
			$result = $this->db->query($sql);
	     	$rs=array();
	        while($data=mysqli_fetch_array($result, MYSQLI_BOTH)) {          
	          $rs[] =$data;          
	        }
	        return $rs;
        } catch (Exception $e) {
	          $_SESSION['db_error'] = $e->getMessage();
	    } 
	}

	/*
	=============================================================================================================
	get name wise all details of academy 
	=============================================================================================================
    */
	function get_For_all($tablename,$columnname,$value)
	{
		/*try 
	    {
			$sql="SELECT a.*,av.*,ag.* FROM spoblo_academy_master a
			LEFT OUTER JOIN spoblo_academywise_video_master av on a.id=av.academy_id
			LEFT OUTER JOIN spoblo_academywise_gallery_master ag on a.id=ag.academy_id
			WHERE a.isactive='1' AND a.name='".$academyname."'";
			$result = $this->db->query($sql);
	     	$rs=array();
	        while($data=mysqli_fetch_array($result, MYSQLI_BOTH)) {          
	          $rs[] =$data;          
	        }
	        return $rs;
        } catch (Exception $e) {
	          $_SESSION['db_error'] = $e->getMessage();
	    } */

	    try 
	    {
			$sql="SELECT * FROM ".$tablename." WHERE ".$columnname."='".$value."'";

			$result = $this->db->query($sql);
	     	$rs=array();
	        while($data=mysqli_fetch_array($result, MYSQLI_BOTH)) {          
	          $rs[] =$data;          
	        }
	        return $rs;
        } catch (Exception $e) {
	          $_SESSION['db_error'] = $e->getMessage();
	    } 
	}


	/*
	=============================================================================================================
	get academy wise students video
	=============================================================================================================
    */
	function get_academy_wise_students_videos($id)
	{
		try 
	    {
			$sql="SELECT vm.video_path,
			vm.id as video_id,
			vm.thumbnail			
			FROM spoblo_users as u 
			left outer join spoblo_rolewise_video_master vm on u.id=vm.user_id WHERE FIND_IN_SET('".$id."',u.academy_id) AND vm.video_path!=''";
			$result = $this->db->query($sql);
	     	$rs=array();
	        while($data=mysqli_fetch_array($result, MYSQLI_BOTH)) {          
	          $rs[] =$data;          
	        }
	        return $rs;
        } catch (Exception $e) {
	          $_SESSION['db_error'] = $e->getMessage();
	    } 
	}



}

?>
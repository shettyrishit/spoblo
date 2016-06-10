<?php



class spoblo_rolewise_video_master
{

	function __construct()
    {
        include('config.php'); 

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
	for save new registration data //spoblo_admin/spoblo_registration.php
	=============================================================================================================
    */

	function save_rolewise_video_master($hdn_userid,$thumbnilpath,$target_path,$videoname,$video_description)
    {
    	try 
	    {	    	
			$sql="INSERT INTO spoblo_rolewise_video_master(user_id,  video_name, video_description, video_path, thumbnail, isactive) VALUES ('".$hdn_userid."','".$videoname."','".$video_description."','".$target_path."','".$thumbnilpath."','1')";
			$result = $this->db->query($sql);
	      	return true;
 	    } catch (Exception $e) {
	        $_SESSION['db_error'] = $e->getMessage();
	    } 
    }

    /*
    =============================================================================================================
    check user record is present or not for first tym send mail with registration link //spoblo_admin/spoblo_registration.php
    =============================================================================================================
    */

    function check_user_record_present($hdn_userid)
    {   
        try 
        {           
            $sql="SELECT '1' FROM spoblo_rolewise_video_master WHERE user_id='".$hdn_userid."'";
            $result = $this->db->query($sql);
            return mysqli_num_rows($result);
        } catch (Exception $e) {
            $_SESSION['db_error'] = $e->getMessage();
        } 
    }


    /*
    =============================================================================================================
    gat user wise all details 
    =============================================================================================================
    */
    function get_For_all($tablename,$columnname,$value)
    {
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
}

?>
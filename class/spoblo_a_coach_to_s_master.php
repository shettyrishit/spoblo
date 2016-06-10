<?php



class spoblo_a_coach_to_s_master
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
	save data for assgine coach to students 
	=============================================================================================================
    */

	function save_assigncoachtostudent_data($academy,$coach,$studentList)
    {
    	try 
	    {	    	
			$sql="INSERT INTO spoblo_coachwise_student_master(academy_id, coach_id, student_id) VALUES ('".$academy."','".$coach."','".$studentList."')";
			$result = $this->db->query($sql);
	      	$insertedid = $this->db->insert_id;
            return $insertedid;
 	    } catch (Exception $e) {
	        $_SESSION['db_error'] = $e->getMessage();
	    } 
    }


}

?>
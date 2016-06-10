<?php



class spoblo_user_master
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

	function save_new_registration_data($role,$academy,$name,$email,$contact,$password,$date,$hash)
    {
    	try 
	    {	    	
			$sql="INSERT INTO spoblo_users(name, email, contactno, about_user, password, role, approved, academy_id, facebook_id, created, updated, isactive, hash, token) VALUES ('".$name."','".$email."','".$contact."','','".$password."','".$role."','y','".$academy."','','".$date."','','1','".$hash."','')";
			$result = $this->db->query($sql);
	      	return '1';
 	    } catch (Exception $e) {
	        $_SESSION['db_error'] = $e->getMessage();
	    } 
    }

	/*
	=============================================================================================================
	get user for login //
	=============================================================================================================
    */
    function user_login($Musername,$Mpassword)
	{
		try 
	    {
			/*$sql="SELECT * FROM spoblo_users WHERE hash IS NULL AND email='".$Musername."' AND password='".$Mpassword."' AND isactive='1' AND approved='y'"; */
            $sql="SELECT * FROM spoblo_users WHERE email='".$Musername."' AND password='".$Mpassword."' AND isactive='1' AND approved='y'"; 
			$result = $this->db->query($sql);
	        $rs=array();
	        while($data = mysqli_fetch_array($result)) {          
	          $rs[] =$data;          
	        }
	        return $rs;
        } catch (Exception $e) {
	          $_SESSION['db_error'] = $e->getMessage();
	    }

	}



    /*
    =============================================================================================================
    for search role or academy wise users //spoblo_admin/spoblo_users.php
    =============================================================================================================
    */

    function get_searchingwise_users($role,$academy_id)
    {
        try 
        {           
            $sql="SELECT * FROM spoblo_users WHERE isactive='1' AND role!='admin'";

            if (!empty($role)) {
                $sql=$sql." AND role='".$role."'";
            }
            if (!empty($academy_id)) {
                $sql=$sql." AND FIND_IN_SET('".$academy_id."',academy_id)";
            }
            $result = $this->db->query($sql);
            $rs=array();
            while($data=mysqli_fetch_array($result)) {          
              $rs[] =$data;          
            }
            return $rs;
        } catch (Exception $e) {
            $_SESSION['db_error'] = $e->getMessage();
        } 
    }


    /*
    =============================================================================================================
    for delete users //spoblo_admin/spoblo_users.php
    =============================================================================================================
    */
    function DeleteUserData($id)
    {
    	try 
	    {
            $sql="SELECT * FROM spoblo_rolewise_video_master WHERE user_id='".$id."'"; 
            $result = $this->db->query($sql);
            while($data=mysqli_fetch_array($result)) {          
              $video_path=str_replace('../../', '../', $data['video_path']);
              $thumbnail =str_replace('../../', '../', $data['thumbnail']);

                if (!empty($video_path) && file_exists($video_path))
                {
                    unlink($video_path);
                }
                if (!empty($thumbnail) && file_exists($thumbnail))
                {
                    unlink($thumbnail);
                }
            }

            $sql0="DELETE FROM spoblo_rolewise_video_master WHERE user_id='".$id."'";
            $result0 = $this->db->query($sql0);


			$sql1="DELETE FROM spoblo_users WHERE id='".$id."'";
			$result1 = $this->db->query($sql1);
	        return true;
        } catch (Exception $e) {
	          $_SESSION['db_error'] = $e->getMessage();
	    } 
    }



    /*
    =============================================================================================================
    for delete users //spoblo_admin/spoblo_users.php
    =============================================================================================================
    */

    function user_email_map($email)
    {
        try 
        {
            $sql="SELECT id FROM spoblo_users WHERE email='".$email."'"; 
            $result=$this->db->query($sql);
            $msg = mysqli_num_rows($result);
            if ($msg>0) {
                return "1";
            }
            else
            {
                return "0";
            }           
        } catch (Exception $e) {
              $_SESSION['db_error'] = $e->getMessage();
        }
    }


    /*
    =============================================================================================================
    get user data //spoblo_admin/spoblo_rolewise_video_master.php
    =============================================================================================================
    */

    function get_user_data($column,$hdn_userid)
    {
        try 
        {
            $sql="SELECT * FROM spoblo_users WHERE ".$column."='".$hdn_userid."'"; 
            $result = $this->db->query($sql);
            $rs=array();
            while($data=mysqli_fetch_array($result)) {          
              $rs[] =$data;          
            }
            return $rs;         

        } catch (Exception $e) {
              $_SESSION['db_error'] = $e->getMessage();
        }
    }

    /*
    =============================================================================================================
    update user data //spoblo_admin/spoblo_rolewise_video_master.php
    =============================================================================================================
    */
    function update_user($hash)
    {
        try 
        {
            $sql="UPDATE spoblo_users SET hash=NULL WHERE hash='".$hash."'"; 
            $result = $this->db->query($sql);
            return true;         
        } catch (Exception $e) {
              $_SESSION['db_error'] = $e->getMessage();
        }
    }

    /*
    =============================================================================================================
    update user data
    =============================================================================================================
    */
    function update_user_data($setcolumn,$setvalue,$whrercolumn,$whrervalue)
    {
        try 
        {
            $sql="UPDATE spoblo_users SET ".$setcolumn."='".$setvalue."' WHERE ".$whrercolumn."='".$whrervalue."'"; 
            $result = $this->db->query($sql);
            return true;         
        } catch (Exception $e) {
              $_SESSION['db_error'] = $e->getMessage();
        }
    }


    /*
    =============================================================================================================
    update user profile from profile page
    =============================================================================================================
    */
    function update_user_profile_data($name,$email,$contact,$about_user,$target_path,$date,$user_id)
    {
        try 
        {   


            $sql="UPDATE spoblo_users SET name='".$name."',email='".$email."',contactno='".$contact."',about_user='".$about_user."',updated='".$date."'";

            if ($target_path!='') {

                $sql1="SELECT photo_path FROM spoblo_users  WHERE id='".$user_id."'";  
                $result1 = $this->db->query($sql1);
                while($data=mysqli_fetch_array($result1)) {          
                        $path= $data['photo_path'];   

                        if (!empty($path) && file_exists($path))
                        {
                            unlink($path);
                        }  
                }
               $sql=$sql.", photo_path='".$target_path."'";
            }
            $sql=$sql." WHERE id='".$user_id."'"; 
            $result = $this->db->query($sql);
            return true;         
        } catch (Exception $e) {
              $_SESSION['db_error'] = $e->getMessage();
        }
    }


    function fetch_data($column,$value)
    {
        try 
        {
            $sql="SELECT su.id as user_id,
            acm.*, 
            su.name as user_name,
            acm.name as academy_name 
            FROM spoblo_users su
            LEFT OUTER JOIN spoblo_academy_master acm
            ON FIND_IN_SET(acm.id,su.academy_id) 
            WHERE ".$column."='".$value."' AND acm.name!=null"; 

            $result = $this->db->query($sql);
            $rs=array();
            while($data=mysqli_fetch_array($result)) {          
              $rs[] =$data;          
            }
            return $rs;         

        } catch (Exception $e) {
              $_SESSION['db_error'] = $e->getMessage();
        }
    }


    /*
    =============================================================================================================
    academy wise coach drop down for coach wise student listing
    =============================================================================================================
    */
    function retrive_academywise_coach($academy_id)
    {
        $coach='';
            
            $sql="SELECT * FROM spoblo_users WHERE role='Coach' AND FIND_IN_SET($academy_id,academy_id)";
            $result = $this->db->query($sql);
            $coach="<select name='coach-name' id='coach-name' class='form-control'  >
                <option value=''>Select Coach</option>";
                while($data = mysqli_fetch_array($result)) 
                {                                
                    $id     =$data["id"];                   
                    $name   =$data["name"];
                    $coach=$coach."<option value='$id'>$name</option>";
                }           
            $coach=$coach."</select>";
               
            return $coach;   
    }

    /*
    =============================================================================================================
    academy wise Student drop down for coach wise student assign
    =============================================================================================================
    */
    
    function retrive_academywise_students($academy_id)
    {
        $student=''; 
        $sql="SELECT * FROM spoblo_users WHERE role='Student' AND FIND_IN_SET($academy_id,academy_id)";
        $result = $this->db->query($sql);
        $student=$student."<label class='form-label' >Student *</label>";
        $student=$student."<select id='student' name='student[]' multiple='multiple' class='form-control'>";
            while($data = mysqli_fetch_array($result)) 
            {                                
                $id     =$data["id"];                   
                $name   =$data["name"];
                $student=$student."<option value='$id'>$name</option>";
            }           
        $student=$student."</select>";
        return $student;   
    }
    /*
    =============================================================================================================
    academy and coach wise students search for listings
    =============================================================================================================
    */
    function get_searchingwise_students($academy_id,$coach_id)
    {
        try 
        {   
            $sql="SELECT su.*,
            cws.id as coachtableid,
            (select name from spoblo_users WHERE id='$coach_id') as coachname,
            (select name from spoblo_academy_master WHERE id='$academy_id') as academyname
            FROM spoblo_coachwise_student_master as cws 
            LEFT OUTER JOIN  spoblo_users as su  ON cws.student_id=su.id       
            WHERE cws.coach_id='".$coach_id."'"; 
            $result = $this->db->query($sql);
            $rs=array();
            while($data=mysqli_fetch_array($result)) {          
              $rs[] =$data;          
            }
            return $rs;         

        } catch (Exception $e) {
              $_SESSION['db_error'] = $e->getMessage();
        }
    }

    /*
    =============================================================================================================
    get userwise academy for profile page 
    =============================================================================================================
    */
    function get_userwise_academy($user_id)
    {
        try 
        {   
            $sql="SELECT su.*,
            cws.id as coachtableid,
            (select name from spoblo_users WHERE id='$coach_id') as coachname,
            (select name from spoblo_academy_master WHERE id='$academy_id') as academyname
            FROM spoblo_coachwise_student_master as cws 
            LEFT OUTER JOIN  spoblo_users as su  ON cws.student_id=su.id       
            WHERE cws.coach_id='".$coach_id."'"; 
            $result = $this->db->query($sql);
            $rs=array();
            while($data=mysqli_fetch_array($result)) {          
              $rs[] =$data;          
            }
            return $rs;         

        } catch (Exception $e) {
              $_SESSION['db_error'] = $e->getMessage();
        }
    }


    /*
    =============================================================================================================
    for search role or academy wise users //spoblo_admin/spoblo_users.php
    =============================================================================================================
    */

    function get_coach_student_wise_data($role,$user_id)
    {
        try 
        {           
            if ($role=='Coach') {
                $column='coach_id';
                $value='student_id';
            }else { 
                $column='student_id'; 
                $value='coach_id';
            }

            $sql="SELECT ".$value." FROM spoblo_coachwise_student_master WHERE ".$column."='".$user_id."'";

            $result = $this->db->query($sql);
            $rs=array();
            while($data=mysqli_fetch_array($result)) {          
              $rs[] =$data[$value];          
            }
            
            $userid= implode(',', $rs);

            $sql1="SELECT * FROM spoblo_users WHERE id IN (".$userid.")";

            $result1 = $this->db->query($sql1);
            $rs1=array();
            while($data1=mysqli_fetch_array($result1)) {          
              $rs1[] =$data1;          
            }

            return $rs1;
        } catch (Exception $e) {
            $_SESSION['db_error'] = $e->getMessage();
        } 
    }


}

?>
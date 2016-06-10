<?php



class spoblo_common_master
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
    for generate rendom string 
    =============================================================================================================
    */

    function generateRandomString($length) 
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /*
    =============================================================================================================
    save getintouch data 
    =============================================================================================================
    */
    function save_getintouch_data($name,$email,$message,$date)
    {
        try 
        {
            $sql="INSERT INTO spoblo_getintouch_master( name, email, mesaage, created) VALUES ('".$name."','".$email."','".$message."','".$date."')";
            $result = $this->db->query($sql);
            return true;
        } catch (Exception $e) {
              $_SESSION['db_error'] = $e->getMessage();
        } 
    }

    /*
    =============================================================================================================
    get getintouch data for admin
    =============================================================================================================
    */
    function get_getintouch_data()
    {
        try 
        {
            $sql="SELECT * FROM spoblo_getintouch_master"; 
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
    get all user videos
    =============================================================================================================
    */
    function get_videos()
    {
        try 
        {
            $sql="SELECT u.*,rwvm.* FROM spoblo_users as u left outer join spoblo_rolewise_video_master as rwvm on u.id=rwvm.user_id where rwvm.video_path!=''"; 
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
}

?>
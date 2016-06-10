<?php

class spoblo_comments_master
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
    save coments data 
    =============================================================================================================
    */
    function save_New_comments($userid,$hdnvideo_id,$comments,$datetime)
    {
        try 
        {
            $sql="INSERT INTO spoblo_playerscomments_master(user_id, video_id, comments, created) VALUES ('".$userid."','".$hdnvideo_id."','".$comments."','".$datetime."')";
            $result = $this->db->query($sql);
            $inserteid = $this->db->insert_id;
            return $inserteid;
        } catch (Exception $e) {
              $_SESSION['db_error'] = $e->getMessage();
        } 
    }

    /*
    =============================================================================================================
    save coments wise photos data 
    =============================================================================================================
    */
    function save_comment_wise_photos($commented_id,$target_path)
    {
        try 
        {
            $sql="INSERT INTO spoblo_commentwise_photos(commented_id, photo_path) VALUES ('".$commented_id."','".$target_path."')";
            $result = $this->db->query($sql);
            return true;
        } catch (Exception $e) {
              $_SESSION['db_error'] = $e->getMessage();
        } 
    }

    /*
    =============================================================================================================
    save coments wise photos data 
    =============================================================================================================
    */
    function save_comment_wise_videos($commented_id,$target_path,$thumbnilpath)
    {
        try 
        {
            $sql="INSERT INTO spoblo_commentwise_videos(commented_id, video_path, video_thumbnil) VALUES ('".$commented_id."','".$target_path."','".$thumbnilpath."')";
            $result = $this->db->query($sql);
            return true;
        } catch (Exception $e) {
              $_SESSION['db_error'] = $e->getMessage();
        } 
    }



    /*
    =============================================================================================================
    get comments data
    =============================================================================================================
    */
    function get_comments_data($position,$item_per_page,$video_id)
    {
        try 
        {
            $sql="SELECT c.id as commented_id,
            c.comments,
            c.created,
            u.name,
            u.photo_path 
            FROM  spoblo_playerscomments_master as c 
            left outer join spoblo_users as u on c.user_id=u.id WHERE c.video_id='".$video_id."' ORDER BY c.id DESC LIMIT ".$position.",".$item_per_page; 
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
    get comment wise images
    =============================================================================================================
    */
    function get_commented_images($commented_id)
    {
        try 
        {
            $sql="SELECT photo_path FROM  spoblo_commentwise_photos WHERE commented_id='".$commented_id."'"; 
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
    get comment wise videos
    =============================================================================================================
    */
    function get_commented_videos($commented_id)
    {
        try 
        {
            $sql="SELECT video_path,video_thumbnil FROM spoblo_commentwise_videos WHERE commented_id='".$commented_id."'"; 
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
    for delete comments
    =============================================================================================================
    */
    function DeleteCommentdata($id)
    {
        try 
        {
            $sql="DELETE FROM spoblo_playerscomments_master WHERE id='".$id."'"; 
            $result = $this->db->query($sql);


            $sql1="SELECT * FROM spoblo_commentwise_photos WHERE commented_id='".$id."'"; 
            $result1 = $this->db->query($sql1);
            while($data1 = mysqli_fetch_array($result1)) {  
                $path =$data1['photo_path'];        
                unlink($path);         
            }

            $sql2="DELETE FROM spoblo_commentwise_photos WHERE commented_id='".$id."'"; 
            $result2 = $this->db->query($sql2);


            $sql3="SELECT * FROM spoblo_commentwise_videos WHERE commented_id='".$id."'"; 
            $result3 = $this->db->query($sql3);
            while($data2 = mysqli_fetch_array($result3)) {  
                $video_path     =$data2['video_path'];   
                $video_thumbnil =$data2['video_thumbnil'];     
                unlink($path); 
                unlink($video_thumbnil);         
            }

            $sql4="DELETE FROM spoblo_commentwise_videos WHERE commented_id='".$id."'"; 
            $result4 = $this->db->query($sql4);

            return true;
        } catch (Exception $e) {
              $_SESSION['db_error'] = $e->getMessage();
        }
    }

    /*
    =============================================================================================================
    for get time diff for comments data
    =============================================================================================================
    */
    function dateDiff($date)
    {
      date_default_timezone_set('Asia/Kolkata'); 
      $mydate= date("Y-m-d H:i:s");
      $theDiff="";
      //echo $mydate;//2014-06-06 21:35:55
      $datetime1 = date_create($date);
      $datetime2 = date_create($mydate);
      $interval = date_diff($datetime1, $datetime2);
      //echo $interval->format('%s Seconds %i Minutes %h Hours %d days %m Months %y Year    Ago')."<br>";
      $min=$interval->format('%i');
      $sec=$interval->format('%s');
      $hour=$interval->format('%h');
      $mon=$interval->format('%m');
      $day=$interval->format('%d');
      $year=$interval->format('%y');

        if($interval->format('%i%h%d%m%y')=="00000")
        {
        //echo $interval->format('%i%h%d%m%y')."<br>";
            return $sec." Seconds";
        }
        else if($interval->format('%h%d%m%y')=="0000"){
            return $min." Minutes";
        } else if($interval->format('%d%m%y')=="000"){
            return $hour." Hours";
        } else if($interval->format('%m%y')=="00"){
            return $day." Days";
        } else if($interval->format('%y')=="0"){
            return $mon." Months";
        } else{
            return $year." Years";
       }
    }
}

?>
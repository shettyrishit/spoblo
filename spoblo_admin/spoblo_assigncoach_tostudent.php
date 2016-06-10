<?php
include_once('../class/config.php');
include_once('../class/spoblo_academy_master.php');
include_once('../class/spoblo_common_master.php');
include_once('../class/spoblo_user_master.php');
$spoblo_common_master   = new spoblo_common_master;
$spoblo_academy_master  = new spoblo_academy_master;
$spoblo_user_master     = new spoblo_user_master;


if ((isset($_SESSION['spoblo_userid'])) && (isset($_SESSION['spoblo_role'])) && ($_SESSION['spoblo_role']=="admin")) {


$academy_data=$spoblo_academy_master->get_New_academy(); 



$pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
if ($_SERVER["SERVER_PORT"] != "80")
{
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
} 
else 
{
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
}
$_SESSION['prevpageurl']= $pageURL;


?>

        <?php include("header.php"); ?>
        <!-- END TOPBAR -->

        <!-- START CONTAINER -->
        <div class="page-container row-fluid">

            <!-- SIDEBAR - START -->
            <div class="page-sidebar ">
            <!-- MAIN MENU - START -->
            <?php include("menu.php"); ?>
            <!-- MAIN MENU - END -->
            </div>

            <!--  SIDEBAR - END -->

            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">
                            <div class="pull-left">
                                <h1 class="title">Assign Coach To Student</h1>                            
                            </div>
                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="index.php"><i class="fa fa-home"></i>Home</a>
                                    </li>
                                    <li>
                                        <a href="#">Masters</a>
                                    </li>
                                    <li class="active">
                                        <strong>Assign Coach To Student</strong>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Assign Coach To Student Form</h2>
                            </header>
                            <div class="content-body">
                                <div class="row">
                                    <form action="php/spoblo_assigncoach_tostudent_master.php" method="POST" id="assign-form" enctype="multipart/form-data">
                                    <div class="col-md-8 col-sm-8 col-xs-8">
                                        <div id="errordiv" class="alert alert-danger" role="alert" style="display:none;">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">Error:</span>
                                            <lable id="error"><b></b></lable> 
                                        </div> 

                                        <div id="successdiv" class="alert alert-success" role="alert" style="display:none;">
                                            <span data-class="check"><i class="fa fa-check"></i><span></span></span>
                                            <span class="sr-only">Success:</span>
                                            <lable id="success"><b></b></lable> 
                                        </div>

                                        <input type="hidden"  name="hdnrows" id="hdnrows" value="1" /> 

                                        <div class="form-group">
                                            <label class="form-label" for="field-1">Academy *</label>
                                            <div class="controls" id="academydiv">
                                                <select id="academy" name="academy" onchange="get_academywise_coach(this.value);">
                                                <option value="">Select Academy</option>
                                                    <?php 
                                                    foreach ($academy_data as $avalue) {
                                                        $academy_id     =$avalue['id'];
                                                        $academy_name   =$avalue['name'];
                                                        $city           =$avalue['city'];
                                                        if ($city=="Pune") {
                                                            ?>
                                                            <option value="<?php echo $academy_id; ?>"><?php echo $academy_name."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp - (".$city.")"; ?></option>
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <option value="<?php echo $academy_id; ?>"><?php echo $academy_name."&nbsp&nbsp&nbsp - (".$city.")";  ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
      
                                        <div class="form-group" >
                                            <label class="form-label" for="field-1">Coach *</label>
                                            <div class="controls" id="coachdiv">
                                            <div id="responseCoach">                                    
                                                <select name='coach-name' id='coach-name' class="form-control">
                                                    <option value="">Select Coach</option>                   
                                                </select>
                                            </div>  
                                            </div>
                                        </div>


                                        <div class="form-group" >                                            
                                            <div class="controls" id="studentdiv">
                                            <div id="responseStudent">       
                                            </div>  
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="controls">
                                                <button type="submit" id="assign-submit" name="assign-submit" class="btn btn-success">Save</button>
                                                <a href="spoblo_assigncoach_tostudent.php" class="btn btn-info">Cancel</a>
                                            </div>   
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                        </div>
                </section>
            </section>
            <div class="chatapi-windows "></div>    
        </div>

        <!-- END CONTAINER -->

        <?php include("footer.php"); ?>

        <script type="text/javascript">

            function get_academywise_coach(academy_id)
            {
                var coachURL='php/spoblo_mapping.php?academy_id='+academy_id;
                jQuery('#responseCoach').load(coachURL); 


                var studentURL='php/spoblo_mapping.php?academyid='+academy_id+"&role='Student'";
                jQuery('#responseStudent').load(studentURL);
            }

            $( "#assign-form" ).submit(function( event ) {
                var academy     =$('#academy').val();
                var coach       =$('#coach').val();
                var student     =$('#student').val();   

                var status=true;
                var text='Please fill all mandatory fileds !';
                if (academy==='') 
                {
                    $('#academydiv').css('border', 'solid 1px red');    
                    status = false;
                }
                else { $('#academydiv').css('border', '1px solid #e1e1e1'); }

                if (coach==='') 
                {
                    $('#coachdiv').css('border', 'solid 1px red');    
                    status = false;
                }
                else { $('#coachdiv').css('border', '1px solid #e1e1e1'); }

                if (student==null) 
                {
                    $('#studentdiv').css('border', 'solid 1px red');    
                    status = false;
                }
                else { $('#studentdiv').css('border', '1px solid #e1e1e1'); }

                if(status) 
                {
                    return true;
                }
                else
                {
                    $('#errordiv').show();
                    $('#successdiv').hide();
                    $('#error').text(text);
                    return false;
                }
            });
        </script>

<?php

include_once("spoblo_alertmessage_script.php");
}
else
{
    header("location:ui-404.html");
}
?>
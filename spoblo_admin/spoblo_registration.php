<?php
include_once('../class/config.php');
include_once('../class/spoblo_academy_master.php');
include_once('../class/spoblo_common_master.php');
//include_once('../class/spoblo_user_master.php');
$spoblo_common_master   = new spoblo_common_master;
$spoblo_academy_master  = new spoblo_academy_master;
//$spoblo_user_master     = new spoblo_user_master;


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

                                <h1 class="title">Spoblo Registration</h1>                            

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

                                        <strong>Spoblo Registration</strong>

                                    </li>

                                </ol>

                            </div>

                        </div>

                    </div>

                    <div class="clearfix"></div>





                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

                        <section class="box ">

                            <header class="panel_header">

                                <h2 class="title pull-left">Spoblo Registration Form</h2>

                            </header>

                            <div class="content-body">

                                <div class="row">

                                    <form action="php/spoblo_registration_master.php" method="POST" id="registration-form" enctype="multipart/form-data">

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

                                            <label class="form-label" for="field-1">Role *</label>

                                            <div class="controls">

                                                <select id="role" name="role" class="form-control" onchange="hideshow(this.value);">
                                                    <option value="">Select Role</option>
                                                    <option value="Coach">Coach</option>
                                                    <option value="Student">Student</option>
                                                </select>

                                            </div>

                                        </div>

                                        

                                        <div class="form-group">
                                            <label class="form-label" for="field-1">Assign Academy *</label>
                                            <div class="controls">
                                                <select id="academy" name="academy[]" multiple >
                                                    <?php 
                                                    foreach ($academy_data as $avalue) {
                                                        $academy_id     =$avalue['id'];
                                                        $academy_name   =$avalue['name'];
                                                        $city           =$avalue['city'];
                                                        if ($city=="Pune") {
                                                            ?>
                                                            <option value="<?php echo $academy_id; ?>"><?php echo "(".$city.")&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp - ".$academy_name; ?></option>
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <option value="<?php echo $academy_id; ?>"><?php echo "(".$city.")&nbsp&nbsp&nbsp - ".$academy_name; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="form-label" for="field-1">Name *</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" id="name" name="name" value="" placeholder="Enter Academy Name">
                                            </div>
                                        </div>



                                        <div class="form-group">

                                            <label class="form-label" for="field-1">Email *</label>

                                            <div class="controls">

                                                <input type="text" class="form-control" id="email" name="email" value="" placeholder="Enter Academy Name">

                                            </div>

                                        </div>


                                        <div class="form-group">
                                            <label class="form-label" for="field-1">Contact No.</label>
                                            <div class="controls">
                                                <input type="number" class="form-control" id="contact" name="contact" value="" placeholder="Enter Contact No." maxlength="15">
                                            </div>
                                        </div>



                                        <div class="form-group">

                                            <label class="form-label" for="field-1">Password *</label>

                                            <div class="controls">

                                                <input type="text" class="form-control" id="upassword" name="upassword" value="<?php echo $spoblo_common_master->generateRandomString(8);  ?>" placeholder="Enter Academy Name" readonly >

                                            </div>

                                        </div>

                                        

                                        <div class="form-group">

                                            <div class="controls">

                                                <button type="submit" id="registartion-submit" name="registartion-submit" class="btn btn-success">Save</button>

                                                <a href="spoblo_registration.php" class="btn btn-info">Cancel</a>

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

            $( "#registration-form" ).submit(function( event ) {

                var role     =$('#role').val();

                var academy  =$('#academy').val();

                var name     =$('#name').val();

                var email    =$('#email').val();   

                var status=true;

                var text='Please fill all mandatory fileds !';

                if (role==='') 

                {

                    $('#role').css('border', 'solid 1px red');    

                    status = false;

                }

                else { $('#role').css('border', '1px solid #ccc'); }

                if (academy==null) 
                {
                    $('#academy').css('border', 'solid 1px red');    
                    status = false;
                }
                else { $('#academy').css('border', '1px solid #ccc'); }

                if (name==='') 

                {

                    $('#name').css('border', 'solid 1px red');    

                    status = false;

                }

                else { $('#name').css('border', '1px solid #ccc'); }

                if (email==='') 

                {

                    $('#email').css('border', 'solid 1px red');    

                    status = false;

                }else { $('#email').css('border', '1px solid #ccc'); }



                if(status) 

                {

                    return  $.ajax({

                          type: "POST",

                          url: "php/spoblo_mapping.php",

                          data: { emailid: email},

                          success: function(msg){

                            if (msg>0) 

                            {

                               

                              if (msg === "1")

                              {

                                    $('#errordiv').show();

                                    $('#email').css('border', 'solid 1px red');

                                    $('#error').text('Someone already has that email. Try another? !');

                              }                

                              event.preventDefault();         

                            }

                            else

                            { 

                                    return true;

                            }

                        },

                        async: false

                    });

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
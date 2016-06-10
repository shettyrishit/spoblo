<?php
include_once('../class/config.php');
include_once('../class/spoblo_academy_master.php');
include_once('../class/spoblo_user_master.php');

$spoblo_academy_master  = new spoblo_academy_master;
$spoblo_user_master     = new spoblo_user_master;



if ((isset($_SESSION['spoblo_userid'])) && (isset($_SESSION['spoblo_role'])) && ($_SESSION['spoblo_role']=="admin")) {

/* for academy listing */
$academy_data=$spoblo_academy_master->get_New_academy();   


/* store page url  */
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
                                <h1 class="title">Academy List</h1>                            
                            </div>
                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="index.php"><i class="fa fa-home"></i>Home</a>
                                    </li>
                                    <li>
                                        <a href="#">Listings</a>

                                    </li>
                                    <li class="active">
                                        <strong>Academy</strong>
                                     </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12">
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left">Academy Listing</h2>
                        </header>
                        <div class="content-body">    
                                <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">

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

                                    <!-- ********************************************** -->
                                    <?php
                                    if (!empty($academy_data)) {
                                    ?>
                                    <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sr.No.</th>
                                                <th>Academy Logo</th>
                                                <th>Name</th>
                                                <th>About Academy</th>
                                                <th>City</th> 
                                                <th>Action</th>                                                                 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $count=0;
                                                foreach ($academy_data as $value) {
                                                    $id             = $value['id'];                                                    
                                                    $logo_path      = str_replace('../../','../', $value['logo_path']);
                                                    $logo_path      = str_replace('../../','../', $value['logo_path']);
                                                    $name           = $value["name"];                                                                        
                                                    $about_academy  = $value['about_academy'];                                                                     
                                                    $city           = $value['city'];
                                                    $count++;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $count; ?></td>
                                                        <td>
                                                            <img src="<?php echo $logo_path; ?>" alt="academy-logo" height="70px" width="100px">
                                                        </td>
                                                        <td><a href="../academi-details.php?name=<?php echo $name; ?>"><?php echo $name; ?></a></td>
                                                        <td><?php echo $about_academy; ?></td>
                                                        <td><?php echo $city; ?></td>                                                        
                                                        <td>
                                                            <a href="spoblo_add_academy.php?update=<?php echo $id; ?>"><span data-class="pencil-square-o"><i class="fa fa-edit"></i></span></a>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                                            <a href="../class/masterdelete_operations.php?id=<?php echo $id; ?>&m=delete_academi&path=<?php echo $logo_path; ?>" role="button" onclick='return (confirm("Are you very sure, You want to delete this academy and along with all other info ( Images / Videos ) ? "))'><span data-class="trash-o"><i class="fa fa-trash-o"></i></span></a>
                                                        </td>
                                                    </tr>  
                                                <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php
                                    }
                                    else
                                    {
                                        echo "No recored found.";
                                    }
                                    ?>
                                    <!--  *********************************************** -->
                                </div>
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
            $( "#academywise-photos-form" ).submit(function( event ) {
                var role            =$('#role').val();
                var status=true;
                var text=' Please select role !';
                if (role==='') 
                {
                    $('#role').css('border', 'solid 1px red');    
                    status = false;
                }
                else { $('#role').css('border', '1px solid #ccc'); }

                if(status) 
                {
                  return true;
                }
                else
                {
                    $('#errordiv').show();
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
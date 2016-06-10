<?php

include_once('../class/config.php');

include_once("../class/spoblo_academy_master.php");

$spoblo_academy_master = new spoblo_academy_master;



if ((isset($_SESSION['spoblo_userid'])) && (isset($_SESSION['spoblo_role'])) && ($_SESSION['spoblo_role']=="admin")) {





$update_id='';



if (isset($_GET['update'])) {

   $update_id=$_GET['update'];

   $academy_data=$spoblo_academy_master->get_For_all('spoblo_academy_master','id',$update_id);  

   $academy_package_data=$spoblo_academy_master->get_For_all('spoblo_academywise_package_master','academy_id',$update_id);

}









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

                                <h1 class="title">Add Academy</h1>                            

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

                                        <strong>Add Academy</strong>

                                    </li>

                                </ol>

                            </div>

                        </div>

                    </div>

                    <div class="clearfix"></div>





                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

                        <section class="box ">

                            <header class="panel_header">

                                <h2 class="title pull-left">Add Academy Form</h2>

                            </header>

                            <div class="content-body">

                                <div class="row">

                                    <form action="php/spoblo-academy-master.php" method="post" id="academy-form" enctype="multipart/form-data">

                                    <div class="col-md-10 col-sm-10 col-xs-10">



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

                                        <input type="hidden"  name="hdn_academiid" id="hdn_academiid" value="<?php echo $update_id; ?>" /> 



                                        <div class="form-group">

                                            <label class="form-label" for="field-1">Name *</label>

                                            <div class="controls">

                                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Academy Name" value="<?php echo $academy_data[0]['name']; ?>">

                                            </div>

                                        </div>



                                        <div class="form-group">

                                            <label class="form-label" for="field-6">About Academy *</label>

                                            <div class="controls">

                                                <textarea class="form-control" cols="5" id="about_academy" name="about_academy" placeholder="Enter About Academy"><?php echo $academy_data[0]['about_academy']; ?></textarea>

                                            </div>

                                        </div>



                                        <div class="form-group">

                                            <label class="form-label" for="field-6">Address Map</label>

                                            <span class="desc">"map iframe" <font color="red"> NOTE: Iframe Height and width must be like - width="100%" height="500"</font></span>

                                            <div class="controls">

                                                <textarea class="form-control" cols="5" id="address_map" name="address_map" placeholder="Enter Address Map"><?php echo $academy_data[0]['address_map']; ?></textarea>

                                            </div>

                                        </div>



                                        <div class="form-group">

                                            <label class="form-label" for="field-6">City *</label>

                                            <div class="controls">

                                                <select id="city" name="city" class="form-control">

                                                    <option value="">Select City</option>

                                                    <?php

                                                    if (!empty($academy_data[0]['city'])) {

                                                        if ($academy_data[0]['city']=="Mumbai") {

                                                            ?>

                                                            <option value="Mumbai"selected >Mumbai</option>

                                                            <option value="Pune">Pune</option>

                                                            <?php

                                                        }

                                                        else if ($academy_data[0]['city']=="Pune") {

                                                            ?>

                                                            <option value="Mumbai">Mumbai</option>

                                                            <option value="Pune" selected>Pune</option>

                                                            <?php

                                                        }

                                                        else

                                                        {

                                                            ?>

                                                            <option value="Mumbai">Mumbai</option>

                                                            <option value="Pune">Pune</option>

                                                            <?php

                                                        }

                                                    }

                                                    else

                                                    {

                                                        ?>

                                                            <option value="Mumbai">Mumbai</option>

                                                            <option value="Pune">Pune</option>

                                                        <?php

                                                    }

                                                    ?>                                                    

                                                </select>

                                            </div>

                                        </div>



                                        <!--  Rates & Packages -->

                                         

<!--  ====================================================================

Edit Rates & Packages section

========================================================================== -->

                    <?php

                    if (!empty($academy_package_data)) {

                          ?>

                           <div class="form-group">  

                                  <label class="form-label" for="field-6">Edit Rates & Packages</label>

                                  <div class="controls">                                       

                                    <table class='table table-striped table-bordered' >

                                    <thead>

                                      <tr  class="alert alert-info" style="background-color: #595958;">

                                        <th>Sr.No.</th>

                                        <th>Package Name</th>

                                        <th>Package Price</th>   

                                        <th>Package Description</th>    

                                        <th>Delete</th>

                                      </tr>

                                    </thead>

                                    <tbody>

                                      <?php

                                      $t_count=1;

                                      foreach ($academy_package_data as $dvalue) {

                                          $p_id             =$dvalue['id'];

                                          $package_name     =$dvalue['package_name'];

                                          $package_price    =$dvalue['package_price'];

                                          $package_description =$dvalue['package_description'];

                                      ?>

                                          <tr>

                                            <td><?php echo $t_count; ?></td>

                                            <td><?php echo $package_name; ?></td>

                                            <td><?php echo $package_price; ?></td>   

                                            <td><?php echo $package_description; ?></td> 

                                            <td align="center">                                           

                                                <a href="../class/masterdelete_operations.php?id=<?php echo $p_id; ?>&m=package" onclick='return (confirm("Are you sure you want to delete this Package ?"))' ><span data-class="trash-o"><i class="fa fa-trash-o"></i></span></a>                                            

                                            </td>

                                          </tr>

                                      <?php

                                      $t_count++;

                                      }   

                                      ?>

                                      </tbody>

                                    </table>

                                  </div>

                                 </div>

                          <?php                                                 

                    }

                    ?>

<!--  ====================================================================

Add Rates & Packages section

========================================================================== -->    



                                        <div class="form-group">  

                                          <label class="form-label" for="field-6">Add Rates & Packages</label>

                                          <div class="controls">                                    

                                            <table id="designationTable" class='table table-striped table-bordered' >

                                              <thead>

                                                <tr class="alert alert-info">

                                                  <th>Sr.No.</th>

                                                  <th>Package Name</th>

                                                  <th>Price</th>

                                                  <th>Description</th>                                                                                      

                                                  <th>Add</th>

                                                  <th>Delete</th>

                                                </tr>

                                              </thead>

                                                <tbody>

                                                  <tr>

                                                    <td>1</td>

                                                    <td>                                                

                                                        <input type="text" class="form-control" id="packagename_1" name="packagename_1" value="" placeholder="Enter Package Name">

                                                    </td>      

                                                    <td>

                                                        <input type="text" class="form-control" id="packageprice_1" name="packageprice_1" value="" placeholder="Enter Package Price">   

                                                    </td>  

                                                    <td>

                                                        <input type="text" class="form-control" id="description_1" name="description_1" value="" placeholder="Enter Package Description">   

                                                    </td>                                                                                     

                                                    <td align="center">

                                                      <a id="addrow" onclick="return insRow()"><span data-class="plus-square-o"><i class="fa fa-plus-square-o"></i></span></a>

                                                    </td>

                                                    <td align="center">

                                                      <a id="bdelete" onclick="return deleteRow(this)" ><span data-class="minus-square-o"><i class="fa fa-minus-square-o"></i></span></a>

                                                    </td>

                                                  </tr>

                                                </tbody>

                                            </table>

                                          </div>

                                        </div>



                                        <!--  Rates & Packages End -->



                                        <!--  Facebook page link -->

                                        <div class="form-group">

                                            <label class="form-label" for="field-6">Facebook Page Link</label>

                                            <div class="controls">

                                                <textarea class="form-control" cols="5" id="fb_link" name="fb_link" placeholder="Enter Facebook Page Link"><?php echo $academy_data[0]['facebook_link']; ?></textarea>

                                            </div>

                                        </div>                                        

                                        <!-- Facebook page link End -->   





                                        <!--  Academy Logo Image -->

                                        <div class="form-group">

                                            <label class="form-label" for="field-6">Academy Logo Image</label>

                                            <div class="controls">

                                                    <div class="fileupload fileupload-new" data-provides="fileupload">

                                                      <div class="fileupload-new thumbnail" style="width: 195px; height: 150px;">



                                                        <?php                                               

                                                        if (!empty($update_id)) 

                                                        {

                                                            if (!empty($academy_data[0]['logo_path'])) {

                                                              echo "<img src='".str_replace('../../', '../', $academy_data[0]['logo_path'])."' alt='logoimage' />";                                                     

                                                            } else { echo "<img src='../img/noimage.png' alt='logoimage' />"; }

                                                        } else { echo "<img src='../img/noimage.png' alt='logoimage' />"; }

                                                        ?>

                                                            

                                                      </div>



                                                      <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 195px; max-height: 150px; line-height: 20px;"></div>

                                                      <div style="padding-top:10px;">

                                                        <span class="btn btn-file">



                                                            <?php 

                                                                if (!empty($academy_data[0]['logo_path'])) {

                                                                    echo "<span class='fileupload-new' >Update image</span>";

                                                                }

                                                                else { echo "<span class='fileupload-new' >Select image</span>"; }

                                                            ?>



                                                            <span class="fileupload-exists">Change</span>

                                                            <input type="file" class="default" id="academy_logo" name="academy_logo" accept="image/*"  >

                                                        </span>

                                                        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>

                                                        <br><br>

                                                        <span class="label label-danger">Note :</span> <font color="red" >Size ( 250 * 192 )</font>

                                                      </div>

                                                    </div>   

                                            </div>

                                        </div>                                        

                                        <!-- Academy Logo Image End -->   





                                        

                                        <div class="form-group">

                                            <div class="controls">

                                                <?php 

                                                if ($update_id>0) {

                                                    ?>

                                                    <input type="submit" id="academy-submit" name="academy-submit" class="btn btn-success" value="Update">

                                                    <a href="spoblo_academy.php" class="btn btn-info">Back</a>

                                                    <?php

                                                }

                                                else

                                                {

                                                    ?>

                                                    <input type="submit" id="academy-submit" name="academy-submit" class="btn btn-success" value="Save">

                                                    <a href="spoblo_add_academy.php" class="btn btn-info">Cancel</a>

                                                    <?php

                                                }

                                                ?>                                                

                                                

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



            var _URL = window.URL;

            $("#academy_logo").change(function (e) {

                var file, img;

                if ((file = this.files[0])) {

                    img = new Image();

                    img.onload = function () {



                        /*if (this.width<=250 && this.height<=192 && this.width>=250 && this.height>=192) 

                        {

                            document.getElementById('academy-submit').disabled =false;

                            $('.thumbnail').css('border', 'solid 1px #ccc');  

                            $('#errordiv').hide();

                        }

                        else

                        {

                            document.getElementById('academy-submit').disabled =true;

                            $('.thumbnail').css('border', 'solid 1px red');   

                            $('#errordiv').show();

                            $('#error').text('Image height and width must be 250*192 !');

                        }*/

                    };

                    img.src = _URL.createObjectURL(file);

                }

            });



            $("#academy-form").submit(function( event ) {

                var name            =$('#name').val();

                var about_academy   =$('#about_academy').val();

                //var address_map     =$('#address_map').val();

                var city            =$('#city').val();   

                var logo            =$('#academy_logo').val();

                var hdn_academiid   =$('#hdn_academiid').val();

                var ext             =logo.substring(logo.lastIndexOf('.') + 1);



                var status=true;

                var text=' Please fill all mandatory fileds !';

                if (name==='') 

                {

                    $('#name').css('border', 'solid 1px red');    

                    status = false;

                }

                else { $('#name').css('border', '1px solid #ccc'); }

                if (about_academy==='') 

                {

                    $('#about_academy').css('border', 'solid 1px red');    

                    status = false;

                }else { $('#about_academy').css('border', '1px solid #ccc'); }

/*                if (address_map==='') 

                {

                    $('#address_map').css('border', 'solid 1px red');    

                    status = false;

                }else { $('#address_map').css('border', '1px solid #ccc'); }*/

                if (city==='') 

                {

                    $('#city').css('border', 'solid 1px red');    

                    status = false;

                }

                else { $('#city').css('border', '1px solid #ccc'); }



                if (hdn_academiid<=0) 

                {

                  if (logo==='') 

                  {

                      $('.thumbnail').css('border', 'solid 1px red');   

                      status = false;

                  }

                  else if (ext!="") 

                  {

                          $('.thumbnail').css('border', 'solid 1px #ccc');  

                          if (window.File && window.FileReader && window.FileList && window.Blob)

                          {                       

                              var fsize = $('#academy_logo')[0].files[0].size;

                              if(fsize>1048576) //do something if file size more than 1 mb (1048576)

                              {

                                  text='Type :"+ ftype +" | "+ fsize +" bites\n(File: "+fname+") Too big!'; 

                                  status = false;

                              }



                          }else{

                                  text='Please upgrade your browser, because your current browser lacks some new features we need!';

                          }

                  }

                }

                

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





     

            function insRow()

            {                 

                var count= parseInt(jQuery('#hdnrows').val())+1;                  

                var row=$('#designationTable > tbody > tr:first').clone().find('input').val('').end();

                $('#designationTable > tbody > tr:last').after(row);

                var packagename="packagename_"+count;                

                var packageprice="packageprice_"+count;  

                var description="description_"+count;     

                $("#designationTable > tbody > tr:last > td:nth-child(1)").text(count);

                $("#designationTable > tbody > tr:last > td:nth-child(2) > input").attr("id",packagename);

                $("#designationTable > tbody > tr:last > td:nth-child(2) > input").attr("name",packagename);

                $("#designationTable > tbody > tr:last > td:nth-child(3) > input").attr("id",packageprice);

                $("#designationTable > tbody > tr:last > td:nth-child(3) > input").attr("name",packageprice);

                $("#designationTable > tbody > tr:last > td:nth-child(3) > input").attr("id",description);

                $("#designationTable > tbody > tr:last > td:nth-child(3) > input").attr("name",description);

                var count= parseInt(jQuery('#hdnrows').val())+1;                    

                jQuery('#hdnrows').val(count);             

                return false;

            }



            function deleteRow(row)

            {

              var i=row.parentNode.parentNode.rowIndex;             

              if(i>1)

              {

                  document.getElementById('designationTable').deleteRow(i);

                  var count= parseInt(jQuery('#hdnrows').val())-1;

                  jQuery('#hdnrows').val(count);    

              }

            }





        </script>

<?php

include_once("spoblo_alertmessage_script.php");

}

else

{

    header("location:ui-404.html");

}

?>
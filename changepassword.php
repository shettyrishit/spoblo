<?php
include_once("class/config.php");

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

if ( (isset($_SESSION['spoblo_userid'])) || (isset($_SESSION['spoblo_rowid'])) ) {


if (isset($_GET['q'])) {
  $q=$_GET['q'];
}
?>

<!-- Header Start -->
<?php include_once("header.php"); ?>
<!-- Header Ends -->

<div class="mainContainer MainBnrContainer formContainer">
  <!-- Start Here -->
  <div class="loginContainer">
    <div class="loginForm">
      <h2>Change Password</h2>
      <p>To change your password, type password and confirm password.</p>
      <form class="loginMainForm" id="changepassword-form" action="php/spoblo_forgotpassword.php" method="post">

        <input type="hidden" name="q" id="q" value="<?php echo $q; ?>"> 
        <label for="">
          <img src="img/lock.png" alt="">
        </label>
        <input type="password" class="loginField" placeholder="Password" name="password" id="password"> 
        <span id="e_password" class="errormsg"></span>

        <div class="clearfix"></div>
        <label for="">
          <img src="img/lock.png" alt="">
        </label>
        <input type="password" class="loginField" placeholder="Confirm Password" name="cpassword" id="cpassword"> 
        <span id="e_cpassword" class="errormsg"></span>


        
        <div class="logReglog">
          <button type="submit" id="changepassword-submit" name="changepassword-submit" class="btn3">Save</button>
        </div>
        <a class="loginForgot" href="index.php">Back</a>
      </form>
    </div>
  </div>
</div>

<!-- mainContainer -->

<!-- Footer Start -->
<?php include_once("footer.php"); ?>
<!-- Footer Ends -->

<script type="text/javascript">
  $( "#changepassword-form" ).submit(function( event ) {
            var password  =$('#password').val();
            var cpassword =$('#cpassword').val();
            var status=true;
            if (password==='') 
            {
                $('#password').css('border-bottom', 'solid 1px #00E0FC');   
                $('#e_password').text("Password is required!");
                status = false;
            } else { $('#password').css('border-bottom', 'solid 1px #cbcbcb '); }
            if (cpassword==='') 
            {
                $('#cpassword').css('border-bottom', 'solid 1px #00E0FC');   
                $('#e_cpassword').text("Confirm password is required!");
                status = false;
            } else { 

              $('#cpassword').css('border-bottom', 'solid 1px #cbcbcb  '); 
              if (password!=cpassword || cpassword!=password) 
              {
                $('#cpassword').css('border-bottom', 'solid 1px #00E0FC');   
                $('#e_cpassword').text("Password and confirm password not match!");
                status = false;
              } else { $('#cpassword').css('border-bottom', 'solid 1px #cbcbcb  '); }
            }

            if(status) { return true;  } else { return false; }
  });
</script>
<?php
include_once("spoblo_alertmessage_script.php");
}
else
{
    $_SESSION['spoblo_error']=true;
    $_SESSION['spoblo_msg']='Invalid approach, Please log in.';
    header("location:login.php");
}
?>
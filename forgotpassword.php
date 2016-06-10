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

if ((!isset($_SESSION['spoblo_userid']))) {

?>

<!-- Header Start -->
<?php include_once("header.php"); ?>
<!-- Header Ends -->

<div class="mainContainer MainBnrContainer formContainer">
  <!-- Start Here -->
  <div class="loginContainer">
    <div class="loginForm">
      <h2>Reset Password</h2>
      <p>On click of submit, Verification Link will be sent to your registered email address.</p>
      <form class="loginMainForm" id="forgotpassword-form" action="php/spoblo_forgotpassword.php" method="post">
        <label for="">
          <img src="img/login-user.png" alt="">
        </label>
        <input type="text" class="loginField" placeholder="E-mail Id" id="useremail" name="useremail">
        <span id="email" class="errormsg"></span>

        <div class="clearfix"></div>
        <div class="logReglog">
          <button type="submit" id="forgotpassword-submit" name="forgotpassword-submit" class="btn3">Send</button>
        </div>
        <a class="loginForgot" href="login.php">Back</a>
      </form>
    </div>
  </div>
</div>

<!-- mainContainer -->

<!-- Footer Start -->
<?php include_once("footer.php"); ?>
<!-- Footer Ends -->

<script type="text/javascript">
  $( "#forgotpassword-form" ).submit(function( event ) {
            var useremail =$('#useremail').val();
            var status=true;
            if (useremail==='') 
            {
                $('#useremail').css('border-bottom', 'solid 1px #00E0FC');   
                $('#email').text("Email is required!");
                status = false;
            } else { 

              $('#useremail').css('border-bottom', 'solid 1px #cbcbcb '); 
              $('#email').text(''); 
              if (!ValidateEmail($("#useremail").val())) {
                $('#useremail').css('border-bottom', 'solid 1px #00E0FC')
                $('#email').text('Invalid email address !');             
                status = false;
              } 
            }

            if(status) { 
              return  $.ajax({
              type: "POST",
              url: "spoblo_admin/php/spoblo_mapping.php",
              data: { emailid: useremail},
              success: function(msg){
                    if (msg<=0) 
                    {
                        $.gritter.add({
                          title: '',
                          text: 'Email not found in our database, Please sign up!',
                          image: 'img/confirm2.png',
                          sticky: false,
                          time: ''
                        });          
                        event.preventDefault();         
                    }
                    else
                    {  
                      return true;
                    }
                },
                async: false
              });
            } else { return false; }
  });



  $(document).ready(function(){
      document.querySelector('#useremail').onkeypress = email;
  });
</script>
<?php
include_once("spoblo_alertmessage_script.php");
}
else
{
    header("location:index.php");
}
?>
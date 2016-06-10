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

<script type="text/javascript">
window.fbAsyncInit = function() {
    FB.init({
    appId      : '711688175639567', // replace your app id here
    channelUrl : 'http://www.spoblo.com/', 
    status     : true, 
    cookie     : true, 
    xfbml      : true  
    });
};
(function(d){
    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement('script'); js.id = id; js.async = true;
    js.src = "//connect.facebook.net/en_US/all.js";
    ref.parentNode.insertBefore(js, ref);
}(document));
 
function FBLogin(){
    FB.login(function(response){
        if(response.authResponse){
            window.location.href = "social_login/facebook/action.php?action=fblogin";
        }
    }, {scope: 'email,user_location'});
}
</script>


<div class="mainContainer MainBnrContainer formContainer">
  <!-- Start Here -->
  <div class="loginContainer">
    <div class="loginForm">
      <h2>Login</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam at porttitor sem. Aliquam erat volutpat placerat</p>
      <form class="loginMainForm" id="loginform" action="php/spoblo_signin.php" method="post">
        <label for="">
          <img src="img/login-user.png" alt="">
        </label>
        <input type="text" class="loginField" placeholder="E-mail Id" name="user_login" id="user_login" >
        <span id="email" class="errormsg"></span>
        <div class="clearfix"></div>

        <label for="">
          <img src="img/lock.png" alt="">
        </label>

        <input type="password" class="loginField" placeholder="Password" name="user_pass" id="user_pass"> 
        <span id="password" class="errormsg"></span>

        <div class="logReglog">
          <input type="submit" class="btn3" name="submit" id="submit" value="Login" >
        </div>

        <p class="loginOr">or login with</p>

        <div class="row">
          <div class="col-md-12">
           <button type="button" class="btn3" onclick="FBLogin();" ><i class="fa fa-facebook"></i> FACEBOOK</button>
          </div>
        </div>
        <a class="loginForgot" href="forgotpassword.php" >Forgot Password?</a>

      </form>
    </div>
  </div>
</div>

<!-- mainContainer -->

<!-- Footer Start -->
<?php include_once("footer.php"); ?>
<!-- Footer Ends -->

<script type="text/javascript">

  $( "#loginform" ).submit(function( event ) {

            var user_login =$('#user_login').val();
            var user_pass  =$('#user_pass').val();
            var status=true;
            var text=' Please fill all mandatory fileds !';
            if (user_login==='') 
            {
                $('#user_login').css('border-bottom', 'solid 1px #00E0FC');   
                $('#email').text("Email is required!");
                status = false;
            } else { 
              $('#user_login').css('border-bottom', 'solid 1px #cbcbcb '); 
              $('#email').text(''); 
              if (!ValidateEmail($("#user_login").val())) {
                $('#user_login').css('border-bottom', 'solid 1px #00E0FC')
                $('#email').text('Invalid email address !');             
                status = false;
              } 
            }

            if (user_pass==='') 
            {
                $('#user_pass').css('border-bottom', 'solid 1px #00E0FC');    
                $('#password').text("Password is required!");
                status = false;
            } else { $('#user_pass').css('border-bottom', 'solid 1px #cbcbcb '); $('#password').text(''); }

            if(status) 
            {
              return true;
            }
            else
            {
              return false;
            }

  });

 /* $(document).ready(function(){
      document.querySelector('#user_login').onkeypress = email;
  });*/

</script>
<?php
include_once("spoblo_alertmessage_script.php");
}
else
{ 
    header("location:index.php");
}
?>

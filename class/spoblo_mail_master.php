<?php

$rmail   ='';
$message ='';
$maildata='';
$linkhtml='';
$linkhtml1='';



class spoblo_mail_master
{


  function send_first_registration_link($email,$password,$name,$hash,$link)
  {

      $message=<<<EOF
              <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
              <html xmlns="http://www.w3.org/1999/xhtml">
              <head>
              <meta name="viewport" content="width=device-width" />
              <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
              <title>SPOBLO</title> 
              <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
              </head>

              <body style="font-family: 'Open Sans', sans-serif; font-weight: 400;">
              <table style="width: 100%;">

                <tr>

                  <td class="container" style="background:#fff;display:block  ; max-width:600px; margin:0 auto;">
                    <div class="content">
                    <table>
                      <tr>
                        <td class="mainDiv" style="border: 1px #F0E3E3 solid;padding: 10px;color:#50637d;">

                          <a href="#"><img src="http://www.spoblo.com/img/emailerBg.jpg" alt="img" width="100%"/></a>
                              <br><br><br>                          
                              Hi $name,
                              <br><br>
                              Thank you for using SpoBlo!!
                              <br><br>
                              Your account has been created, you can login with the following credentials after you have activated your account by pressing the below login.
                              <br><br>
                              Username: $email
                              <br>
                              Password: $password
                              <br><br> 
                              <div class="visit" style="background-color: #008b9e;display: inline-block; float: right; ">
                                <a href="http://www.spoblo.com/" target="_blank" style="color: #fff;text-decoration: none;font-size: 14px;padding: 10px 30px;display: inline-block;">VISIT US</a>
                              </div>  
                              <div class="visit" style="background-color: #008b9e;display: inline-block; float: right;margin-right: 10px; "> 
                                <a href="$link" target="_blank" style="color: #fff;text-decoration: none;font-size: 14px;padding: 10px 30px;display: inline-block;">Login</a>
                              </div>  
                              <br><br><br>

                              Kind Regards,
                              <br>
                              Team SpoBlo
                              <hr>
                              <div class="footerMain" style="clear: both;"> 
                              <div class="footerRight" style=" width: 100%;display: inline-block;font-size: 13px;color: #50637d;text-align:center;">
                                <span style=" color: #2e74b5;">SPOBLO</span>  <br>
                                B- 301, Business Suits 9, S.V.Road, Santacruz (W),  <br>
                                Mumbai-400054 <br>
                                022 65 15 1444 | <a href="#" target="_blank" style="color: #008b9e;">info@spoblo.com</a> | <a href="www.spoblo.com#" target="_blank" style="color: #008b9e;">www.spoblo.com</a>
                              </div>

                              <div class="socialMain" style="text-align: center; margin: 18px;">  
                                  <div class="social fb" style="display: inline-block;margin-right: 5px;">
                                    <a href="#" style=" text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;"> 
                                    <img src="http://www.spoblo.com/img/fb.png" alt="img" width="100%">
                                    </a>
                                  </div>
                                  <div class="social twitter" style="display: inline-block; margin-right: 5px;">
                                    <a href="#" style="text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;">  
                                    <img src="http://www.spoblo.com/img/twitter.png" alt="img" width="100%">                                 
                                    </a>
                                  </div>
                                  <div class="social" style="display: inline-block;margin-right: 5px;">
                                    <a href="#" style=" text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;"> 
                                      <img src="http://www.spoblo.com/img/linkdin.png" alt="img" width="100%">
                                    </a>
                                  </div>
                                  <div class="social" style="display: inline-block;margin-right: 5px;">
                                    <a href="#" style=" text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;"> 
                                      <img src="http://www.spoblo.com/img/insta.png" alt="img" width="100%">
                                    </a>
                                  </div>
                                  <div class="social" style="display: inline-block;margin-right: 5px;">
                                    <a href="#" style=" text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;"> 
                                      <img src="http://www.spoblo.com/img/youtube.png" alt="img" width="100%">
                                    </a>
                                  </div>
                              </div>
                            </div>

                              <font size="2">For any questions & feedback regarding spoblo, write to us on: </font><a href="#" style="color:#008b9e;font-size:14px;">info@spoblo.com</a>  

                        </td>
                      </tr>
                    </table>
                    </div>                  
                  </td>
                </tr>
              </table> 
            </body>
          </html>
EOF;

      $header = "From:info@spoblo.com \r\n";
      $header .= "MIME-Version: 1.0\r\n";
      $header .= "Content-type: text/html\r\n";
      $retval = mail ($email,'Welcome To Spoblo',$message,$header);

      return $retval;
  }


  function send_forgotpassword_email($email,$pwrurl)
  {

      $message=<<<EOF
              <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
              <html xmlns="http://www.w3.org/1999/xhtml">
              <head>
              <meta name="viewport" content="width=device-width" />
              <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
              <title>SPOBLO</title> 
              <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
              </head>

              <body style="font-family: 'Open Sans', sans-serif; font-weight: 400;">
              <table style="width: 100%;">

                <tr>

                  <td class="container" style="background:#fff;display:block  ; max-width:600px; margin:0 auto;">
                    <div class="content">
                    <table>
                      <tr>
                        <td class="mainDiv" style="border: 1px #F0E3E3 solid;padding: 10px;color:#50637d;">

                          <a href="#"><img src="http://www.spoblo.com/img/emailerBg.jpg" alt="img" width="100%"/></a>
                              <br><br><br>                          
                              Dear user,
                              <br><br>
                              If this e-mail does not apply to you please ignore it. It appears that you have requested a password reset at our website www.spoblo.com
                              <br><br>
                              To reset your password, please click the below reset password button.
                              <br><br> 
                              <div class="visit" style="background-color: #008b9e;display: inline-block; float: right; ">
                                <a href="http://www.spoblo.com/" target="_blank" style="color: #fff;text-decoration: none;font-size: 14px;padding: 10px 30px;display: inline-block;">VISIT US</a>
                              </div>  
                              <div class="visit" style="background-color: #008b9e;display: inline-block; float: right;margin-right: 10px; "> 
                                <a href="$pwrurl" target="_blank" style="color: #fff;text-decoration: none;font-size: 14px;padding: 10px 30px;display: inline-block;">RESET PASSWORD</a>
                              </div>  
                              <br><br><br>
                              Kind Regards,
                              <br>
                              Team SpoBlo
                              <hr>
                              <div class="footerMain" style="clear: both;"> 
                              <div class="footerRight" style=" width: 100%;display: inline-block;font-size: 13px;color: #50637d;text-align:center;">
                                <span style=" color: #2e74b5;">SPOBLO</span>  <br>
                                B- 301, Business Suits 9, S.V.Road, Santacruz (W),  <br>
                                Mumbai-400054 <br>
                                022 65 15 1444 | <a href="#" target="_blank" style="color: #008b9e;">info@spoblo.com</a> | <a href="www.spoblo.com#" target="_blank" style="color: #008b9e;">www.spoblo.com</a>
                              </div>

                              <div class="socialMain" style="text-align: center; margin: 18px;">  
                                  <div class="social fb" style="display: inline-block;margin-right: 5px;">
                                    <a href="#" style=" text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;"> 
                                    <img src="http://www.spoblo.com/img/fb.png" alt="img" width="100%">
                                    </a>
                                  </div>
                                  <div class="social twitter" style="display: inline-block; margin-right: 5px;">
                                    <a href="#" style="text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;">  
                                    <img src="http://www.spoblo.com/img/twitter.png" alt="img" width="100%">                                 
                                    </a>
                                  </div>
                                  <div class="social" style="display: inline-block;margin-right: 5px;">
                                    <a href="#" style=" text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;"> 
                                      <img src="http://www.spoblo.com/img/linkdin.png" alt="img" width="100%">
                                    </a>
                                  </div>
                                  <div class="social" style="display: inline-block;margin-right: 5px;">
                                    <a href="#" style=" text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;"> 
                                      <img src="http://www.spoblo.com/img/insta.png" alt="img" width="100%">
                                    </a>
                                  </div>
                                  <div class="social" style="display: inline-block;margin-right: 5px;">
                                    <a href="#" style=" text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;"> 
                                      <img src="http://www.spoblo.com/img/youtube.png" alt="img" width="100%">
                                    </a>
                                  </div>
                              </div>
                            </div>

                              <font size="2">For any questions & feedback regarding spoblo, write to us on: </font><a href="#" style="color:#008b9e;font-size:14px;">info@spoblo.com</a>  

                        </td>
                      </tr>
                    </table>
                    </div>                  
                  </td>
                </tr>
              </table> 
            </body>
          </html>
EOF;

      $header = "From:info@spoblo.com \r\n";
      $header .= "MIME-Version: 1.0\r\n";
      $header .= "Content-type: text/html\r\n";
      $retval = mail ($email,'www.spoblo.com - Password Reset',$message,$header);
      
      return $retval;
  }

  function send_view_video_mail($email,$name)
  {
    $message=<<<EOF
              <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
              <html xmlns="http://www.w3.org/1999/xhtml">
              <head>
              <meta name="viewport" content="width=device-width" />
              <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
              <title>SPOBLO</title> 
              <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
              </head>

              <body style="font-family: 'Open Sans', sans-serif; font-weight: 400;">
              <table style="width: 100%;">

                <tr>

                  <td class="container" style="background:#fff;display:block  ; max-width:600px; margin:0 auto;">
                    <div class="content">
                    <table>
                      <tr>
                        <td class="mainDiv" style="border: 1px #F0E3E3 solid;padding: 10px;color:#50637d;">

                          <a href="#"><img src="http://www.spoblo.com/img/emailerBg.jpg" alt="img" width="100%"/></a>
                              <br><br><br>                          
                              Dear $name,
                              <br><br>
                              Your video is uploded.
                              <br><br>
                              Please login to view your video.
                              <br><br> 
                              <div class="visit" style="background-color: #008b9e;display: inline-block; float: right; ">
                                <a href="http://www.spoblo.com/" target="_blank" style="color: #fff;text-decoration: none;font-size: 14px;padding: 10px 30px;display: inline-block;">VISIT US</a>
                              </div>  
                              <div class="visit" style="background-color: #008b9e;display: inline-block; float: right;margin-right: 10px; "> 
                                <a href="http://www.spoblo.com/" target="_blank" style="color: #fff;text-decoration: none;font-size: 14px;padding: 10px 30px;display: inline-block;">Login</a>
                              </div>  
                              <br><br><br>
                              Kind Regards,
                              <br>
                              Team SpoBlo
                              <hr>
                              <div class="footerMain" style="clear: both;"> 
                              <div class="footerRight" style=" width: 100%;display: inline-block;font-size: 13px;color: #50637d;text-align:center;">
                                <span style=" color: #2e74b5;">SPOBLO</span>  <br>
                                B- 301, Business Suits 9, S.V.Road, Santacruz (W),  <br>
                                Mumbai-400054 <br>
                                022 65 15 1444 | <a href="#" target="_blank" style="color: #008b9e;">info@spoblo.com</a> | <a href="www.spoblo.com#" target="_blank" style="color: #008b9e;">www.spoblo.com</a>
                              </div>

                              <div class="socialMain" style="text-align: center; margin: 18px;">  
                                  <div class="social fb" style="display: inline-block;margin-right: 5px;">
                                    <a href="#" style=" text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;"> 
                                    <img src="http://www.spoblo.com/img/fb.png" alt="img" width="100%">
                                    </a>
                                  </div>
                                  <div class="social twitter" style="display: inline-block; margin-right: 5px;">
                                    <a href="#" style="text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;">  
                                    <img src="http://www.spoblo.com/img/twitter.png" alt="img" width="100%">                                 
                                    </a>
                                  </div>
                                  <div class="social" style="display: inline-block;margin-right: 5px;">
                                    <a href="#" style=" text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;"> 
                                      <img src="http://www.spoblo.com/img/linkdin.png" alt="img" width="100%">
                                    </a>
                                  </div>
                                  <div class="social" style="display: inline-block;margin-right: 5px;">
                                    <a href="#" style=" text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;"> 
                                      <img src="http://www.spoblo.com/img/insta.png" alt="img" width="100%">
                                    </a>
                                  </div>
                                  <div class="social" style="display: inline-block;margin-right: 5px;">
                                    <a href="#" style=" text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;"> 
                                      <img src="http://www.spoblo.com/img/youtube.png" alt="img" width="100%">
                                    </a>
                                  </div>
                              </div>
                            </div>

                              <font size="2">For any questions & feedback regarding spoblo, write to us on: </font><a href="#" style="color:#008b9e;font-size:14px;">info@spoblo.com</a>  

                        </td>
                      </tr>
                    </table>
                    </div>                  
                  </td>
                </tr>
              </table> 
            </body>
          </html>
EOF;

      $header = "From:info@spoblo.com \r\n";
      $header .= "MIME-Version: 1.0\r\n";
      $header .= "Content-type: text/html\r\n";
      $retval = mail ($email,'www.spoblo.com - New Video',$message,$header);
      
      return $retval;
  }

  function send_getintouch_email($name,$email,$message,$date)
  {
        $message=<<<EOF
              <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
              <html xmlns="http://www.w3.org/1999/xhtml">
              <head>
              <meta name="viewport" content="width=device-width" />
              <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
              <title>SPOBLO</title> 
              <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
              </head>
              <body style="font-family: 'Open Sans', sans-serif; font-weight: 400;">
              <table style="width: 100%;">
                <tr>
                  <td class="container" style="background:#fff;display:block  ; max-width:600px; margin:0 auto;">
                    <div class="content">
                    <table>
                      <tr>
                        <td class="mainDiv" style="border: 1px #F0E3E3 solid;padding: 10px;color:#50637d;">

                          <a href="#"><img src="http://www.spoblo.com/img/emailerBg.jpg" alt="img" width="100%"/></a>
                              <br><br>                        
                              Dear User,
                              <br><br>
                              New request generated for get in touch.
                              <br><br>
                              Below are the details :
                              <br><br> 
                              <table>
                                <tr>
                                  <td>Name:</td>
                                  <td>$name</td>
                                </tr>
                                <tr>
                                  <td>Email:</td>
                                  <td>$email</td>
                                </tr>
                                <tr>
                                  <td>Message:</td>
                                  <td>$message</td>
                                </tr>
                                <tr>
                                  <td>Date:</td>
                                  <td>$date</td>
                                </tr>
                              </table>
                              <br><br> 
                              <div class="visit" style="background-color: #008b9e;display: inline-block; float: right; ">
                                <a href="http://www.spoblo.com/" target="_blank" style="color: #fff;text-decoration: none;font-size: 14px;padding: 10px 30px;display: inline-block;">VISIT US</a>
                              </div>  
                              <br><br>
                              Kind Regards,
                              <br>
                              Team SpoBlo
                              <hr>
                              <div class="footerMain" style="clear: both;"> 
                              <div class="footerRight" style=" width: 100%;display: inline-block;font-size: 13px;color: #50637d;text-align:center;">
                                <span style=" color: #2e74b5;">SPOBLO</span>  <br>
                                B- 301, Business Suits 9, S.V.Road, Santacruz (W),  <br>
                                Mumbai-400054 <br>
                                022 65 15 1444 | <a href="#" target="_blank" style="color: #008b9e;">info@spoblo.com</a> | <a href="www.spoblo.com#" target="_blank" style="color: #008b9e;">www.spoblo.com</a>
                              </div>

                              <div class="socialMain" style="text-align: center; margin: 18px;">  
                                  <div class="social fb" style="display: inline-block;margin-right: 5px;">
                                    <a href="#" style=" text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;"> 
                                    <img src="http://www.spoblo.com/img/fb.png" alt="img" width="100%">
                                    </a>
                                  </div>
                                  <div class="social twitter" style="display: inline-block; margin-right: 5px;">
                                    <a href="#" style="text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;">  
                                    <img src="http://www.spoblo.com/img/twitter.png" alt="img" width="100%">                                 
                                    </a>
                                  </div>
                                  <div class="social" style="display: inline-block;margin-right: 5px;">
                                    <a href="#" style=" text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;"> 
                                      <img src="http://www.spoblo.com/img/linkdin.png" alt="img" width="100%">
                                    </a>
                                  </div>
                                  <div class="social" style="display: inline-block;margin-right: 5px;">
                                    <a href="#" style=" text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;"> 
                                      <img src="http://www.spoblo.com/img/insta.png" alt="img" width="100%">
                                    </a>
                                  </div>
                                  <div class="social" style="display: inline-block;margin-right: 5px;">
                                    <a href="#" style=" text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;"> 
                                      <img src="http://www.spoblo.com/img/youtube.png" alt="img" width="100%">
                                    </a>
                                  </div>
                              </div>
                            </div>
                              <font size="2">For any questions & feedback regarding spoblo, write to us on: </font><a href="#" style="color:#008b9e;font-size:14px;">info@spoblo.com</a>  
                        </td>
                      </tr>
                    </table>
                    </div>                  
                  </td>
                </tr>
              </table> 
            </body>
          </html>
EOF;

      $header = "From:'".$email."' \r\n";
      $header .= "MIME-Version: 1.0\r\n";
      $header .= "Content-type: text/html\r\n";
      $retval = mail ('hitesh@leo9studio.com','www.spoblo.com - Get in touch request',$message,$header);
      
      return $retval;
  }


  function mail_register_via_fbuser($username,$email)
  {
    $message=<<<EOF
              <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
              <html xmlns="http://www.w3.org/1999/xhtml">
              <head>
              <meta name="viewport" content="width=device-width" />
              <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
              <title>SPOBLO</title> 
              <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
              </head>

              <body style="font-family: 'Open Sans', sans-serif; font-weight: 400;">
              <table style="width: 100%;">

                <tr>

                  <td class="container" style="background:#fff;display:block  ; max-width:600px; margin:0 auto;">
                    <div class="content">
                    <table>
                      <tr>
                        <td class="mainDiv" style="border: 1px #F0E3E3 solid;padding: 10px;color:#50637d;">

                          <a href="#"><img src="http://www.spoblo.com/img/emailerBg.jpg" alt="img" width="100%"/></a>
                              <br><br><br>                          
                              Hi $username,
                              <br><br>
                              Thank you for using SpoBlo!!
                              <br><br>
                              Your account has been created, you can login with the below login button.
                              <br><br> 
                              <div class="visit" style="background-color: #008b9e;display: inline-block; float: right; ">
                                <a href="http://www.spoblo.com/" target="_blank" style="color: #fff;text-decoration: none;font-size: 14px;padding: 10px 30px;display: inline-block;">VISIT US</a>
                              </div>  
                              <div class="visit" style="background-color: #008b9e;display: inline-block; float: right;margin-right: 10px; "> 
                                <a href="http://www.spoblo.com/" target="_blank" style="color: #fff;text-decoration: none;font-size: 14px;padding: 10px 30px;display: inline-block;">Login</a>
                              </div>  
                              <br><br><br>

                              Kind Regards,
                              <br>
                              Team SpoBlo
                              <hr>
                              <div class="footerMain" style="clear: both;"> 
                              <div class="footerRight" style=" width: 100%;display: inline-block;font-size: 13px;color: #50637d;text-align:center;">
                                <span style=" color: #2e74b5;">SPOBLO</span>  <br>
                                B- 301, Business Suits 9, S.V.Road, Santacruz (W),  <br>
                                Mumbai-400054 <br>
                                022 65 15 1444 | <a href="#" target="_blank" style="color: #008b9e;">info@spoblo.com</a> | <a href="www.spoblo.com#" target="_blank" style="color: #008b9e;">www.spoblo.com</a>
                              </div>

                              <div class="socialMain" style="text-align: center; margin: 18px;">  
                                  <div class="social fb" style="display: inline-block;margin-right: 5px;">
                                    <a href="#" style=" text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;"> 
                                    <img src="http://www.spoblo.com/img/fb.png" alt="img" width="100%">
                                    </a>
                                  </div>
                                  <div class="social twitter" style="display: inline-block; margin-right: 5px;">
                                    <a href="#" style="text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;">  
                                    <img src="http://www.spoblo.com/img/twitter.png" alt="img" width="100%">                                 
                                    </a>
                                  </div>
                                  <div class="social" style="display: inline-block;margin-right: 5px;">
                                    <a href="#" style=" text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;"> 
                                      <img src="http://www.spoblo.com/img/linkdin.png" alt="img" width="100%">
                                    </a>
                                  </div>
                                  <div class="social" style="display: inline-block;margin-right: 5px;">
                                    <a href="#" style=" text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;"> 
                                      <img src="http://www.spoblo.com/img/insta.png" alt="img" width="100%">
                                    </a>
                                  </div>
                                  <div class="social" style="display: inline-block;margin-right: 5px;">
                                    <a href="#" style=" text-decoration: none;display: block;padding: 8px 0;text-align: center;width: 40px;"> 
                                      <img src="http://www.spoblo.com/img/youtube.png" alt="img" width="100%">
                                    </a>
                                  </div>
                              </div>
                            </div>

                              <font size="2">For any questions & feedback regarding spoblo, write to us on: </font><a href="#" style="color:#008b9e;font-size:14px;">info@spoblo.com</a>  

                        </td>
                      </tr>
                    </table>
                    </div>                  
                  </td>
                </tr>
              </table> 
            </body>
          </html>
EOF;

      $header = "From:info@spoblo.com \r\n";
      $header .= "MIME-Version: 1.0\r\n";
      $header .= "Content-type: text/html\r\n";
      $retval = mail ($email,'Welcome To Spoblo',$message,$header);

      return $retval;
  }

}

?>

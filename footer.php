<!-- Footer Starts -->

<footer class="siteFooter">

  <div class="container">

    <div class="row">

<!--        
      <div class="col-md-3">  

 <h3>Spoblo</h3>

 <ul class="cntInfo">

   <li><span class="iconAbout"><img src="img/marker.png" alt=""/></span> 101, Sindhi Colony, Bani Park, Jaipur-302016</li>

   <li><span class="iconAbout"><img src="img/call.png" alt=""/></span> (+91) 9660 99 66 55</li>

   <li><span class="iconAbout"><img src="img/mail.png" alt=""/></span> support@spoblo.com</li>

 </ul>

      </div> -->

      <div class="col-md-3">

        <div class="quikLink">

          <h3>Quick Links</h3>

          <a href="about.php">About Us</a>

          <!-- <a href="#">Request a Callback </a>
          
          <a href="#">EMI Calculator</a> -->

        </div> 

      </div> 

      <div class="col-md-3">

        <div class="quikLink">

          <h3>Other Links</h3>

          <a href="#">Terms & Conditions</a>

          <a href="#">Privacy Policy</a>

          <a href="faq.php">FAQ</a>

          <a href="#">Help and Support</a>

        </div> 

      </div> 

      <div class="col-md-3">

        <h3>Social Networking</h3>

        <ul class="socilLink">

          <li><a href="#"><i class="fa fa-facebook"></i></a></li>

          <li><a href="#"><i class="fa fa-twitter"></i></a></li>

          <li><a href="#"><i class="fa fa-youtube"></i></a></li>

          <li><a href="#"><i class="fa fa-instagram"></i></a></li>

        </ul>

        <h3>Newsletter</h3>

        <form class="newLetter">

            <input type="text" class="subInput" placeholder="Email">

            <input type="submit" class="subBtn btn2" value="Send">  

        </form>

      </div>

    </div>

  </div>  

  <div class="smallFooter">

    © 2016 <b>SPOBLO</b>. All rights reserved.

  </div>

</footer>

<!-- Footer -->


<!-- Script -->

<script src="js/vendor/jquery-1.11.2.min.js"></script> <!-- jquery -->
<script src="js/vendor/bootstrap.min.js"></script> <!-- bootstrap -->  
<script src="js/jw-player.js"></script><!-- jw player --> 
<script src="js/jquery.magnific-popup.js"></script> <!-- magnific --> 
<script src="js/owl.carousel.min.js"></script><!-- owl.carousel -->
<script src="js/jquery.magnific-popup.js"></script> <!-- magnific -->
<script type="text/javascript" src="js/jquery.gritter.js"></script><!-- gritter -->
<script type="text/javascript" src="js/bootstrap-fileupload.js"></script><!-- single image upload -->
<script src="js/star-rating.js"></script> <!-- star-rating --> 
<script type="text/javascript" src="js/imagesloaded.js"></script>  <!-- Video Gallery Filter -->
<script type="text/javascript" src="js/masonry-3.1.4.js"></script>  <!-- Video Gallery Filter -->
<script type="text/javascript" src="js/masonry.filter.js"></script>  <!-- Video Gallery Filter --> 
<script src="js/main.js"></script> <!-- main -->

<script type="text/javascript">

 $(document).ready(function() {

  $('.popup-gallery').each(function() {
    var $container = $(this);
    var $imageLinks = $container.find('.item');

    var items = [];
    $imageLinks.each(function() {
      var $item = $(this);
      var type = 'image';
      if ($item.hasClass('magnific-youtube')) {
        type = 'iframe';
      }

      var magItem = {
        src: $item.attr('href'),
        type: type
      };

      magItem.title = $item.data('title');    
      items.push(magItem);
      });

    $imageLinks.magnificPopup({
      mainClass: 'mfp-fade',
      items: items,
      gallery:{
          enabled:true,
          tPrev: $(this).data('prev-text'),
          tNext: $(this).data('next-text')
      },

      type: 'image',
      callbacks: {
        beforeOpen: function() {
          var index = $imageLinks.index(this.st.el);
          if (-1 !== index) {
            this.goTo(index);
          }
        }
      }
    });
  });

  $('.owl-carousel').owlCarousel({
      loop:true,
      margin:10,
      nav:true,
      responsive:{
          0:{
              items:1
          },
          600:{
              items:3
          },
          1000:{
              items:4
          }
      }
  });

  $('.test-popup-link').magnificPopup({
    type: 'image'
    // other options
  });
});

</script>
<script type="text/javascript">

  $("#getintouch-form").submit(function( event ) {

            var c_name      =$('#c_name').val();
            var c_email     =$('#c_email').val();
            var c_message   =$('#c_message').val();
            var status=true;
            var text=' Please fill all mandatory fileds !';
            if (c_name==='') 
            {
                $('#c_name').css('border', 'solid 1px #00E0FC');   
                $('#cname').text("Name is required!");
                status = false;
            } else { $('#c_name').css('border', 'solid 1px #fff'); $('#cname').text(''); }

            if (c_email==='') 
            {
                $('#c_email').css('border', 'solid 1px #00E0FC');   
                $('#cemail').text("Name is required!");
                status = false;
            } else { 
              $('#c_email').css('border', 'solid 1px #fff '); 
              $('#cemail').text('');     
              if (!ValidateEmail($("#c_email").val())) {
                $('#c_email').css('border', 'solid 1px #00E0FC')
                $('#cemail').text('Invalid email address !');             
                status = false;
              }     
            }
            if (c_message==='') 
            {
                $('#c_message').css('border', 'solid 1px #00E0FC');    
                $('#cmessage').text("Message is required!");
                status = false;
            } else { $('#c_message').css('border', 'solid 1px #fff '); $('#cmessage').text(''); }

            if(status) 
            {
              return true;
            }
            else
            {
              return false;
            }
  });

/*  $(document).ready(function(){
      document.querySelector('#c_email').onkeypress = email;
  });

  function email(e) {
            e = e || event;
            return /[\w\.+@a-zA-Z_+?\.a-zA-Z\.]/i.test(String.fromCharCode(e.charCode || e.keyCode)) || !!(!e.charCode && ~[8,37,39,46].indexOf(e.keyCode));
  }*/

  function ValidateEmail(email) {
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
  }

</script>
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->

<script>

  // (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
  // function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
  // e=o.createElement(i);r=o.getElementsByTagName(i)[0];
  // e.src='//www.google-analytics.com/analytics.js';
  // r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
  // ga('create','UA-XXXXX-X','auto');ga('send','pageview');

</script>
</body>
</html>
  <!-- Get In Touch -->
  <div class="getInTouch" style="background: url('img/getintouch.jpg') no-repeat center center;background-size: cover;">
    <div class="container">
      <div class="row">
        <div class="col-md-12">        
          <div class="siteTitle">
            <h2>Get in touch</h2>
          </div>
          <div class="getForm">
            <form action="php/spoblo_getintouch.php" id="getintouch-form" method="post">
              <div class="row">
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Enter Name" id="c_name" name="c_name">
                  <span id="cname" class="cerrormsg"></span>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Enter email" id="c_email" name="c_email">
                  <span id="cemail" class="cerrormsg"></span>
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" placeholder="Your Comments" id="c_message" name="c_message"></textarea>
                  <span id="cmessage" class="cerrormsg"></span>
                </div> 

                <div class="col-md-12">
                  <input type="submit" class="btn btn2" id="getintouch-submit" name="getintouch-submit" value="Submit">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Get In Touch Ends -->
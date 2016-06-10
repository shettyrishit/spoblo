<?php



?>

<script type="text/javascript">

var msg ="<?php echo $_SESSION['alert_msg']; ?>";

</script>

<?php



/*=====================================================

Db Error

======================================================*/



if (isset($_SESSION['db_error'])) {

  ?>

  <script type="text/javascript">

            $(document).ready(function(){

              var msg ="<?php echo $_SESSION['db_error']; ?>";

              $('#errordiv').show();

              $('#error').text(msg);

            });

  </script>

  <?php

  unset($_SESSION['db_error']);

}



/*=====================================================

Add new academy

======================================================*/

if (isset($_SESSION['spoblo_new_academy_success'])) {

    ?>

    <script type="text/javascript">

        $('#successdiv').show();

        $('#success').text(msg);

    </script>

    <?php

    unset($_SESSION['spoblo_new_academy_success']);

}

if (isset($_SESSION['spoblo_new_academy_error'])) {

    ?>

    <script type="text/javascript">

        $('#errordiv').show();

        $('#error').text(msg);

    </script>

    <?php

    unset($_SESSION['spoblo_new_academy_error']);

}

if(isset($_SESSION['spoblo_new_academy_update'])) {

    ?>

    <script type="text/javascript">

        $('#successdiv').show();

        $('#success').text(msg);

    </script>

    <?php

    unset($_SESSION['spoblo_new_academy_update']);

}





/*=====================================================

Academy Wise Gallery Upload

======================================================*/



if (isset($_SESSION['spoblo_academywise_gallery_success'])) {

    ?>

    <script type="text/javascript">

        $('#successdiv').show();

        $('#success').text(msg);

    </script>

    <?php

    unset($_SESSION['spoblo_academywise_gallery_success']);

}

if (isset($_SESSION['spoblo_academywise_gallery_error'])) {

    ?>

    <script type="text/javascript">

        $('#errordiv').show();

        $('#error').text(msg);

    </script>

    <?php

    unset($_SESSION['spoblo_academywise_gallery_error']);

}



/*=====================================================

Academy Wise Video Upload

======================================================*/



if (isset($_SESSION['spoblo_academywise_video_success'])) {

    ?>

    <script type="text/javascript">

        $('#successdiv').show();

        $('#success').text(msg);

    </script>

    <?php

    unset($_SESSION['spoblo_academywise_video_success']);

}

if (isset($_SESSION['spoblo_academywise_video_error'])) {

    ?>

    <script type="text/javascript">

        $('#errordiv').show();

        $('#error').text(msg);

    </script>

    <?php

    unset($_SESSION['spoblo_academywise_video_error']);

}





/*=====================================================

New Registration

======================================================*/

if (isset($_SESSION['spoblo_new_registration_success'])) {

    ?>

    <script type="text/javascript">

        $('#successdiv').show();

        $('#success').text(msg);

    </script>

    <?php

    unset($_SESSION['spoblo_new_registration_success']);

}

if (isset($_SESSION['spoblo_new_registration_error'])) {

    ?>

    <script type="text/javascript">

        $('#errordiv').show();

        $('#error').text(msg);

    </script>

    <?php

    unset($_SESSION['spoblo_new_registration_error']);

}

if (isset($_SESSION['spoblo_new_registration_update'])) {

    ?>

    <script type="text/javascript">

        $('#successdiv').show();

        $('#success').text(msg);

    </script>

    <?php

    unset($_SESSION['spoblo_new_registration_update']);

}





/*=====================================================

Role wise video upload

======================================================*/

if (isset($_SESSION['spoblo_rolewise_video_success'])) {

    ?>

    <script type="text/javascript">

        $('#successdiv').show();

        $('#success').text(msg);

    </script>

    <?php

    unset($_SESSION['spoblo_rolewise_video_success']);

}

if (isset($_SESSION['spoblo_rolewise_video_error'])) {

    ?>

    <script type="text/javascript">

        $('#errordiv').show();

        $('#error').text(msg);

    </script>

    <?php

    unset($_SESSION['spoblo_rolewise_video_error']);

}



/*=====================================================

Common

======================================================*/

if (isset($_SESSION['spoblo_error'])) {

    ?>

    <script type="text/javascript">

            $(document).ready(function(){

                $('#errordiv').show();

                $('#error').text(msg);

            });

    </script>

    <?php

    unset($_SESSION['spoblo_error']);

}





if (isset($_SESSION['spoblo_success'])) {

    ?>

    <script type="text/javascript">

            $(document).ready(function(){

              $('#successdiv').show();

              $('#success').text(msg);

            });

    </script>

    <?php

    unset($_SESSION['spoblo_success']);

}

/*=====================================================

Master Delete Operation

======================================================*/



if (isset($_SESSION['deletesuccess'])) {

  ?>

  <script type="text/javascript">

            $(document).ready(function(){

              $('#successdiv').show();

              $('#success').text(msg);

            });

  </script>

  <?php

  unset($_SESSION['deletesuccess']);

}









?>
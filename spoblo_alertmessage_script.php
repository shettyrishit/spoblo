<?php



?>
<script type="text/javascript">
var msg ="<?php echo $_SESSION['spoblo_msg']; ?>";
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
user login messages
======================================================*/
if (isset($_SESSION['spoblo_error'])) {
    ?>
    <script type="text/javascript">
        $(function(){
              $.gritter.add({
                title: '',
                text: msg,
                image: 'img/confirm2.png',
                sticky: false,
                time: ''
              });
        });
    </script>
    <?php
    unset($_SESSION['spoblo_error']);
}


if (isset($_SESSION['spoblo_success'])) {
    ?>
    <script type="text/javascript">
        $(function(){
              $.gritter.add({
                title: '',
                text: msg,
                image: 'img/confirm1.png',
                sticky: false,
                time: ''
              });
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
            $.gritter.add({
                title: '',
                text: msg,
                image: 'img/confirm1.png',
                sticky: false,
                time: ''
            });
  </script>
  <?php
  unset($_SESSION['deletesuccess']);
}



?>
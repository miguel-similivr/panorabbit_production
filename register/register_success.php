<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
    header('Location: ../dashboard/dashboard.php');
} else {
    $logged = 'out';
}
?>
<?php require("../nav/include_nav.php"); ?>
<?php insertTitle(["title" => "Panorabbit Registration Successful"]); ?>

<div class="container">
  <div class="col-lg-3"></div>    
  <div class="col-lg-6 success">
          <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
          <h2>Success!</h2>
      <h4> Thank you for registering with PanoRabbit! You can now <a href="/login/login.php">log in</a> to upload your awesome 360 panoramas.</h4>
  </div>  
  <div class="col-lg-3"></div> 
</div>


<script> $(document).ready( function() {

$('.thumbnail-item').hover( function() {
    $(this).find('.thumbnail-detail').fadeIn(300);
    }, 
                           function() {
    $(this).find('.thumbnail-detail').fadeOut(100);
});

$('#commentbody').click(function(){

    $(".summit-comment").show();
} );

$('.cancel-comment').click(function(){

    $(".summit-comment").hide();
} );



});
</script>  
      


</body>
<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <p>Copyright &copy; Simili Virtual Reality Inc. 2016</p>
        <p><a href="../terms_of_service.html">Terms of Service</a></p>
        <p><a href="../privacy_policy.html">Privacy Policy</a></p>
      </div>
    </div>
  </div>
</footer>
</html>

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
<?php insertTitle(["title" => "Login to Panorabbit"]); ?>


<div class="row">
  <form class="form-signin mg-btm" action="/register/process_register.php" method="post">
      <h3 class="heading-desc"><button type="button" class="close" data-dismiss="modal">&times;</button>Register to PanoRabbit</h3>
             
      <div class="main">  
      <input type="text" class="form-control" placeholder="Username" id="username" name="username" autofocus>
      <input type="text" class="form-control" placeholder="Email" id="email" name="email" autofocus>
      <input type="password" class="form-control" placeholder="Password" id="password" name="password">
      <input type="password" class="form-control" placeholder="Confirm Password" id="confirmpwd" name="confirmpwd">
      <input type="text" class="form-control" placeholder="Beta Code(Optional)" id="betacode" name="betacode">
      <input type="checkbox" name="agreetoterms" class=" col-lg-1 col-xs-1" id="agreetoterms" name="agreetoterms">

      <p class="col-lg-11 col-xs-11">I have read and agreed to the PanoRabbit <a href="/terms_of_service.html">Terms of Service</a> and <a href="/privacy_policy.html">Privacy Policy.</a></p>
           
      <span class="clearfix"></span>  
    </div>
      <div class="login-footer">
          <div class="row">
        <div class="col-xs-6 col-md-6">
          <div class="left-section">
                      <a href="/register/forgot_password.php">Forgot your password?</a>
                      <a href="#sign in"  role="button" data-toggle="modal" data-dismiss="modal" data-target="#LoginModal" >Login</a>
                  </div>
        </div>
        <div class="col-xs-6 col-md-6 pull-right">
          <input type="button" class="btn btn-large btn-danger pull-right" value="Register" onclick="return regformhash(this.form,this.form.username,
            this.form.email,this.form.password,this.form.confirmpwd,this.form.agreetoterms);">
        </div>
      </div>
      </div>
  </form>
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

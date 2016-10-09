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
  <form class="form-signin mg-btm" action="/login/process_login.php" method="post" id="loginformsep">
    <h3 class="heading-desc">Login to PanoRabbit</h3>

    <div class="main">    
      <input type="text" name="email" class="form-control" placeholder="Email" autofocus>
      <input type="password" name="password" class="form-control" placeholder="Password">
    
      <span class="clearfix"></span>  
    </div>

    <div class="login-footer">
      <div class="row">
        <div class="col-xs-6 col-md-6">
          <div class="left-section">
            <a href="/register/forgot_password.php">Forgot your password?</a>
            <a href="#sign in"  role="button" data-toggle="modal" data-dismiss="modal" data-target="#RegisterModal">sign up now</a>         
          </div>
        </div>

        <div class="col-xs-6 col-md-6 pull-right">
            <input type="button" value="Login" class="btn btn-large btn-danger pull-right" onclick="formhash(this.form, this.form.password);">
        </div>
      </div>
    </div>
  </form>
</div>


<script> 
$(document).ready(function() {
    $('#loginformsep').keydown(function(event) {
        if (event.keyCode == 13) {
            formhash(this, this.password);
         }
    });
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

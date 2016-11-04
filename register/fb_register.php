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

if(!isset($_POST['fbid'])) {
  header('Location: ../register/register.php');
}

?>
<?php require("../nav/include_nav.php"); ?>
<?php insertTitle(["title" => "Connect PanoRabbit to Facebook"]); ?>
<div class="row">
  <form class="form-signin mg-btm" action="/register/process_register.php" method="post" id="registerfb">
      <h3 class="heading-desc"><button type="button" class="close" data-dismiss="modal">&times;</button>Register to PanoRabbit</h3>
             
      <div class="main"> 
        <p>Enter a Username to complete connecting PanoRabbit to Facebook!</p>
        <span id="user-result"></span>
        <input type="text" class="form-control" placeholder="Username" id="username" name="username" autofocus>
        <input type="hidden" id="email" name="email" value="<?php echo $_POST['fbemail']?>">
        <input type="hidden" id="password" name="password">
        <input type="hidden" id="confirmpwd" name="confirmpwd">
        <input type="hidden" id="betacode" name="betacode">
        <input type="hidden" id="facebookid" name="facebookid" value="<?php echo $_POST['fbid']?>">
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
          <input type="button" class="btn btn-large btn-danger pull-right" value="Register" onclick="return fbformhash(this.form,this.form.username,
            this.form.email,this.form.password,this.form.confirmpwd,this.betacode,this.form.agreetoterms,this.form.facebookid);">
        </div>
      </div>
      </div>
  </form>
</div>

<script>
$(document).ready(function() {
    $('#registerfb').keydown(function(event) {
        if (event.keyCode == 13) {
            return regformhash(this,this.username,this.email,this.password,this.confirmpwd,this.betacode,this.agreetoterms);
         }
    });
    var x_timer;    
    $("#username").keyup(function (e){
        clearTimeout(x_timer);
        var user_name = $(this).val();
        x_timer = setTimeout(function(){
            check_username_ajax(user_name);
        }, 1000);
    }); 

  function check_username_ajax(username){
      $("#user-result").html('<img src="ajax-loader.gif" />');
      $.post('check_username.php', {'username':username}, function(data) {
        $("#user-result").html(data);
      });
}
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

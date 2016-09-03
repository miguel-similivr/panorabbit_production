<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';
include_once '../../includes/register.inc.php';
 
sec_session_start();
?>

<?php require("../nav/include_nav.php"); ?>
<?php insertTitle(["title" => "Panorabbit Forgot Password"]); ?>

    <div class="container">
      <div class="row">
        <form class="col-lg-6" action="process_reset.php" method="post" enctype="multipart/form-data">
        	<input type="password" name="password" placeholder="Enter New Password:" class="form-username form-control" id="password">
          <input type="password" name="confirmpwd" placeholder="Confirm New Password:" class="form-username form-control" id="confirmpwd">
          <input type="hidden" name="resetkey" id="resetkey" value="<?php echo $_GET['reset']; ?>">
        	<input type="button" class="btn btn-large btn-danger pull-right" value="Reset Password" onclick="return resetpwdhash(this.form,this.form.password,this.form.confirmpwd);">
          <h3 class="error" id="img_error"></h3>
        </form>
      </div>
    </div>
        <!-- /#page-content-wrapper -->
      <!-- /#wrapper -->

      <!-- jQuery -->
    

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>


    <script src="error.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
    
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
</body>

</html>

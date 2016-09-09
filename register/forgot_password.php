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
        <form class="col-lg-6" action="check_email.php" method="post" enctype="multipart/form-data">
        	<input type="text" name="email" placeholder="Enter your email here:" class="form-username form-control" id="email">
        	<input class="btn" type="submit" value="Submit" name="submit">
        </form>
      </div>
    </div>
        <!-- /#page-content-wrapper -->
      <!-- /#wrapper -->

      <!-- jQuery -->

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

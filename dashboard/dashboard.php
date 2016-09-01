<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/upload_url.inc.php';
include_once '../../includes/functions.php';
 
sec_session_start();
?>
<?php require("../nav/include_nav.php"); ?>
<?php insertTitle(["title" => "Panorabbit Dashboard"]); ?>

  <?php if (login_check($mysqli) == false) : ?>
    <p>
        <span class="error">You are not authorized to access this page.</span> Please <a href="../login/login.php">login</a>.
    </p>
  <?php else : ?>
    <script src="../dashboard/createcontentpanels.js"></script>
    
    <div class="container">
      <div class="row">
        <?php echo '<h1 class="col-lg-12" style="text-align: center;">Hello '.$_SESSION['username'].'</h1>';?>
        <form class="col-lg-6" action="upload_img.php" method="post" enctype="multipart/form-data">
          <label>Upload an image: </label>
          <input type="file" name="fileToUpload" id="fileToUpload">
          <input type="hidden" name="username" id="username" value="<?php echo $_SESSION['username'];?>"/>
          <input class="btn" type="submit" value="Upload Image" name="submit">
          <h3 class="error" id="img_error"></h3>
        </form>
      </div>

      <!--Automatically populate images from database-->
      <div class="row" id="contentcontainer">
          <?php include('showimages.php'); ?>
          <script type="text/javascript">
          var objects = <?php echo json_encode($contentarray);?>;
          for (var p in objects) {
            createcontentpanel(objects[p], p);
          }
          </script>
          
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


  <?php endif; ?>
</body>

</html>

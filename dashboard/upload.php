<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/upload_url.inc.php';
include_once '../../includes/functions.php';
 
sec_session_start();
?>
<?php if (login_check($mysqli) == false) : header('Location: ../index.php');?>
<?php else : ?>
<?php require("../nav/include_nav.php"); ?>
<?php insertTitle(["title" => "Panorabbit Dashboard"]); ?>
<div class="container">
  <div class="addTop">
    <form action="process_upload.php" method="post" enctype="multipart/form-data">
      <div class="col-lg-12 col-xs-12 "> 
        <div class="center-block upload-contain">
          <div class="image-upload">
            <label for="fileToUpload" class="uploadlabel">
              <span class="glyphicon glyphicon-upload uploadLogo" aria-hidden="true"  role="form"></span>
            </label>

            <input type="file" name="fileToUpload" id="fileToUpload" class="center-block">
          </div>
          <input class = "col-lg-12 col-xs-12"type="text" placeholder="Image title" name="title" id="title" />
          <input class ="col-lg-12 col-xs-12"type="text" placeholder="Write a caption..." style="height:130px;" name="description" id="title"/>
        </div>
      </div>

      <input class="btn center-block" type="submit" value="Upload Image" name="submit">
    </form>
  </div>
</div>

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
<?php endif; ?>
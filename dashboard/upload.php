<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/upload_url.inc.php';
include_once '../../includes/functions.php';
 
sec_session_start();
?>
<?php if (login_check($mysqli) == false) : header('Location: ../login/login.php');?>
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

            <input type="file" name="fileToUpload" id="fileToUpload" class="center-block" accept="image/*">
          </div>
          <input class = "col-lg-12 col-xs-12"type="text" placeholder="Image title" name="title" id="title" />
          <input class ="col-lg-12 col-xs-12"type="text" placeholder="Write a caption..." style="height:130px;" name="description" id="title"/>
        </div>
      </div>

      <input class="btn center-block" type="submit" value="Upload Image" name="submit">
    </form>
  </div>
</div>

<script>
$(document).ready(function(){
  $("#fileToUpload").change(function() {
    // get the file name, possibly with path (depends on browser)
    var filename = $("#fileToUpload").val();

    // Use a regular expression to trim everything before final dot
    var extension = filename.replace(/^.*\./, '');

    // Iff there is no dot anywhere in filename, we would have extension == filename,
    // so we account for this possibility now
    if (extension == filename) {
        extension = '';
    } else {
        // if there is an extension, we convert to lower case
        // (N.B. this conversion will not effect the value of the extension
        // on the file upload.)
        extension = extension.toLowerCase();
    }

    switch (extension) {
        case 'jpg':
        case 'jpeg':
        case 'png':
        //  console.log("This works");

        // uncomment the next line to allow the form to submitted in this case:
        break;

        default:
          alert("The filetype you entered is invalid. Valid image types are jpg, jpeg and png");
          $("#fileToUpload").val('');
    }
  })
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
<?php endif; ?>
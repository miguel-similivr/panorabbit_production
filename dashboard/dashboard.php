<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';
include_once '../../includes/contentdb_connect.php';
 
sec_session_start();

$dashboardarray = array();
?>

<?php if (login_check($mysqli) == false) : header('Location: ../login/login.php');?>
<?php else : ?>
<?php require("../nav/include_nav.php"); ?>
<?php insertTitle(["title" => "Panorabbit Dashboard"]); ?>
<?php include('show_dashboardmeta.php'); ?>
<?php include('../panels/showpanels.php'); ?>

<div class="container modal fade" id="ProfilepicModal" role="dialog">
  <div class="row">
    <form class="form-signin mg-btm" action="process_profilepic.php" method="post" id="profilepicform" enctype="multipart/form-data">
      <h3 class="heading-desc"><button type="button" class="close" data-dismiss="modal">&times;</button>Change Your Profile Picture</h3>

      <div class="main">    
        <input type="file" name="fileToUpload" id="fileToUpload" class="center-block">
        <input class="btn center-block" type="submit" value="Upload Profile Picture" name="submit">
        <span class="clearfix"></span>  
      </div>

      <div class="login-footer">
        <div class="row">
          <div class="col-xs-6 col-md-6 pull-right">
              
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<script src="../dashboard/createcontentpanels.js"></script>

<div class="container user-info"> 
  <div class="col-lg-12 col-xs-12 white-background">
    <h4>
      <a href="#sign in"  role="button" data-toggle="modal" data-target="#ProfilepicModal"><img src="<?php echo $profilepicurl ?>"></a>
      <a><?php echo $_SESSION['username'] ?></a>
    </h4>    
  </div>
  <div class="col-lg-12 col-xs-12 white-background"> 
      <div class=" col-lg-4 col-xs-4">
          <span><?php echo $postcount ?> posts</span>
      </div>
      <div class=" col-lg-4 col-xs-4">
          <span><?php echo $followercount ?> followers</span>
      </div>
      <div class=" col-lg-4 col-xs-4">
          <span><?php echo $followingcount ?> following</span>
      </div>

  </div>
  <div class="col-lg-12 col-xs-12 white-background user-description" >
      <span> profile description</span>
  </div>
    
</div>

<div class="container">    
  <div class="col-lg-12 white-background">    
    <div class="col-lg-6 col-xs-6">
      <h4>Uploads</h4>
    </div> 
        
    <div class="col-lg-6 col-xs-6 view-more">
      <a>view more</a>
    </div>
  </div>  
        
    
  <div class="white-background" id="dashboardcontainer">
    <!-- Embed -->
    <div class="container modal fade "id="embed" role="dialog">
      <div class="row">
          <form class="form-signin mg-btm">
          <h3 class="heading-desc"><button type="button" class="close" data-dismiss="modal">&times;</button>Embed link</h3>
          <div class="main">  
            <input id="embed-modal" type="text" class="form-control" placeholder="Embed Code:" autofocus>
          <span class="clearfix"></span>  
          </div>
      </div>
    </div>

    <?php showDash($contentmysqli, $dashboardarray); ?>
    <script type="text/javascript">
    var objects = <?php echo json_encode($dashboardarray);?>;
    for (var p in objects) {
      createcontentpanel(objects[p], p, "dashboardcontainer");
    }
    </script>
  </div>
</div>

<?php endif; ?>
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

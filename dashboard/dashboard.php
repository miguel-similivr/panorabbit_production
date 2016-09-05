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
<?php include('showimages.php'); ?>

<script src="../dashboard/createcontentpanels.js"></script>

<div class="container">    
  <div class="col-lg-12 white-background">    
    <div class="col-lg-12 user-name">
      <h2><?php echo $_SESSION['username'] ?></h2>
    </div>
        
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
            <input type="text" class="form-control" placeholder="Embed Code:" autofocus value="panorabbot.com/sfasfaas">
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
    
    <div class =" col-lg-4 col-md-4 col-xs-12 thumbnail-item white-background " >
      <div class="thumbnail-detail container">
        <span>360° VR</span>
        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 
      </div>           
      <a class="thumbnail" href="image-view.php">
          <img src="img/vr-test.jpg"  alt="a thumbnail">
      </a>    
      <div>
        <div class="thumbnail-title">
          <a> a cool picture of a waterfall</a> 
        </div> 
        <div class="thumbnail-dash">
          <a href="#" class="btn btn-primary dropdown-toggle dash-dropdown" role="button" data-toggle="dropdown" >edit<span class="caret"></a>    
            <ul class="dropdown-menu">
              <li><a href="#">Share</a></li>
              <li><a data-toggle="modal" data-target = "#embed">Embed</a></li>
              <li><a href="#">Delete</a></li>
            </ul>
        </div>   
      </div>
     </div>
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

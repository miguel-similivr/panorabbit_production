<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
include_once '../includes/register.inc.php';
include_once '../includes/contentdb_connect.php';
include_once '../includes/content-config.php';

$populararray = array();
$recentarray = array();
$isindex = true;

sec_session_start();
?>

<?php require("nav/include_nav.php"); ?>
<?php insertTitle(["title" => "PanoRabbit | The Easiest Way to Share Your 360° Photos", "pagetype" => "index"]); ?>
<?php include('panels/showpanels.php'); ?>
<script src="/panels/createpanels.js"></script>

<!-- Part 1 virtual show -->

<div class="vitrual-show-wrapper center-block">
  <iframe src='https://panorabbit.com/frontpage_player.v1.html'   width="100%" height="100%" style='border:none' allowfullscreen></iframe>
  <div class="col-lg-12 col-md-12 col-xs-12 hop-banner noselect"> 
    <h1 class="col-lg-12 col-md-12 col-xs-12">360° Photo Sharing Made Easy</h1> 
    <h5>Upload and share your 360° photos quickly and easily</h5>
  </div>
</div>


<!-- part 2 -->
<div class="container">
  <div class="col-lg-12 col-md-12 col-xs-12 text-center"> 
    <h2 class="col-lg-12 col-md-12 col-xs-12" >Experience Moments from Anywhere in the World</h2>
    <h4>Explore what other users from around the globe have shared on mobile, desktop and Virtual Reality</h4>
    <div>
      <ul class="nav col-xs-12 col-lg-4 container centered-signup" >
          <li class="col-lg-6 col-md-6 col-xs-6"><a href="#sign up" role="button" data-toggle="modal" data-target="#RegisterModal">Sign up</a></li>
          <li class = " col-lg-6 col-md-6 col-xs-6"><a role="button" data-toggle="modal" data-dismiss="modal" data-target="#LoginModal" >Sign in</a></li>
      </ul>
    </div>
  </div>
</div>

<!-- part 3 (world map) -->

<div class="container">
  <div class="center-block">
    <img class="world-map center-block" src="img/maps.png" >
    
    <div class="vancouver map-img-wrapper">
      <div class="world-title col-xs-12">
        <a>Vancouver</a>
      </div>
      <!-- put iframe into href under the a tag -->
      <a class="thumbnail-img" href="/view.php?id=113&user=wkenny" >
        <img crossorigin='anonymous' src="https://s3-us-west-2.amazonaws.com/panorabbit001/wkenny/thumb/jErn2C_495183492.325601.jpg">
      </a>
    </div>
    
    <div class="aferica map-img-wrapper">
      <div class="world-title col-xs-12">
        <a>South America</a>
      </div>
      <a class="thumbnail-img" href="/view.php?id=116&user=DavidCh88" >
        <img crossorigin='anonymous' src="https://s3-us-west-2.amazonaws.com/panorabbit001/DavidCh88/thumb/RUpjhr_image.jpeg">
      </a>
    </div>

    <div class="hong-kong map-img-wrapper">
      <div class="world-title col-xs-12">
        <a>Hong Kong</a>
      </div>
      <a class="thumbnail-img" href="/view.php?id=119&user=veronece" >
        <img crossorigin='anonymous' src="https://s3-us-west-2.amazonaws.com/panorabbit001/veronece/thumb/9Ur2yx_image1-7.JPG">
      </a>
    </div>
  </div>
</div>

<div class="container home-board" id="popularcontainer"> 
  <div class="col-lg-12 white-background">
    <div class="col-lg-6 col-xs-6"><h4>Most popular 360° panorama</h4> </div>
    <div class="white-background">
        <?php mostPopular($contentmysqli, $populararray); ?>
        <script type="text/javascript">
        var objects = <?php echo json_encode($populararray);?>;
        for (var p in objects) {
          createpanel(objects[p], p, "popularcontainer");
        }
        </script>
		    
      </div>
  </div>
</div>

<div class="container home-board" id="recentcontainer"> 
  <div class="col-lg-12 white-background">
    <div class="col-lg-12 white-background">
      <div class="col-lg-6 col-xs-6"><h4>Our most recent 360° panorama</h4></div>
      <div class="col-lg-6 col-xs-6 view-more"><a>view more</a></div>
    </div>
    <div class="white-background">
        <?php mostRecent($contentmysqli, $recentarray, 0); ?>
        <script type="text/javascript">
        var objects = <?php echo json_encode($recentarray);?>;
        for (var p in objects) {
          createpanel(objects[p], p, "recentcontainer");
        }
        </script>
      </div>
  </div>
</div>


<script>
  var start = 9;

  $(window).scroll(function() {
    if($(window).scrollTop() == $(document).height() - $(window).height()) {
      $.ajax({
        dataType: 'json',
        url: '/panels/showpanels.php',
        type: 'POST',
        data: {scroll: start},
        success: function(output) { 
          for (var p in output) {
          createpanel(output[p], p, "recentcontainer");
          }
          start = start + 9; 
        }
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
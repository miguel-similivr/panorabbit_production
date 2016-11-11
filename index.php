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
<?php insertTitle(["title" => "Panorabbit - Hop Into Moments", "pagetype" => "index"]); ?>
<?php include('panels/showpanels.php'); ?>
<script src="/panels/createpanels.js"></script>

<!-- Part 1 virtual show -->

<div class="vitrual-show-wrapper center-block">
  <iframe src='https://panorabbit.com/frontpage_player.html'   width="100%" height="100%" style='border:none' allowfullscreen></iframe>
  <div class="col-lg-12 col-md-12 col-xs-12 hop-banner noselect"> 
    <h1 class="col-lg-12 col-md-12 col-xs-12">Hop Into Moments</h1> 
    <h5>View and Share Fun Times in 360°</h5>
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
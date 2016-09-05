<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
include_once '../includes/register.inc.php';
 
sec_session_start();
?>

<?php require("nav/include_nav.php"); ?>
<?php insertTitle(["title" => "Panorabbit"]); ?>
<?php include('frontpage/showgallery.php'); ?>
<div class="container home-board" id="popularcontainer"> 
  <div class="col-lg-12 white-background">
    <h2 style="text-align:center;">Most popular 360° panorama</h2> 
    <div class="white-background">
        <?php mostPopular($contentmysqli, $populararray); ?>
        <script type="text/javascript">
        var objects = <?php echo json_encode($populararray);?>;
        for (var p in objects) {
          creategallerypanel(objects[p], p, "popularcontainer");
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
        <?php mostRecent($contentmysqli, $recentarray); ?>
        <script type="text/javascript">
        var objects = <?php echo json_encode($recentarray);?>;
        for (var p in objects) {
          creategallerypanel(objects[p], p, "recentcontainer");
        }
        </script>
      </div>
  </div>
</div>


        <script> $(document).ready( function() {

        $('.thumbnail-item').hover( function() {
            $(this).find('.thumbnail-detail').fadeIn(300);
            }, 
                                   function() {
            $(this).find('.thumbnail-detail').fadeOut(100);
        });
    
        $('#commentbody').click(function(){

            $(".summit-comment").show();
        } );
    
        $('.cancel-comment').click(function(){

            $(".summit-comment").hide();
        } );
    
    
    
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
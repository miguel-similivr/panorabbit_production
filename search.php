<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
include_once '../includes/register.inc.php';
include_once '../includes/contentdb_connect.php';
include_once '../includes/content-config.php';

$searcharray = array();
$searchinput = explode(' ', $_POST['searchquery']);
 
sec_session_start();
?>

<?php require("nav/include_nav.php"); ?>
<?php insertTitle(["title" => "Panorabbit - Hop Into Moments"]); ?>
<?php include('panels/showpanels.php'); ?>
<script src="/panels/createpanels.js"></script>

<div class="container home-board" id="recentcontainer">
  <div class="col-lg-12 white-background">
    <div class="col-lg-12 white-background">
      <div class="col-lg-6 col-xs-6"><h4>Search</h4></div>
      <div class="col-lg-6 col-xs-6 view-more"><a>view more</a></div>
    </div>
    <div class="white-background">
        <?php showSearch($contentmysqli, $searcharray, $searchinput); ?>
        <script type="text/javascript">
        var objects = <?php echo json_encode($searcharray);?>;
        for (var p in objects) {
          createpanel(objects[p], p, "recentcontainer");
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
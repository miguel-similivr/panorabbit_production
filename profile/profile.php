<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';
include_once '../../includes/register.inc.php';
 
sec_session_start();
?>

<?php require("../nav/include_nav.php"); ?>
<?php insertTitle(["page" => "Panorabbit"]); ?>
<?php include('showprofile.php'); ?>

<div class="container home-board" id="profilecontainer"> 
  <div class="col-lg-12 white-background">
    <div class="col-lg-12 white-background">
      <div class="col-lg-6 col-xs-6"><h4><?php echo $_GET['user']; ?>'s Uploads</h4></div>
      <div class="col-lg-6 col-xs-6 view-more"><a>view more</a></div>
    </div>
    <div class="white-background">
        <?php showProfile($contentmysqli, $profilearray); ?>
        <script type="text/javascript">
        var objects = <?php echo json_encode($profilearray);?>;
        for (var p in objects) {
          creategallerypanel(objects[p], p, "profilecontainer");
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

</html>
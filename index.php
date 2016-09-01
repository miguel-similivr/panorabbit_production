<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
include_once '../includes/register.inc.php';
 
sec_session_start();
?>

<?php require("nav/include_nav.php"); ?>
<?php insertTitle(["title" => "Panorabbit"]); ?>

    <div class="jumbotron fp-banner">
        <div class="container">

          <div class="starter-template ">
            <h3>Share your experience through virtual reality.<br/> Anytime, anywhere, any device.
             </h3>

          </div>
        </div>
    </div>
       
    
    <div class="container" id="contentcontainer">    
        <div class="page-header">
            <h2>Recently Posted</h2>
        </div>

        <?php include('frontpage/showgallery.php'); ?>
        <script type="text/javascript">
        var objects = <?php echo json_encode($contentarray);?>;
        for (var p in objects) {
          creategallerypanel(objects[p], p);
        }
        </script>
		    
        <div class =" col-lg-4 col-md-4 col-xs-12 thumbnail-item">
            <a class="thumbnail" href="view.php">
                <img src="images/vr-test.jpg"  alt="a thumbnail">
            </a>    
            <div class="thumbnail-detail">
                <div class="thumbnail-title">
                    <a> a cool picture of a waterfall</a> 
                </div> 
                <div class="thumbnail-counts">
                    <div class = "col-xs-8 col-md-8">
                        <a>by kenny</a> 
                    </div>
                    <div class=" col-xs-4 col-md-4">
                        <a>99+</a>
                    </div>
                </div>    
            </div>
        </div>
        <div class =" col-lg-4 col-md-4 col-xs-12 thumbnail-item">
            <a class="thumbnail" href="#">
                <img src="http://placehold.it/500x250"  alt="a thumbnail">
            </a>    
            <div class="thumbnail-detail">
                <div class="thumbnail-title">
                    <a> a cool picture of a waterfall</a> 
                </div> 
                <div class="thumbnail-counts">
                    <div class = "col-xs-8 col-md-8">
                        <a>by kenny</a> 
                    </div>
                    <div class=" col-xs-4 col-md-4">
                        <a>99+</a>
                    </div>
                </div>    
            </div>
        </div>
        
        <div class =" col-lg-4 col-md-4 col-xs-12 thumbnail-item">
            <a class="thumbnail" href="#">
                <img src="http://placehold.it/500x250"  alt="a thumbnail">
            </a>    
            <div class="thumbnail-detail">
                <div class="thumbnail-title">
                    <a> a cool picture of a waterfall</a> 
                </div> 
                <div class="thumbnail-counts">
                    <div class = "col-xs-8 col-md-8">
                        <a>by kenny</a> 
                    </div>
                    <div class=" col-xs-4 col-md-4">
                        <a>99+</a>
                    </div>
                </div>    
            </div>
        </div>
        
        <div class =" col-lg-4 col-md-4 col-xs-12 thumbnail-item">
            <a class="thumbnail" href="#">
                <img src="http://placehold.it/500x250"  alt="a thumbnail">
            </a>    
            <div class="thumbnail-detail">
                <div class="thumbnail-title">
                    <a> a cool picture of a waterfall</a> 
                </div> 
                <div class="thumbnail-counts">
                    <div class = "col-xs-8 col-md-8">
                        <a>by kenny</a> 
                    </div>
                    <div class=" col-xs-4 col-md-4">
                        <a>99+</a>
                    </div>
                </div>    
            </div>
        </div>
        
        <div class =" col-lg-4 col-md-4 col-xs-12 thumbnail-item">
            <a class="thumbnail" href="#">
                <img src="http://placehold.it/500x250"  alt="a thumbnail">
            </a>    
            <div class="thumbnail-detail">
                <div class="thumbnail-title">
                    <a> a cool picture of a waterfall</a> 
                </div> 
                <div class="thumbnail-counts">
                    <div class = "col-xs-8 col-md-8">
                        <a>by kenny</a> 
                    </div>
                    <div class=" col-xs-4 col-md-4">
                        <a>99+</a>
                    </div>
                </div>    
            </div>
        </div>
        
        <div class =" col-lg-4 col-md-4 col-xs-12 thumbnail-item">
            <a class="thumbnail" href="#">
                <img src="http://placehold.it/500x250"  alt="a thumbnail">
            </a>    
            <div class="thumbnail-detail">
                <div class="thumbnail-title">
                    <a> a cool picture of a waterfall</a> 
                </div> 
                <div class="thumbnail-counts">
                    <div class = "col-xs-8 col-md-8">
                        <a>by kenny</a> 
                    </div>
                    <div class=" col-xs-4 col-md-4">
                        <a>99+</a>
                    </div>
                </div>    
            </div>
        </div>
        
        <div class =" col-lg-4 col-md-4 col-xs-12 thumbnail-item">
            <a class="thumbnail" href="#">
                <img src="http://placehold.it/500x250"  alt="a thumbnail">
            </a>    
            <div class="thumbnail-detail">
                <div class="thumbnail-title">
                    <a> a cool picture of a waterfall</a> 
                </div> 
                <div class="thumbnail-counts">
                    <div class = "col-xs-8 col-md-8">
                        <a>by kenny</a> 
                    </div>
                    <div class=" col-xs-4 col-md-4">
                        <a>99+</a>
                    </div>
                </div>    
            </div>
        </div>
        
        <div class =" col-lg-4 col-md-4 col-xs-12 thumbnail-item">
            <a class="thumbnail" href="#">
                <img src="http://placehold.it/500x250"  alt="a thumbnail">
            </a>    
            <div class="thumbnail-detail">
                <div class="thumbnail-title">
                    <a> a cool picture of a waterfall</a> 
                </div> 
                <div class="thumbnail-counts">
                    <div class = "col-xs-8 col-md-8">
                        <a>by kenny</a> 
                    </div>
                    <div class=" col-xs-4 col-md-4">
                        <a>99+</a>
                    </div>
                </div>    
            </div>
        </div>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>



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
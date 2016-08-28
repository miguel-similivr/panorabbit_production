<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Panorabbit Viewer</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
      
    <!-- Custom styles for this template -->
    <link href="css/vr-template.css" rel="stylesheet">  
      

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="js/getparam.js"></script>
  </head>
  <body> 
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">PanoRabbit</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
                <li><a href="#explore">explore</a></li>
                <li><a href="#upload">upload</a></li>
          </ul>
            
           <ul class="nav navbar-nav navbar-right">
            <?php if(login_check($mysqli) == true) {
              echo '<li><a>Hi '.$_SESSION['username'].'!</a></li>';
              echo '<li><a href="dashboard/logout.php">log out</a></li>';
            } else {
              echo '<li><a href="login/login.php">log in</a></li>';
              echo '<li><a href="register/register.php">sign up</a> </li>';
            }
            ?> 
            </ul> 
        </div><!--/.nav-collapse -->
      </div>
    </nav>
      <div class="page-container">

      <div class="display-image"  >
        <div class="container" >    
          <div id="iframediv"></div>
        </div>
      </div>
      <script type="text/javascript">
        var viewId = getParameterByName('id');
        var viewUser = getParameterByName('user');
        var iframeDiv = document.getElementById("iframediv");
        var iframeCode = document.createElement("iframe");
        iframeCode.src = "http://panorabbit.com/player.html?id=" + viewId + "&user=" + viewUser;
        iframeCode.height = "513";
        iframeCode.width = "1026";
        iframeCode.style.border = "none";
        iframeCode.setAttribute('allowFullScreen', '');

        iframediv.appendChild(iframeCode);
      </script>
             
      <div class="container display-bottom">
        <div class=" col-xs-12 col-md-8 space">
          <div class="col-xs-12 col-md-12 description">
            <div class="col-xs-12 col-md-12 description-header ">
              <div class="col-md-1 col-xs-2">
                <a><img src="https://yt3.ggpht.com/-YgBs-4HuP60/AAAAAAAAAAI/AAAAAAAAAAA/U6v-KesroZU/s48-c-k-no-mo-rj-c0xffffff/photo.jpg"></a>
              </div>

              <div class="col-md-6 col-xs-9 user-detail">
                <h4><a>Kenny</a></h4>
                <button type="button" class="btn-xs btn-primary">Follow</button>
              </div>

              <div class="col-md-5 col-xs-12 stats">
                <div>
                   <span class="glyphicon glyphicon-sunglasses" aria-hidden="true"></span>
                   <span>105,002 views</span> 
                </div>
                <div>
                    <span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span>
                    <span>13,321 likes</span>
                </div>
              </div>
            </div>  

            <div class="description-content">
              <p>A picture of this pretty city that im in......#mycity #360 #vr </p>
            </div>
            <?php if(login_check($mysqli) == true) {
            echo '<div class="leave-comment col-md-12 col-xs-12">
              <form action="comment/add_comment.php"  method="post">
                <button type="button" class="btn btn-default btn-lg col-md-1 col-xs-1 like">
                  <span class="glyphicon glyphicon-heart-empty " aria-hidden="true"></span> 
                </button>
          
                <input type="text" name="commentbody" placeholder="Add a comment" id="commentbody" class="col-md-11 col-xs-10">
                <input type="hidden" name="parentid" id="parentid">
                <div class="col-md-3 col-xs-7 submit-comment"> 
                  <input class="btn cancel-comment" type="button" value="Cancel">       
                  <input class="btn submit-comment" type="submit" value="Post" name="submit">
                </div>   
                  <h3 class="error" id="com_error"></h3>
              </form>
            </div>';
            } else{
            echo '
            <div class="leave-comment col-md-12 col-xs-12">
            <h3>You must be logged in to comment.</h3>
            </div>
            ';
            }
            ?>
            
            <script type="text/javascript">
              document.getElementById("parentid").value = viewId;
            </script>
            <div class = "comment-section">
              <?php include('comment/show_comment.php') ?>
            </div>
        </div>   
      </div>

        <div class="col-xs-12 col-md-4 recommended-list">
          <h5>Recommended</h5>
          <div class ="thumbnail-item">
              <a class="thumbnail" href="image-view.php">
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
            
                
          <div class =" thumbnail-item">
            <a class="thumbnail" href="image-view.php">
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
            
          <div class =" thumbnail-item">
            <a class="thumbnail" href="image-view.php">
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
            
          <div class =" thumbnail-item">
              <a class="thumbnail" href="image-view.php">
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
            
          <div class =" thumbnail-item">
            <a class="thumbnail" href="image-view.php">
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

          $(".submit-comment").show();
      } );
  
      $('.cancel-comment').click(function(){

          $(".submit-comment").hide();
      } );
  
  
  
     });
  </script>  
</body>
</html>
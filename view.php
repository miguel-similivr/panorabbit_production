<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?= htmlspecialchars($title)?></title>

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
            <li><a href="login/login.php">log in</a> </li>
            <li><a href="register/register.php">sign up</a> </li>
            </ul> 
        </div><!--/.nav-collapse -->
      </div>
    </nav>
      <div class="page-container">

      <div class="  display-image"  >
        <div class="container" >    
          <div>
            <iframe src='https://simili.io/player.html?id=98&user=wkenny0a' height="513" width="1026" style="border:none;" allowfullscreen></iframe>
          </div>
        </div>
      </div>
             
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

              <div class="leave-comment col-md-12 col-xs-12">
                <form action="comment/add_comment.php"  method="post">
                  <button type="button" class="btn btn-default btn-lg col-md-1 col-xs-1 like">
                    <span class="glyphicon glyphicon-heart-empty " aria-hidden="true"></span> 
                  </button>
            
                  <input type="text" name="commentbody" placeholder="Add a comment" id="commentbody" class="col-md-11 col-xs-10">
                  <input type="hidden" name="parentid" id="parentid" value="94">
                  <div class="col-md-3 col-xs-7 summit-comment"> 
                    <input class="btn cancel-comment" type="button" value="cancel">       
                    <input class="btn summit-comment" type="submit" value="Post" name="submit">
                  </div>   
                    <h3 class="error" id="com_error"></h3>
                </form>
              </div>
                <div class = "comment-section">
                  <div class="comment">
                      <div class="col-xs-2 col-md-1">
                          <a>
                              <img src="https://yt3.ggpht.com/-YgBs-4HuP60/AAAAAAAAAAI/AAAAAAAAAAA/U6v-KesroZU/s48-c-k-no-mo-rj-c0xffffff/photo.jpg">
                          </a>
                      </div>
                      <div class="col-xs-10 col-md-11 ">          
                              <a>Kenny</a>
                              <p>so pretty!</p>
                      </div> 
                  </div>
                  <div class="comment">
                      <div class="col-xs-2 col-md-1">
                          <a>
                              <img src="https://yt3.ggpht.com/-YgBs-4HuP60/AAAAAAAAAAI/AAAAAAAAAAA/U6v-KesroZU/s48-c-k-no-mo-rj-c0xffffff/photo.jpg">
                          </a>
                      </div>
                      <div class="col-xs-10 col-md-11 ">          
                              <a>Kenny</a>
                              <p>what city is it?!</p>
                      </div> 
                  </div>
                  <div class="comment">
                      <div class="col-xs-2 col-md-1">
                          <a>
                              <img src="https://yt3.ggpht.com/-YgBs-4HuP60/AAAAAAAAAAI/AAAAAAAAAAA/U6v-KesroZU/s48-c-k-no-mo-rj-c0xffffff/photo.jpg">
                          </a>
                      </div>
                      <div class="col-xs-10 col-md-11 ">          
                              <a>Kenny</a>
                              <p>i like it alot!</p>
                      </div> 
                  </div>
                  <div class="comment">
                      <div class="col-xs-2 col-md-1">
                          <a>
                              <img src="https://yt3.ggpht.com/-YgBs-4HuP60/AAAAAAAAAAI/AAAAAAAAAAA/U6v-KesroZU/s48-c-k-no-mo-rj-c0xffffff/photo.jpg">
                          </a>
                      </div>
                      <div class="col-xs-10 col-md-11 ">          
                              <a>Kenny</a>
                              <p>very nice</p>
                      </div> 
                  </div>
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

          $(".summit-comment").show();
      } );
  
      $('.cancel-comment').click(function(){

          $(".summit-comment").hide();
      } );
  
  
  
     });
  </script>  
</body>
</html>
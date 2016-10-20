<!-- Page Specific-->
<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
include_once '../includes/contentdb_connect.php';
include_once '../includes/content-config.php';

sec_session_start();

include('meta/show_meta.php');

$playlistarray = array();
$recommendedarray = array();


 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>

<?php require("nav/header.php"); ?>
<!-- Generate Automation Variables -->
<?php include('panels/showpanels.php'); ?>
<script src="/panels/createpanels.js"></script>

<!-- Init Carousel -->
<script src="/js/carouseller.min.js"></script>
<script>
  $(function() {
    $('.carouseller').carouseller({
    });
  });
</script>

<!-- Start Page Content -->
<div class="page-container">
  <div class="display-image"  >
    <div class="container" >    
      <div id="iframediv"></div>
    </div>
  </div>

  <!-- Pull Iframe -->
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

    var embedcode = "123";
  </script>

  <!-- Playlist -->
  <?php if(isset($_GET['p'])): ?>
    <?php showPlaylist($contentmysqli, $playlistarray); ?>
      <div class="container home-board">
        <div class="col-lg-12 ">  
            <div class="col-lg-12" style="z-index:20;">
              <div class="col-lg-6 col-xs-12">
                  <h5><?php echo $pltitle ?></h5>
              </div> 
            </div>  

            <div class="carouseller row-fluid for-car white-background" >
              <div class="carousel-wrapper">
                <div class="carousel-items" id="carousel-container">
                  <script type="text/javascript">
                  var objects = <?php echo json_encode($playlistarray);?>;
                  for (var p in objects) {
                    createcarouselpanel(objects[p], p, "carousel-container", getParameterByName('p'));
                  }
                  </script>
                </div>
              </div>
              
              <div class="carousel-control-block">
                <div class="carousel-button-left shadow"><a href="javascript:void(0)">‹</a></div>
                <div class="carousel-button-right shadow"><a href="javascript:void(0)">›</a></div>
              </div>
            </div>
          </div>
      </div>
  <?php endif; ?>

  <!-- Embed Modal -->
  <div class="container display-bottom">
    <div class="container modal fade "id="embed" role="dialog">
      <div class="row">
        <form class="form-signin mg-btm">
        <h3 class="heading-desc">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          Embed link
        </h3>
        <div class="main"> 
          <input type="text" class="form-control" placeholder="Link" autofocus 
            value="<iframe src='http://panorabbit.com/player.html?id=<?php echo $_GET["id"] ?>&user=<?php echo $_GET["user"] ?>' height='200' width='300' style='border:none' allowfullscreen></iframe>">
          <span class="clearfix"></span> 
        </div>
        </form>
      
    </div>
  </div>

  <!-- Comment Section -->
  <div class="container display-bottom">
    <div class=" col-xs-12 col-md-8 space">
      <div class="col-xs-12 col-md-12 description">
        <div class="col-xs-12 col-md-12 description-header ">
          <div class="col-md-1 col-xs-2">
            <a><img src="<?php echo $profilepic ?>"></a>
          </div>
          <div class="col-md-6 col-xs-9 user-detail">
            <h4><a href="/profile/profile.php?user=<?php echo $_GET['user'] ?>"><?php echo $_GET["user"]?></a></h4>
            <?php if(login_check($mysqli) == false): ?>
              <a href="#sign in"  class="btn-xs btn-primary" role="button" data-toggle="modal" data-target="#LoginModal">Sign in to Follow</a>
            <?php else: ?>
              <button type="button" id="follow" class="btn-xs btn-primary">
              <?php if($isfollowed == true): ?>
              Following
              <?php else: ?>
              Follow
              <?php endif; ?>
            <?php endif; ?>
            </button>
          </div>

          <div class="col-md-5 col-xs-12 stats">
            <div class="col-md-12 col-xs-12 page-views">
                <span class="glyphicon glyphicon-sunglasses" aria-hidden="true"></span>
                <span><?php echo $views ?></span> 

                <span class="fa fa-heart-o" aria-hidden="true"></span>
                <span id="like-count"><?php echo $likes ?></span>
            </div>
            <!--
            <div>
                <span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span>
                <span>13,321 likes</span>
            </div>
            -->
            <div class="col-md-4 col-xs-6">
              <a class="btn-xs btn-block btn-social embed" data-toggle="modal" data-target ="#embed">
                <span class="fa fa-code"></span>Embed
              </a>
            </div>
 
            <div class="col-md-4 col-xs-6">
              <a class="btn-xs btn-block btn-social btn-facebook fb-share" 
              href="https://www.facebook.com/sharer.php?u=http://panorabbit.com/view.php?id=<?php echo $_GET["id"] ?>%26user=<?php echo $_GET["user"] ?>">
                <span class="fa fa-facebook"></span>Share
              </a>         
            </div>
          </div>

        </div>  

        <div class="description-content">
          <h4><?php echo $title ?></h4>
          <p><?php echo $description ?></p>
        </div>
        <?php if(login_check($mysqli) == true): ?>
        <div class="leave-comment col-md-12 col-xs-12">
          <form action="/comment/add_comment.php"  method="post">
            <button id="like" type="button" class="btn btn-default btn-lg col-md-1 col-xs-1 like">
              <?php if($isliked == true): ?>
              <span id="like-icon" class="glyphicon glyphicon-heart " aria-hidden="true"></span> 
              <?php else: ?>
              <span id="like-icon" class="glyphicon glyphicon-heart-empty " aria-hidden="true"></span>
              <?php endif; ?>
            </button>
      
            <input type="text" name="commentbody" placeholder="Add a comment" id="commentbody" class="col-md-11 col-xs-10">
            <input type="hidden" name="parentid" id="parentid" value="<?php echo $_GET["id"] ?>">
            <div class="col-md-3 col-xs-7 submit-comment"> 
              <input class="btn cancel-comment" type="button" value="Cancel">       
              <input class="btn submit-comment" type="submit" value="Post" name="submit">
            </div>
          </form>
        </div>

      <?php else: ?>
        <div class="leave-comment col-md-12 col-xs-12">
          <h3>You must <a href="#sign in"  role="button" data-toggle="modal" data-target="#LoginModal">sign in</a> to comment.</h3>
        </div>

      <?php endif; ?>
        
        <div class = "comment-section">
          <?php include('comment/show_comment.php') ?>
        </div>
    </div>   
  </div>

    <div class="col-xs-12 col-md-4 recommended-list" id="recommended-list">
      <h5>Recommended</h5>
      <?php showRecommended($contentmysqli, $recommendedarray); ?>
      <script type="text/javascript">
      var objects = <?php echo json_encode($recommendedarray);?>;
      for (var p in objects) {
        createrecommendedpanel(objects[p], p, "recommended-list");
      }
      </script>
    </div>
  </div>
</div>

<script> 
$(document).ready( function() {
  $("#like").click(function() {
    $.ajax({
        url: '/comment/add_like.php',
        type: 'POST',
        data: {parentid: <?php echo $_GET["id"] ?>},
        //success: function() { alert('Request has returned') }
    });
    if ($("#like-icon").hasClass("glyphicon-heart-empty")) {
      $("#like-icon").toggleClass("glyphicon-heart-empty glyphicon-heart");
      $("#like-count").html(parseInt($("#like-count").html(), 10)+1);
    } else {
      $("#like-icon").toggleClass("glyphicon-heart glyphicon-heart-empty");
      $("#like-count").html(parseInt($("#like-count").html(), 10)-1);
    }
  });

  $("#follow").click(function() {
    $.ajax({
        url: '/comment/add_follow.php',
        type: 'POST',
        data: {uploader_id: "<?php echo $uploader_id ?>"},
        //success: function() { alert('Request has returned') }
    });
    if ($("#follow").html() == "Follow") {
      $("#follow").html("Following");
    } else {
      $("#follow").html("Follow");
    }
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
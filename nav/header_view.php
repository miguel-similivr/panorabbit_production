<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="google-site-verification" content="upcCCzv9UpNM3uc_OleMNR6xNFh_V6AunmkwcBiyToI" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="PanoRabbit is the easiest way to upload and share your 360° photos and panoramas. Upload your own 360° and explore what our other users have shared." />

    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index, follow" />
    <meta name="google" content="nositelinkssearchbox" />


    <!-- Facebook Meta -->
    <meta property="og:title" content="<?php echo $title ?> | PanoRabbit">
    <meta property="og:url" content="https://panorabbit.com/view.php?id=<?php echo $_GET['id'] ?>\&user=<?php echo $_GET['user'] ?>">
    <meta property="og:image" content="<?php echo $url ?>">
    <meta property="og:image:secure_url" content="<?php echo $url ?>">
    <meta property="og:description" content="<?php echo $title ?>">
    <meta property="og:type"   content="website" />
    <link rel="shortcut icon" type="image/x-icon" href="/images/panorabbit_favicon.png" />

    <!-- Twitter Meta -->
    <meta name="twitter:card" content="player">
    <meta name="twitter:site" content="@PanoRabbit">
    <meta name="twitter:title" content="<?php echo $title ?>">
    <meta name="twitter:description" content="<?php echo $title ?>">
    <meta name="twitter:image" content="<?php echo $url ?>">
    <meta name="twitter:player" content="https://panorabbit.com/view.php?id=<?php echo $_GET['id'] ?>\&user=<?php echo $_GET['user'] ?>">
    <meta name="twitter:player:width" content="360">
    <meta name="twitter:player:height" content="360">

    <title><?= htmlspecialchars($title)?></title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <?php if($pagetype=="index"): ?>
    <link href="/css/general.css" rel="stylesheet">
    <?php else: ?>
    <link href="/css/vr-template.css" rel="stylesheet">
    <link href="/css/nonindex.css" rel="stylesheet">
    <?php endif; ?>
    <link href="/css/colorbox.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet">
    <link rel="stylesheet" href="/css/font-awesome.min.css">  
      
      
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/forms.js"></script>
    <script src="/js/sha512.js"></script>
    <script src="/js/getparam.js"></script>
  </head>
  <body>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-83359462-1', 'auto');
      ga('send', 'pageview');
    </script>

    <!--Log In Modal-->
    <div class="container modal fade "id="LoginModal" role="dialog">
      <div class="row">
        <form class="form-signin mg-btm" action="/login/process_login.php" method="post" id="loginform">
          <h3 class="heading-desc"><button type="button" class="close" data-dismiss="modal">&times;</button>Login to PanoRabbit</h3>
          <div class="main">
            <!--
            <input class="btn btn-lg btn-facebook btn-block" type="submit" value="Login via facebook">
            <center><h4>OR</h4></center>
            <hr/>
            -->
            <input type="text" name="email" class="form-control" placeholder="Email" autofocus>
            <input type="password" name="password" class="form-control" placeholder="Password">
            <span class="clearfix"></span>  
          </div>

          <div class="login-footer">
            <div class="row">
              <div class="col-xs-6 col-md-6">
                <div class="left-section">
                  <a href="">Forgot your password?</a>
                  <a href="#sign in"  role="button" data-toggle="modal" data-dismiss="modal" data-target="#RegisterModal">sign up now</a>             
                </div>
              </div>
              <div class="col-xs-6 col-md-6 pull-right">
                <input type="button" value="Login" class="btn btn-large btn-danger pull-right" onclick="formhash(this.form, this.form.password);">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!--Register Modal-->
    <div class="container modal fade "id="RegisterModal" role="dialog">
      <div class="row">
        <form class="form-signin mg-btm" action="/register/process_register.php" method="post" id="register">
          <h3 class="heading-desc"><button type="button" class="close" data-dismiss="modal">&times;</button>Register to PanoRabbit</h3>
          <div class="main">  
            <!--
            <input class="btn btn-lg btn-facebook btn-block" type="submit" value="Register via facebook">
            <center><h4>OR</h4></center>
            <hr/>  
            -->
            <input type="text" class="form-control" placeholder="Username" id="username" name="username" autofocus>
            <input type="text" class="form-control" placeholder="Email" id="email" name="email" autofocus>
            <input type="password" class="form-control" placeholder="Password" id="password" name="password">
            <input type="password" class="form-control" placeholder="Confirm Password" id="confirmpwd" name="confirmpwd">
            <input type="text" class="form-control" placeholder="Beta Code(Optional)" id="betacode" name="betacode">
            <input type="checkbox" name="agreetoterms" class=" col-lg-1 col-xs-1" id="agreetoterms" name="agreetoterms">
            <p class="col-lg-11 col-xs-11">I have read and agreed to the PanoRabbit <a href="/terms_of_service.html">Terms of Service</a> and <a href="/privacy_policy.html">Privacy Policy.</a></p>
          </div>
          <div class="login-footer">
            <div class="row">
              <div class="col-xs-6 col-md-6">
                <div class="left-section">
                  <a href="">Forgot your password?</a>
                  <a href="#sign in"  role="button" data-toggle="modal" data-dismiss="modal" data-target="#LoginModal" >Login</a>
                </div>
              </div>
              <div class="col-xs-6 col-md-6 pull-right">
                <input type="button" class="btn btn-large btn-danger pull-right" value="Register" onclick="return regformhash(this.form,this.form.username,
                  this.form.email,this.form.password,this.form.confirmpwd,this.form.betacode,this.form.agreetoterms);">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <nav class="navbar navbar-default navbar-fixed-top " data-spy="affix"  data-offset-top="657">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-box" href="/index.php">
            <?php if(!($pagetype=="index")): ?>
            <img src="/css/logo/panorabbit_log.png" style="max-width: 170px !important;">
            <?php endif; ?>
          </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">

            <li><a href="/explore.php">Explore</a></li>
            <li><a href="/dashboard/upload.php">Upload</a></li>

            <!--user not logged in-->
            <?php if(!isset($_SESSION["username"])): ?>
            <li><a role="button" data-toggle="modal" data-dismiss="modal" data-target="#LoginModal" >Sign in</a></li>
            <li class = "sign-up-banner"><a href="#sign up" role="button" data-toggle="modal" data-target="#RegisterModal">Sign up</a></li>

            
            
            
            <!--when user is logged in-->
            <?php elseif(isset($_SESSION["username"])): ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['username']; ?> 
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="/dashboard/upload.php">Upload</a></li>
                <li><a href="/following.php">My Feed</a></li>
                <li><a href="/dashboard/dashboard.php">Dashboard</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Settings</a></li>
                <li><a href="/dashboard/logout.php">Log Out</a></li>
              </ul>
            </li>
            <!-- end user dropdown -->
            <?php endif; ?>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <script>
      $(document).ready(function() {
          $('#loginform').keydown(function(event) {
              if (event.keyCode == 13) {
                  formhash(this, this.password);
               }
          });
      });

      $(document).ready(function() {
          $('#register').keydown(function(event) {
              if (event.keyCode == 13) {
                  return regformhash(this,this.username,this.email,this.password,this.confirmpwd,this.betacode,this.agreetoterms);
               }
          });
      });
    </script>
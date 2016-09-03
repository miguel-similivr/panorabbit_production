<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="google-site-verification" content="upcCCzv9UpNM3uc_OleMNR6xNFh_V6AunmkwcBiyToI" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?= htmlspecialchars($title)?></title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
      
    <!-- Custom styles for this template -->
    <link href="/css/vr-template.css" rel="stylesheet">  
      

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      
      
          <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/forms.js"></script>
    <script src="/js/sha512.js"></script>
    <script src="/js/getparam.js"></script>
    <script src="/frontpage/creategallerypanels.js"></script>

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
          <a class="navbar-brand" href="/index.php">PanoRabbit</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
                <li><a href="/dashboard/dashboard.php">upload</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
          <?php if(isset($_SESSION["username"])) {
            echo '<li><a>Hi '.$_SESSION['username'].'!</a></li>';
            echo '<li><a href="/dashboard/logout.php">log out</a></li>';
          } else {
            echo '<li><a href="#sign in"  role="button" data-toggle="modal" data-target="#LoginModal">sign in</a> </li>';
            echo '<li><a href="#sign up" role="button" data-toggle="modal" data-target="#RegisterModal" >sign up</a> </li> ';
          }
          ?> 
          </ul>
            
        </div><!--/.nav-collapse -->
      </div>
    </nav>
      
      
      
      
      
<div class="container modal fade "id="LoginModal" role="dialog">
	<div class="row">
		<form class="form-signin mg-btm" action="/login/process_login.php" method="post">
    	<h3 class="heading-desc"><button type="button" class="close" data-dismiss="modal">&times;</button>Login to PanoRabbit</h3>

    	<div class="main">	  
    	  <input type="text" name="email" class="form-control" placeholder="Email" autofocus>
        <input type="password" name="password" class="form-control" placeholder="Password">
    	
    	  <span class="clearfix"></span>	
      </div>

    	<div class="login-footer">
    	  <div class="row">
          <div class="col-xs-6 col-md-6">
            <div class="left-section">
    					<a href="/register/forgot_password.php">Forgot your password?</a>
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
      

<div class="container modal fade "id="RegisterModal" role="dialog">
	<div class="row">
    <form class="form-signin mg-btm" action="/register/process_register.php" method="post">
    	<h3 class="heading-desc"><button type="button" class="close" data-dismiss="modal">&times;</button>Register to PanoRabbit</h3>
               
  		<div class="main">	
        <input type="text" class="form-control" placeholder="Username" id="username" name="username" autofocus>
  	    <input type="text" class="form-control" placeholder="Email" id="email" name="email" autofocus>
        <input type="password" class="form-control" placeholder="Password" id="password" name="password">
        <input type="password" class="form-control" placeholder="Confirm Password" id="confirmpwd" name="confirmpwd">
        <input type="checkbox" name="agreetoterms" class=" col-lg-1 col-xs-1" id="agreetoterms" name="agreetoterms">

        <p class="col-lg-11 col-xs-11">I have read and agreed to the PanoRabbit <a href="/terms_of_service.html">Terms of Service</a> and <a href="/privacy_policy.html">Privacy Policy.</a></p>
             
  	    <span class="clearfix"></span>	
      </div>
  		<div class="login-footer">
    		<div class="row">
          <div class="col-xs-6 col-md-6">
            <div class="left-section">
    					<a href="/register/forgot_password.php">Forgot your password?</a>
    					<a href="#sign in"  role="button" data-toggle="modal" data-dismiss="modal" data-target="#LoginModal" >Login</a>
    				</div>
          </div>
          <div class="col-xs-6 col-md-6 pull-right">
            <input type="button" class="btn btn-large btn-danger pull-right" value="Register" onclick="return regformhash(this.form,this.form.username,
              this.form.email,this.form.password,this.form.confirmpwd,this.form.agreetoterms);">
          </div>
        </div>
  		</div>
    </form>
	</div>
</div>
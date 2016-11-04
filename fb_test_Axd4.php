<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
 
sec_session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Facebook Login JavaScript Example</title>
<meta charset="UTF-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="/js/sha512.js"></script>
</head>
<body>
<?php if(isset($_SESSION["username"])): ?>
  <p>Hello me</p>
  <a href="/dashboard/logout.php">Log Out</a>
<?php else: ?>
<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '176129779475682',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.7' // use graph api version 2.5
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me?fields=name,email,id', function(response) {
      $.ajax({
        dataType: 'json',
        url: '/login/check_fb_login.php',
        type: 'POST',
        data: {fb_login: response.id},
        success: function(output) {
          loginAjax(output.userobjectfb); 
        },
        error: function() {
         takeToRegister(response.id, response.email);
        }
      });
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + 'uid: ' + response.id + '!';
    });
  }

  function loginAjax(fb) {
    $.ajax({
        url: '/login/process_fb_login.php',
        type: 'POST',
        data: {fb_id: fb},
        success: function(output) {
          if (output==1) {
            //location.reload();
            console.log(output);
          } else {
            alert("A server error has occured!");
          }
        }
    });
  }

  function takeToRegister(fb, email) {
    var fbidform = document.createElement("form");
    fbidform.action = "/register/fb_register.php";
    fbidform.method = "POST";

    var fbidinput = document.createElement("input");
    fbidinput.setAttribute("type", "hidden");
    fbidinput.setAttribute("id", "fbid");
    fbidinput.value = fb;
    fbidinput.name = "fbid";

    var fbemailinput = document.createElement("input");
    fbemailinput.setAttribute("type", "hidden");
    fbemailinput.setAttribute("id", "fbemail");
    fbemailinput.value = email;
    fbemailinput.name = "fbemail";

    fbidform.appendChild(fbidinput);
    fbidform.appendChild(fbemailinput);
    document.body.appendChild(fbidform);
    fbidform.submit();
  }
</script>


<?php endif; ?>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->

<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div>

</body>
</html>
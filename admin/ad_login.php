<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />

    <title>Jon | </title>
 </head>

<body class="nav-md">
<?php

require_once "dbcon.php";
//echo DBSERVER;
//return false;
//$con = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);

$conn = new mysqli(DBSERVER,DBUSR,DBPWD,DBNAME);

?>

<script src="gentelella-master/vendors/jquery/dist/jquery.min.js"></script>
<link href="gentelella-master/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="gentelella-master/vendors/bootstrap/dist/js/bootstrap.min.js"></script>

<style type="text/css">
	#content {
		width : 300px;
		margin : 0px auto;
	}
	#login_section {
		margin-top : 20px;
	}
	.sp_login {
		display : inline-block;
		width : 100px;
	}
</style>

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
    } else {
      // The person is not logged into your app or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
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
    appId      : '848155985339713',
    cookie     : true,  // enable cookies to allow the server to access
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.8' // use graph api version 2.8
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
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
</script>

<script type="text/javascript">
$(document).ready(function(){

	$("#btn_login").click(function(){
		//alert("555");
		var data;
		var username = $("#input_usr").val();
		var password = $("#input_pwd").val();

		if ((username == "") || (password == "")) {
			alert("กรุณาใส่ข้อมูล username และ password ให้ครบ");
			return false;
		}

		data = "u="+username+"&p="+password;

		$.ajax({
			type		:	"POST",
			url		:	"ad_login_verify.php",
			data		:	data,
			success	:	function(html) {
							//alert(html);

							if (html == "1") {
								window.location = "main.php";
								//alert("log in สำเร็จ");
							} else if (html == "0") {
								alert("ไม่พบข้อมูลหรือคุณกรอก password ผิด");
							}
						}
		});
	});

	$("#input_pwd").keypress(function(e) {
		if(e.which == 13) {
			var data;
			var username = $("#input_usr").val();
			var password = $("#input_pwd").val();

			if ((username == "") || (password == "")) {
				alert("กรุณาใส่ข้อมูล username และ password ให้ครบ");
				return false;
			}

			data = "u="+username+"&p="+password;

			$.ajax({
				type		:	"POST",
				url		:	"ad_login_verify.php",
				data		:	data,
				success	:	function(html) {
								//alert(html);

								if (html == "1") {
									window.location = "main.php";
									//alert("log in สำเร็จ");
								} else if (html == "0") {
									alert("ไม่พบข้อมูลหรือคุณกรอก password ผิด");
								}
							}
			});
		}
	});

});
</script>

<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <!-- Page Title Zone -->
      <div class="page-title">
         <div class="title_left">
            <h3></h3>
         </div>

         <!-- <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
               <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                     <button class="btn btn-default" type="button">Go!</button>
                  </span>
               </div>
            </div>
         </div> -->
      </div>

   <div class="clearfix"></div>

   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="x_panel">
            <div class="x_title">
               <h2></h2>

               <div class="clearfix"></div>
            </div>
            <div class="x_content">

					<div style="clear:both">
					</div>
					<div id="content">
					<div class="panel panel-warning">
						<div class="panel-heading" style="text-align:center"><img src="../img/login.png" style="width:30px;" />&nbsp;&nbsp;Log In เข้าใช้งาน Admin</div>
						<?php

						if (isset($_SESSION['valid_admin'])) {
							$valid_admin = $_SESSION['valid_admin'];
						} else {
							$valid_admin = "0";
						}
						//echo $_SESSION['valid_user']."xx";
						if ($valid_admin == "0") {

						?>
						<div id="login_section" >
							<div id="login_info" style="text-align:center;padding:10px 10px 10px 10px;" >
								<input placeholder="Username" type="textbox" id="input_usr" class="form-control" /><br>
								<input placeholder="Password" type="password" id="input_pwd"  class="form-control" /><br>
								<input type="button" value="Login" id="btn_login" class="btn btn-default" />&nbsp;
								<!-- ><input type="checkbox" name="cb_reme" value="re1"> Remember Me -->
								<!-- <a href="forget_login.php" id="link_forget" >[ Forget ]</a> -->
								<div id="login_result">
								<?php
									//echo $_COOKIE["login_verify"];
									/*if (isset($_COOKIE["login_verify"]) and isset($_COOKIE["full_name"])) {
										if (($_COOKIE["login_verify"] != "") and ($_COOKIE["full_name"] != "")) {
											echo "<p>";
											echo "Welcome ".$_COOKIE["full_name"]."<br>";
											echo "</p>";
											//echo "Test by Khunponpun";
										}
									}*/
								?>
								</div>
							</div>
						</div>
						</div>

						<div class="panel panel-warning">
							<div class="panel-heading" style="text-align:center">เข้าสู่ระบบด้วย facebook</div>
								<div style="text-align:center;margin-top:30px;margin-bottom:30px;">
									<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
									</fb:login-button>

									<div id="status">
									</div>
								</div>
						</div>

					</div>
						<?php
						} else {
							?>
								<script type="text/javascript">
									window.location = "admin.php";
								</script>
							<?php
						}// End if
						?>
					<?php
						//mysqli_close($link);
					?>

            </div>
         </div>

      </div>
   </div>

   <!-- Row 2 Example
   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="x_panel">
            <div class="x_title">
               <h2>รายชื่อไฟล์เอกสาร</h2>

               <div class="clearfix"></div>
            </div>
            <div class="x_content">

               ************ Content Here ***********

            </div>
         </div>
      </div>
   </div> -->

   </div>
</div>
<!-- /page content -->

<?php
  $conn->close();
  include "template_bottom.php";
?>

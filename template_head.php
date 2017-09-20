<?php
	ob_start();
	session_start();
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">

  <meta http-equiv="cache-control" content="max-age=0" />
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="expires" content="0" />
  <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
  <meta http-equiv="pragma" content="no-cache" />

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="custom/font-awesome-4.6.3/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/my.css">
  <script src="js/jquery-1.12.4.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="js/my.js"></script>
  <!-- <script src='custom/tinymce/tinymce.min.js'></script> -->

	<style type="text/css">
	@media (min-width: 1200px) {
		.container {
			width: 960px !important;
		}
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
	    } else if (response.status === 'not_authorized') {
	        $("#status").html("คุณไม่ได้รับอนุญาตให้ใช้งานเว็บนี้");
	    } /*else {
	      // The person is not logged into your app or we are unable to tell.
	        document.getElementById('status').innerHTML = 'Please log ' +
	        'into this app.';
	        $("#status").html("");
	    } */
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

	  /*function loginfb() {
	      FB.login(function(response) {
	            if (response.authResponse) {
	             console.log('Welcome!  Fetching your information.... ');
	             FB.api('/me', function(response) {
	               console.log('Good to see you, ' + response.name + '.');
	             });
	            } else {
	             console.log('User cancelled login or did not fully authorize.');
	            }
	      });
	  }

	  function logoutfb() {
	      FB.logout(function(response) {
	          // user is now logged out
	          console.log('Log out!!!');
	        });
	  }*/

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
         var pro_img;
         FB.api( "/me/picture?type=large", function (response) {
               if (response && !response.error) {
                $(".fb_profile_side").html("<img src='"+response.data.url+"' alt='' class='img-circle profile_img' />");
                pro_img = response.data.url;
                //alert(pro_img);
                console.log('Welcome!  Fetching your information.... ');
                FB.api('/me?fields=email,first_name, last_name, picture', function(response) {
                  //console.log('Successful login for: ' + response.name);
                  $(".fb_info_side #fb_name").html(response.first_name+" "+response.last_name);
                  //$(".fb_pro_img_nav").html("<img src='"+pro_img+"' /> "+response.first_name+" "+response.last_name+"&nbsp;<span class=' fa fa-angle-down'></span>");
                });
               }
         });

		$(".fb_bt_zone").hide();
		$(".fb_profile_zone").show();
	  }
	</script>

</head>
<body>

<?php
	include_once("dbcon.php");
	$link = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);
	//mysql_select_db(DB, $conn);
	mysqli_query($link,"SET character_set_results=utf8");
	mysqli_query($link,"SET character_set_client=utf8");
	mysqli_query($link,"SET character_set_connection=utf8");
?>



<div class="container">

	<img id="headimg" src="img/headnew.jpg" />

	<nav class="navbar navbar-inverse" style="margin-bottom:0px !important;">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#"><i class="fa fa-home"></i></a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav">
	        <li class="active"><a href="#">หน้าแรก</a></li>
	        <li><a href="#">เว็บบอร์ด</a></li>
	        <!-- <li><a href="#">Page 2</a></li>
	        <li><a href="#">Page 3</a></li> -->
			<li></li>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	        <!--<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
	        <li></li>
	      </ul>
	    </div>
	  </div>
	</nav>

	<div class="row">
		<div class="col-sm-3 menu-left" style="background-color:#fff;">
			<div class="panel panel-default" id="sidebar">
			<div class="panel-body">
				<div class="search_zone">
					<input type="text" id="search" name="search" placeholder="ใส่คำค้นหา..." style="margin-top:7px;display:inline-block;width:150px"><button type="button" id="btn_search" style="margin-top:7px;margin-left:3px;">ค้นหา</button>
				</div>
			<?php //include "sidebar.php"; ?>
			<!-- <div>
			  <div style="padding: 10px 10px 10px 13px;background-color: #5973a6;color:#fff"><img src="img/search-icon.png" style="width:20px;vertical-align:middle" />&nbsp;Search Product</div>
				<div style="text-align:center;padding:20px 20px 10px 10px">
					<input type="text" class="form-control" id="search" name="search" placeholder="ใส่คำค้นหา..."><br>
					<button type="button" class="btn btn-primary" id="btn_search">ค้นหา</button>
				</div>
			</div>-->
			<div class="sidebar-module">
				<div class="sb-head-login">
				  <div>เข้าสู่ระบบ</div>
				</div>

				<div class="fb_bt_zone">
					<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
					</fb:login-button>
				</div>

				<div class="fb_profile_zone" style="display:none;">
					<div class="profile_pic fb_profile_side">
					</div>
					<div class="profile_info fb_info_side">
					 <span>ยินดีต้อนรับ,</span><b><span id="fb_name"></span></b>
					</div>
					<div style="clear:both"></div>
				</div>
				<div style="clear:both"></div>
			</div>
			<div style="clear:both"></div>
			<div class="sidebar-module">
			  	<div class="sb-head">
				  <div>ประเภทบทความ</div>
				  </div>
				<ul class="list-cate">
					<?php
						$get_sql = "select * from category";
						$result = mysqli_query($link,$get_sql);
						if (mysqli_num_rows($result) > 0) {
							while ($row=mysqli_fetch_array($result)) {
								echo "<li><a href='category.php?cate_id=".$row["cate_id"]."'>".$row["cate_name"]."</a></li>";
							}
						} else {
							echo "<li>ไม่พบประเภทสินค้า</li>";
						}
					?>

				</ul>

			</div>
			<!-- <div>
				<div style="padding: 10px 10px 10px 13px;background-color: #5973a6;color:#fff"><img src="img/ems.png" style="width:20px;vertical-align:middle" />&nbsp;EMS Tracking</div>
				<div style="margin:30px 0px 30px 0px;text-align:center">
					<a href="http://track.thailandpost.co.th/tracking/default.aspx" target="_blank"><img src="img/thaipost.jpg" style="width:150px" /></a>
				</div>
			</div>
			<div>
				<div style="padding: 10px 10px 10px 13px;background-color: #5973a6;color:#fff"><img src="img/pay.png" style="width:20px;vertical-align:middle" />&nbsp;Secure Payment</div>
				<div style="margin:30px 0px 30px 0px;">
					<img src="img/bank.png" style="width:250px" />
				</div>
			</div> -->
			</div>
			</div>
		</div>
		<div class="col-sm-9 right-side" style="background-color:#fff;">
			<!-- <div class="panel panel-default">
				 <div class="panel-body"> -->

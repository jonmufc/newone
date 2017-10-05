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
			width: 1100px !important;
		}
	}
	</style>


	<script type="text/javascript">
		$(document).ready(function(){

			$("#btn_login").click(function(){

				var input_usr = $("#input_usr").val();
				var input_pwd = $("#input_pwd").val();
				if (input_usr=="") {
					alert("โปรดใส่เลขประจำตัว");
					return false;
				}
				if (input_pwd=="") {
					alert("โปรดใส่พาสเวิร์ด");
					return false;
				}

				var data = "input_usr="+input_usr+"&input_pwd="+input_pwd;

				$.ajax({
					 type		:	"POST",
					 url		:	"login_verify.php",
					 data		:	data,
					 success	:	function(html) {

										  //alert(html);

										  //$("#login_result").html(html);
										  //window.location = "index.php";
										  if (html == "1") {
											  	alert("log in สำเร็จ");
												window.location = "index.php";
										  } else if (html == "0") {
												alert("ไม่พบข้อมูลหรือคุณกรอก password ผิด");
										  }

									 }
				});
			});

		});
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
	      <a class="navbar-brand" href="index.php"><i class="fa fa-home"></i></a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav">
	        <li class="active"><a href="index.php">หน้าแรก</a></li>
	        <li><a href="wb_board.php">เว็บบอร์ด</a></li>
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

				<?php

				if (!isset($_SESSION["valid_user"])) {
				 ?>
				<div id="login_info" style="text-align:center;padding:10px 10px 10px 10px;" >
					<input placeholder="Username" type="textbox" id="input_usr" class="form-control" /><br>
					<input placeholder="Password" type="password" id="input_pwd"  class="form-control" /><br>
					<input type="button" value="Login" id="btn_login" class="btn btn-default" />&nbsp;<br><br>
					<!-- ><input type="checkbox" name="cb_reme" value="re1"> Remember Me -->
					<!-- <a href="forget_login.php" id="link_forget" >[ Forget ]</a> -->
					<span>หรือ login ด้วย <a href="fblogin.php" style="text-decoration:underline;">Facebook</a></span>
				</div>
				<?php
				} else {
				 ?>
				<div id="login_result">
					<div class="profile_pic">
						<?php
							if (isset($_SESSION["fb"])) {
								//echo $_SESSION['user_pic'];
								?>

								<img src='<?php echo $_SESSION['user_pic']; ?>' alt='' class='img-circle profile_img' />
								<?php
							} else {
								?>
								<img src='admin/userprofile/<?php echo $_SESSION['user_pic']; ?>' alt='' class='img-circle profile_img' />
								<?php
							}
						?>
					</div>
					<span>ยินดีต้อนรับ,</span><b><span id="login_name"><?php echo $_SESSION['user_fullname']; ?></span></b>
					<div>
						<a href="logout.php">Log Out</a>
					</div>

				</div>
				<?php
				}
				?>

				<!--<div class="fb_bt_zone">
					<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
					</fb:login-button>
				</div>

				<div class="fb_profile_zone" style="display:none;">
					<div class="profile_pic fb_profile_side">
					</div>
					<div class="profile_info fb_info_side">
					 <span>ยินดีต้อนรับ,</span><b><span id="fb_name"></span></b>
					 <a href="#" onclick="fblogout();" style="cursor:pointer;text-decoration:underline;">Log out FB</div>
					</div>
					<div style="clear:both"></div>
				</div>
				<div style="clear:both"></div> -->
			</div>
			<div style="clear:both"></div>
			<div class="sidebar-module">
			  	<div class="sb-head">
				  <div>ประเภทบทความ</div>
				  </div>
				<ul class="list-cate">
					<?php
						/*$get_sql = "select * from category";
						$result = mysqli_query($link,$get_sql);
						if (mysqli_num_rows($result) > 0) {
							while ($row=mysqli_fetch_array($result)) {
								echo "<li><a href='category.php?cate_id=".$row["cate_id"]."'>".$row["cate_name"]."</a></li>";
							}
						} else {
							echo "<li>ไม่พบประเภทบทความ</li>";
						}*/
						$get_sql = "select * from tbl_posts a inner join category b on a.post_cate_id=b.cate_id where a.post_status = 1 order by post_id asc limit 6";
						$result = mysqli_query($link,$get_sql);
						if (mysqli_num_rows($result) > 0) {
							while ($row=mysqli_fetch_array($result)) {
								echo "<li><a href='post.php?p=".$row["post_id"]."'>".$row["cate_name"]."</a></li>";
							}
						} else {
							echo "<li>ไม่พบประเภทบทความ</li>";
						}
					?>

				</ul>

			</div>
			<div class="sidebar-module">
			  	<div class="sb-head-site">
				  <div>This Site</div>
				  </div>
				<ul class="list-cate">
					<li><a href='wb_board.php'>เว็บบอร์ด</a></li>
					<li><a href='file_download.php'>ดาวน์โหลดเอกสาร</a></li>
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

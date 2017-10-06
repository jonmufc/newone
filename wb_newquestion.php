<?php
	include("template_head.php");

	//print_r($_SESSION);

?>

<style style="text/css">
	.row {
		margin-top : 10px;
	}
</style>

<?php

if (isset($_GET["Action"])) {
	$action = $_GET["Action"];
} else {
	$action = "";
}

if($action == "Save")
{
	date_default_timezone_set('Asia/Bangkok');
	$record_date = date("Y-m-d H:i:s");
	//*** Insert Question ***//
	$strSQL = "INSERT INTO webboard ";
	$strSQL .="(CreateDate,Question,Details,Name,empn) ";
	$strSQL .="VALUES ";
	$strSQL .="('".$record_date."','".$_POST["txtQuestion"]."','".$_POST["txtDetails"]."','".$_POST["txtName"]."','".$_SESSION["empn"]."') ";
	$objQuery = mysqli_query($link,$strSQL);

	header("location:wb_board.php");
}
?>

<style type="text/css">
	#dv_webboard a {
		color : #507D96;
	}

</style>

<div class="panel panel-default">
	<div class="panel-body">

		<div id="main_content">
			<div id="dv_wb_new_question">
				<h3>เว็บบอร์ด</h3>
				<div class="post_comment col-md-12 col-sm-12 col-xs-12" >

				<p><b>ตั้งกระทู้ใหม่</b></p>
				<form action="wb_newquestion.php?Action=Save" method="post" name="frmMain" id="frmMain">
					<div class="row">
	  					 <div class="col-md-3 col-sm-3 col-xs-3" style="text-align:right" >
						  <span>หัวข้อกระทู้</span>
					  	</div>
						<div class="col-md-9 col-sm-9 col-xs-9" >
							<input name="txtQuestion" type="text" id="txtQuestion" value="" size="70" class="form-control" />
						</div>
					</div>
					<div class="row">
	  					 <div class="col-md-3 col-sm-3 col-xs-3" style="text-align:right" >
						  <span>รายละเอียด</span>
					  	</div>
						<div class="col-md-9 col-sm-9 col-xs-9" >
							<textarea name="txtDetails" cols="70" rows="5" id="txtDetails" class="form-control" ></textarea>
						</div>
					</div>
					<div class="row">
	  					 <div class="col-md-3 col-sm-3 col-xs-3" style="text-align:right" >
						  <span>ชื่อ</span>
					  	</div>
						<div class="col-md-9 col-sm-9 col-xs-9" >
							<input name="txtName" type="text" id="txtName" class="form-control" size="50" value='<?php echo $_SESSION["user_fullname"];?>' readonly />
						</div>
					</div>
					<div class="row">
	  					 <div class="col-md-3 col-sm-3 col-xs-3" style="text-align:right" >
						  <span></span>
					  	</div>
						<div class="col-md-9 col-sm-9 col-xs-9" >
							<!-- <input name="btnSave" type="submit" id="btnSave" value="ตั้งกระทู้" class="form-control btn btn-primary"  /> -->
							<button type="submit" name="btnSave" id="btnSave" class="btn btn-primary">ตั้งกระทู้</button><br><br>
							<a href="wb_board.php">ย้อนกลับไปหน้าเว็บบอร์ด</a>
						</div>
					</div>

				</form>
				</div>
			</div>
		</div>
	</div>
</div> <!-- End Panel -->
<?php

include_once("template_bot.php");

?>

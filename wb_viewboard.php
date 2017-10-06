<?php
	include("template_head.php");

?>
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
	//*** Insert Reply ***//
	$strSQL = "INSERT INTO reply ";
	$strSQL .="(QuestionID,CreateDate,Details,Name,empn) ";
	$strSQL .="VALUES ";
	$strSQL .="('".$_GET["QuestionID"]."','".$record_date."','".$_POST["txtDetails"]."','".$_POST["txtName"]."','".$_SESSION["empn"]."') ";
	$objQuery = mysqli_query($link,$strSQL);

	//*** Update Reply ***//
	$strSQL = "UPDATE webboard ";
	$strSQL .="SET Reply = Reply + 1 WHERE QuestionID = '".$_GET["QuestionID"]."' ";
	$objQuery = mysqli_query($link,$strSQL);
}
?>

<?php
//*** Select Question ***//
$strSQL = "SELECT w.*,e.user_pic FROM webboard w INNER JOIN tbl_users e ON w.empn = e.empn WHERE QuestionID = '".$_GET["QuestionID"]."'";

$objQuery = mysqli_query($link,$strSQL);
$objResult = mysqli_fetch_array($objQuery);

//*** Update View ***//
$strSQL = "UPDATE webboard ";
$strSQL .="SET View = View + 1 WHERE QuestionID = '".$_GET["QuestionID"]."' ";
$objQuery = mysqli_query($link,$strSQL);
?>

<style type="text/css">
	#dv_webboard a {
		color : #507D96;
	}
	#tb_topic {
		background-color : rgba(52, 85, 88, 0.07);
		border-radius: 12px;
	}

	.tb_reply {
		background-color : #E9FAE2;
		border-radius: 12px;
	}
	#tb_topic td, #tb_topic th {
		/*border-bottom-style : solid;
		border-bottom-width : 1px;
		border-bottom-color : #A8A8A8;*/

	}
	.txt_color1 {
		color : #254554;
	}
	.txt_color2 {
		color : #1C319B;
	}
	.row {
		margin-top : 10px;
	}
</style>

<div class="panel panel-default">
	<div class="panel-body">

		<div id="main_content">
			<div id="dv_webboard" class="col-md-12 col-sm-12 col-xs-12">
				<h3>เว็บบอร์ด</h3>
				<table width="100%" border="0" cellpadding="15px" cellspacing="1px" id="tb_topic">
				  <tr>
					<td colspan="2"><center><h1><?php echo $objResult["Question"];?></h1></center></td>
				  </tr>
				  <tr>
					<td height="53" colspan="2"><?php echo nl2br($objResult["Details"]);?></td>
				  </tr>
				  <tr>
					<td width="397"><label class='txt_color1'>ชื่อ : </label>
						<img src="admin/userprofile/<?php echo $objResult["user_pic"]; ?>" alt="" style="vertical-align:middle" class="img-circle profile_img2" />
						<label class='txt_color2'><?php echo $objResult["Name"];?></label> <label class='txt_color1'>วันที่ตั้งกระทู้ : </label><label class='txt_color2'><?php echo $objResult["CreateDate"];?></label></td>
					<td width="253"><label class='txt_color1'>จำนวนผู้ชม : </label><label class='txt_color1'><?php echo $objResult["View"];?></label> <label class='txt_color2'>คนตอบกระทู้ : </label><label class='txt_color1'><?php echo $objResult["Reply"];?></label></td>
				  </tr>
				</table>
				<br>
				<br>
				<?php
				$intRows = 0;
				$strSQL2 = "SELECT r.*,e.user_pic FROM reply r INNER JOIN tbl_users e ON r.empn = e.empn WHERE QuestionID = '".$_GET["QuestionID"]."'";

				$objQuery2 = mysqli_query($link,$strSQL2);
				while($objResult2 = mysqli_fetch_array($objQuery2))
				{
					$intRows++;
				?> <b>ความคิดเห็น : <?php echo $intRows;?></b><br>
				<table width="100%" border="0" cellpadding="15px" cellspacing="1px" class="tb_reply" >
				  <tr>
					<td height="53" colspan="2"><?php echo nl2br($objResult2["Details"]);?></td>
				  </tr>
				  <tr>
					<td width="397"><label class='txt_color1'>ชื่อ :</label>
						<img src="admin/userprofile/<?php echo $objResult["user_pic"]; ?>" alt="" style="vertical-align:middle" class="img-circle profile_img2" />
						<label class='txt_color2'><?php echo $objResult2["Name"];?></label>
					</td>
					<td width="253"><label class='txt_color1'>วันที่ตอบกระทู้ :</label>
						<label class='txt_color2'><?php echo $objResult2["CreateDate"];?></label>
					</td>
				  </tr>
				</table><br>
				<?php
				}
				?>
				<br>
				<a href="wb_board.php">ย้อนกลับไปหน้าเว็บบอร์ด</a> <br>
				<?php
				if (isset($_SESSION['valid_user'])) {
					$valid_user = "1";
				} else {
					$valid_user = "0";
				}
				if ($valid_user != "0") {
				?><br>
				<h4><b>ตอบกระทู้</b></h4>

				<form action="wb_viewboard.php?QuestionID=<?php echo $_GET["QuestionID"];?>&Action=Save" method="post" name="frmMain" id="frmMain">
					<div class="row">
	  					 <div class="col-md-3 col-sm-3 col-xs-3" style="text-align:right" >
						  <span>รายละเอียด</span>
					  	</div>
						<div class="col-md-9 col-sm-9 col-xs-9" >
							<textarea name="txtDetails" cols="50" rows="5" id="txtDetails" class="form-control"></textarea>
						</div>
					</div>
					<div class="row">
  					  <div class="col-md-3 col-sm-3 col-xs-3" style="text-align:right" >
  						<span>ชื่อ</span>
  					 </div>
  					 <div class="col-md-9 col-sm-9 col-xs-9" >
  						 <input name="txtName" type="text" id="txtName" value="<?php echo $_SESSION["user_fullname"]; ?>" size="50" class="form-control" readonly />
  					 </div>
  				 	</div>
					<div class="row">
  					  <div class="col-md-3 col-sm-3 col-xs-3" style="text-align:right" >
  						<span></span>
  					 </div>
  					 <div class="col-md-9 col-sm-9 col-xs-9" >
  							<input name="btnSave" class="btn btn-primary" type="submit" id="btnSave" value="ตอบกระทู้">
  					 </div>
  				 	</div>

				</form>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</div> <!-- End Panel -->

<?php

include_once("template_bot.php");

?>

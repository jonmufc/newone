<?php
	include("template_head.php");

	//print_r($_SESSION);
	
?>

<?php

if (isset($_GET["Action"])) {
	$action = $_GET["Action"];
} else {
	$action = "";
}

if($action == "Save")
{
	//*** Insert Question ***//
	$strSQL = "INSERT INTO webboard ";
	$strSQL .="(CreateDate,Question,Details,Name) ";
	$strSQL .="VALUES ";
	$strSQL .="('".date("Y-m-d H:i:s")."','".$_POST["txtQuestion"]."','".$_POST["txtDetails"]."','".$_POST["txtName"]."') ";
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
				<p><b>ตั้งกระทู้ใหม่</b></p>
				<form action="wb_newquestion.php?Action=Save" method="post" name="frmMain" id="frmMain">
				  <table width="100%" border="0" cellspacing="0px" cellpadding="5px" id="tbl_board_nq" >
					<tr>
					  <td>หัวข้อกระทู้</td>
					  <td><input name="txtQuestion" type="text" id="txtQuestion" value="" size="70"></td>
					</tr>
					<tr>
					  <td width="78">รายละเอียด</td>
					  <td><textarea name="txtDetails" cols="70" rows="5" id="txtDetails"></textarea></td>
					</tr>
					<tr>
					  <td width="78">ชื่อ</td>

					  <?php
						if (isset($_SESSION['username'])) {
							$user_name = $_SESSION['username'];
							?>
							<td width="647"><input name="txtName" type="text" id="txtName" size="50" value='<?php echo $user_name;?>' readonly></td>
					  <?php
						} else {
					  ?>
						<td width="647"><input name="txtName" type="text" id="txtName" value="" size="50"></td>
					  <?php
						}
					  ?>
					</tr>
				  </table>

				  <input name="btnSave" type="submit" id="btnSave" value="ตั้งกระทู้"><br><br>
				  <a href="wb_board.php">ย้อนกลับไปหน้าเว็บบอร์ด</a> <br>
				</form>
			</div>
		</div>
	</div>
</div> <!-- End Panel -->
<?php

include_once("template_bot.php");

?>

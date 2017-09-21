<?php
	include("template_head.php");

	//print_r($_SESSION);
?>

<style type="text/css">
	#dv_webboard a {
		color : #507D96;
	}
	#tbl_webboard td, #tbl_webboard th {
		border-bottom-style : solid;
		border-bottom-width : 1px;
		border-bottom-color : #A8A8A8;
	}
</style>

<script type="text/javascript">
	function popupwindow(url, title, w, h) {
		var left = (screen.width/2)-(w/2);
		var top = (screen.height/2)-(h/2);
		return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
	}
</script>

<div class="panel panel-default">
	<div class="panel-body">

		<div id="main_content">
			<div id="dv_webboard">
				<h3>เว็บบอร์ดแลกเปลี่ยนเรียนรู้</h3>
				<?php
				if (isset($_SESSION['valid_user'])) {
					$valid_user = "1";
				} else {
					$valid_user = "0";
				}
				if ($valid_user != "0") {
				?>
					<p><a href="wb_newquestion.php">ตั้งกระทู้ใหม่</a></p>
				<?php
				}

				$strSQL = "SELECT * FROM webboard ";
				$objQuery = mysqli_query($link,$strSQL);
				$Num_Rows = mysqli_num_rows($objQuery);

				$Per_Page = 10;   // Per Page

				if (isset($_GET["Page"])) {
					$Page =$_GET["Page"];
				} else {
					$Page=1;
				}

				$Prev_Page = $Page-1;
				$Next_Page = $Page+1;

				$Page_Start = (($Per_Page*$Page)-$Per_Page);
				if($Num_Rows<=$Per_Page)
				{
					$Num_Pages =1;
				}
				else if(($Num_Rows % $Per_Page)==0)
				{
					$Num_Pages =($Num_Rows/$Per_Page) ;
				}
				else
				{
					$Num_Pages =($Num_Rows/$Per_Page)+1;
					$Num_Pages = (int)$Num_Pages;
				}

				$strSQL .=" order  by QuestionID DESC LIMIT $Page_Start , $Per_Page";
				$objQuery2  = mysqli_query($link,$strSQL);
				//echo $objQuery;
				//echo $strSQL;
				?>
				<table width="100%" border="0" cellspacing="0px" cellpadding="5px" id="tbl_webboard">
				  <tr>
					<th width="99"> <div align="center">ลำดับที่</div></th>
					<th width="458"> <div align="center">คำถาม</div></th>
					<th width="90"> <div align="center">ผู้ถาม</div></th>
					<th width="130"> <div align="center">วันที่</div></th>
					<th width="35"> <div align="center">View</div></th>
					<th width="37"> <div align="center">Reply</div></th>
					<?php
						if (isset($_SESSION['valid_user'])) {
							$valid_user = "1";
						} else {
							$valid_user = "0";
						}

						if ($valid_user == "1") {
							?>
							<th width="20"> <div align="center">Del</div></th>
							<?php
						}
					?>
				  </tr>
					<?php
				while($objResult = mysqli_fetch_array($objQuery2))
				{
					//print_r($objResult);
				?>
				  <tr>
					<td><div align="center"><?php echo $objResult["QuestionID"];?></div></td>
					<td><a href="wb_viewboard.php?QuestionID=<?php echo $objResult["QuestionID"];?>"><?php echo $objResult["Question"];?></a></td>
					<td><?php echo $objResult["Name"];?></td>
					<td><div align="center"><?php echo $objResult["CreateDate"];?></div></td>
					<td align="right"><?php echo $objResult["View"];?></td>
					<td align="right"><?php echo $objResult["Reply"];?></td>
					<?php
						if (isset($_SESSION['valid_admin'])) {
							$valid_admin = "1";
						} else {
							$valid_admin = "0";
						}
						if ($valid_admin == "1") {
							?>
							<td style='text-align:right'>
							<!-- <a href="#" onclick="javascript:void window.open('DelWebboard.php?type=2&qid=<?php //echo $objResult["QuestionID"]; ?>','1389241772131','width=300,height=100,location=no,toolbar=0,menubar=0,location=0,status=0,scrollbars=0,resizable=0,left=0,top=0');return false;">Pop-up Window</a><a href="DelWebboard.php?qid=<?php //echo $objResult["QuestionID"]; ?>"><img src="img/cancel.png" style="width:15px" /></a></td> -->
							<a href="#" onclick="javascript:void popupwindow('wb_delwebboard.php?type=2&qid=<?php echo $objResult["QuestionID"]; ?>','ลบข้อมูล','300','100'); return false;"><img src="img/cancel.png" style="width:15px" /></a></td>
							<?php
						}
					?>
				  </tr>
				<?php
				}
				?>
				</table>

				<br>
				Total <?php echo $Num_Rows;?> Record : <?php echo $Num_Pages;?> Page :
				<?php
				if($Prev_Page)
				{
					echo " <a href='{$_SERVER['SCRIPT_NAME']}?Page={$Prev_Page}'><< Back</a> ";
				}

				for($i=1; $i<=$Num_Pages; $i++){
					if($i != $Page)
					{
						echo "[ <a href='{$_SERVER['SCRIPT_NAME']}?Page={$i}'>$i</a> ]";
					}
					else
					{
						echo "<b> $i </b>";
					}
				}
				if($Page!=$Num_Pages)
				{
					echo " <a href ='{$_SERVER['SCRIPT_NAME']}?Page={$Next_Page}'>Next>></a> ";
				}

				?>
			</div>
		</div>
	</div>
</div> <!-- End Panel -->

<?php

include_once("template_bot.php");

?>

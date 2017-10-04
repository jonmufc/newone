<?php
	include "template_head.php";

	//$get_sql = "select * from admin";
	//$result = mysqli_query($link,$get_sql);
	//$result = mysqli_query($link,$get_sql);
	//$conn = new mysqli(DBSERVER,DBUSR,DBPWD,DBNAME);

	$link = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);
	//mysql_select_db(DB, $conn);
	mysqli_query($link,"SET character_set_results=utf8");
	mysqli_query($link,"SET character_set_client=utf8");
	mysqli_query($link,"SET character_set_connection=utf8");

	function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}
?>

<style type="text/css">

.dv_post_name {
	font-size : 1.3em;
	font-weight: bold;
}

.download-panel {
	margin : 8px;
	padding : 10px;
	border-style: solid;
   border-width: 1px;
   border-color: #d4d4d4;
	border-radius: 8px;
}

.dw_bt {
	text-align : right;
}

</style>

<script type="text/javascript">

$(document).ready(function(){


});

</script>
	<!-- <div style="margin : 0px 0px 10px 10px;width:100%">
		<img src="img/hot-item.png" id="hot-item" style="width : 130px;text-align:right" />
	</div> -->

	<div class="panel panel-default">
		<div class="panel-body">
			<h2>รายชื่อไฟล์เอกสาร</h2>

	<?php

	$perpage = 10;
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	}
	$start = ($page - 1) * $perpage;

	$sql = "select * from tbl_file_doc order by fd_id desc limit {$start} , {$perpage}";
	//echo $sql;
   //$stmt = $conn->prepare($sql);
   $res_sql = mysqli_query($link,$sql);

   if (mysqli_num_rows($res_sql) > 0) {
   	while ($row=mysqli_fetch_array($res_sql)) {
	?>
	<div class="row">
	  <div class="col-md-12 col-sm-12 col-xs-12">
		  <div class="download-panel">
		 <?php

				?>
				<span>File ID : </span><?php echo $row["fd_id"] ?>&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $row["full_name"]; ?></b><br>
				<img src="img/folder.png" style="width:15px;" />&nbsp;&nbsp;<?php echo $row["file_name"]; ?>
				<div class="dw_bt">
					<a href="admin/files/<?php echo $row["folder_name"]; ?>/<?php echo $row["file_name"]; ?>" /><button class="btn btn-success" type="button">Download</button></a>
				</div>
				<?php
			 /*echo $row["fd_id"];
			 echo "<td>".$row["file_name"]."</td>";
			 echo "<td>".$row["full_name"]."</td>";
			 echo "<td><a href='files/".$row["folder_name"]."/".$row["file_name"]."' target='_blank' ><img src='images/search.png' /></a></td>";
			 echo "<td><a href='admin_edit_file.php?fd_id=".$row["fd_id"]."' ><img src='images/edit.png' /></a></td>";
			 echo "</tr>";*/

		?>
			</div>
	  </div>
	</div>
	<?php
		}
	} else {
		echo "ไม่พบเอกสาร";
	}
	?>
<?php
	$sql2 = "select * from tbl_file_doc ";
	$query2 = mysqli_query($link, $sql2);
	$total_record = mysqli_num_rows($query2);
	$total_page = ceil($total_record / $perpage);

?>
	<div style="clear:both">
	</div>
	<nav>
		<ul class="pagination">
			<li>
				<?php
					if (isset($_GET['key'])) {
						echo "<a href='file_download.php?page=1&key=".$search."' aria-label='Previous'>";
					} else {
						echo "<a href='file_download.php?page=1' aria-label='Previous'>";
					}
				?>

				<span aria-hidden="true">&laquo;</span>
				</a>
			</li>
			<?php for($i=1;$i<=$total_page;$i++){ ?>
			<li>
			<?php
					if (isset($_GET['key'])) {
						echo "<a href='file_download.php?page={$i}&key={$search}'>{$i}</a></li>";
					} else {
						echo "<a href='file_download.php?page={$i}'>{$i}</a></li>";
					}
				?>
			<?php } ?>
			<li>
			<?php
					if (isset($_GET['key'])) {
						echo "<a href='file_download.php?page={$total_page}&key={$search}' aria-label='Next'>";
					} else {
						echo "<a href='file_download.php?page={$total_page}' aria-label='Next'>";
					}
				?>

				<span aria-hidden="true">&raquo;</span>
				</a>
			</li>
		</ul>
	</nav>

		</div>
	</div>




<?php include "template_bot.php"; ?>

<?php
	include "template_head.php";

	//$get_sql = "select * from admin";
	//$result = mysqli_query($link,$get_sql);
	//$result = mysqli_query($link,$get_sql);
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

	<?php
	if (isset($_GET['key'])) {
		$search = $_GET['key'];
		echo "<h3>ผลการค้นหาบทความ</h3>";
	} else {
		echo "<h3 style='margin-left:15px;margin-bottom:20px;'>องค์ความรู้เหมืองแม่เมาะ</h3>";
	}

	$perpage = 6;
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	}
	$start = ($page - 1) * $perpage;

	if (isset($_GET['key'])) {
		$get_sql = "select * from tbl_posts where post_status = 1 and post_name like '%{$search}%' order by post_id desc limit {$start} , {$perpage} ";
	} else {
		$get_sql = "select * from tbl_posts where post_status = 1 order by post_id desc limit {$start} , {$perpage} ";
	}

	//echo $get_sql;

	$result = mysqli_query($link,$get_sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row=mysqli_fetch_array($result)) {

			/*$get_img = "select * from product_image where img_group_id=".$row["img_group_id"]." limit 1";
			//echo $get_img;
			$res_img = mysqli_query($link,$get_img);
			if (mysqli_num_rows($res_img)>0) {
				while ($row_img=mysqli_fetch_array($res_img)) {
					//echo $row_img["img_name"];
					$img_name = explode(".",$row_img["img_name"]);
					//echo $img_name[1];
					$pro_img = $row_img["img_id"].".".$img_name[1];
				}
			}*/
			$thum_img = "";
			//echo $pro_img;
			?>


			   <div class="col-sm-6 col-md-4">
				<div class="post_card">
					<a href="post.php?p=<?php echo $row["post_id"]; ?>">
						<img src="img/download.png" style="width:100%" />
					</a>
					<div class="caption" style="margin-top:7px;">
						<div class="dv_post_name">
							<a href="post.php?p=<?php echo $row["post_id"]; ?>"><?php echo $row["post_name"] ?></a>
				   	</div>
						<div class="dv_post_date">
							<?php echo DateThai($row["post_date"]); ?>
				   	</div>
						<div class="dv_post_desc_short">
							<?php echo iconv_substr(strip_tags(htmlspecialchars_decode($row["post_desc"])),0,200, "UTF-8"); ?>...
							 <p><a href="post.php?p=<?php echo $row["post_id"]; ?>"><button class="btn btn-default" type="button">Read More..</button></a></p>
						</div>
					</div>
				</div>
			</div>

			<?php
		}
	} else {
		echo "<li>ไม่พบบทความ</li>";
	}

	$sql2 = "select * from tbl_posts where post_status = 1 ";
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
						echo "<a href='index-blog.php?page=1&key=".$search."' aria-label='Previous'>";
					} else {
						echo "<a href='index-blog.php?page=1' aria-label='Previous'>";
					}
				?>

				<span aria-hidden="true">&laquo;</span>
				</a>
			</li>
			<?php for($i=1;$i<=$total_page;$i++){ ?>
			<li>
			<?php
					if (isset($_GET['key'])) {
						echo "<a href='index-blog.php?page={$i}&key={$search}'>{$i}</a></li>";
					} else {
						echo "<a href='index-blog.php?page={$i}'>{$i}</a></li>";
					}
				?>
			<?php } ?>
			<li>
			<?php
					if (isset($_GET['key'])) {
						echo "<a href='index-blog.php?page={$total_page}&key={$search}' aria-label='Next'>";
					} else {
						echo "<a href='index-blog.php?page={$total_page}' aria-label='Next'>";
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

<?php 
	include "template_admin_head.php"; 

	//ob_start();
	include_once("dbconfig.php");
	//session_start();
	//require_once('custom/PHPMailer/class.phpmailer.php');

	// Check Login Person;
	if (isset($_SESSION['valid_admin'])) {
		if ($_SESSION['valid_admin'] != "1") {
			header('Location: ad_login.php');
		}
	} else {
		header('Location: ad_login.php');
	}
	
	// DB section
	//$conn = mysql_connect(SERVER, USR, PWD);
	$link = mysqli_connect(SERVER, USR, PWD, DB);
	//mysql_select_db(DB, $conn);
	mysqli_query($link,"SET character_set_results=utf8");
	mysqli_query($link,"SET character_set_client=utf8");
	mysqli_query($link,"SET character_set_connection=utf8");

	$perpage = 10;
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	}
	$start = ($page - 1) * $perpage;
	
	$get_sql = "select * from category limit {$start} , {$perpage}";
	$result = mysqli_query($link,$get_sql);
	
?>

<script type="text/javascript">

$(document).ready(function(){
	$(".btn-danger").click(function(){
		var id=$(this).parent().next("td").text();
		var data = "hid_cate_id="+id;
		//alert(data);
		data = data + "&type=del";
		$.ajax({
				type		:	"POST",
				url			:	"category_pro.php",
				data		:	data,
				success		:	function(html) {
						
								//alert(html);
								//$("#result_add_member").html(html);
								
								var arr_html = html.split("|");
								if (arr_html[0] != "0") {
									alert(arr_html[1]);
									window.location = "category.php";
								} else {
									alert(arr_html[1]);
								} 
								
							}
			});
	});
});

</script>

<p style="margin-bottom : 25px;">
	<img src="../img/Bookmark-add.png" style="width:40px;" />&nbsp;&nbsp;<b style="font-size:1.2em;">รายการประเภทสินค้า</b>
	&nbsp;<a href="categoryins.php"><button type="button" class="btn btn-default">เพิ่มข้อมูลประเภทสินค้า</button></a>
</p>
<table class="table table-striped">
    <thead>
      <tr>
        <th width="20%">Category Ref Code</th>
        <th width="40%">Category Name</th>
		<th width="20%">Category Status</th>
		<th width="10%"></th>
		<th width="10%"></th>
      </tr>
    </thead>
    <tbody>
      <?php
	  
		if (mysqli_num_rows($result) != 0) {
			while ($row=mysqli_fetch_array($result)) {
				echo "<tr>";
				echo "<td>".$row["cate_ref_code"]."</td>";
				echo "<td>".$row["cate_name"]."</td>";
				if ($row["cate_status"] == "1") {
					$status_txt = "ใช้";
				} else {
					$status_txt = "ไม่ใช้";
				}
				echo "<td>".$status_txt."</td>";
				echo "<td><a href='categoryupd.php?id=".$row["cate_id"]."'><button type='button' class='btn btn-primary'>Edit</button></a></td>";
				echo "<td><button type='button' class='btn btn-danger'>Del</button></td>";
				echo "<td style='display:none'>".$row["cate_id"]."</td>";
				echo "</tr>";  
			}
		} else {
			echo "<tr>";
			echo "<td colspan=4>ไม่พบข้อมูลในระบบ</td>";
			echo "</tr>";
		}
	  
	  ?>
    </tbody>
  </table>
<?php
	$sql2 = "select * from category ";
	$query2 = mysqli_query($link, $sql2);
	$total_record = mysqli_num_rows($query2);
	$total_page = ceil($total_record / $perpage);
	if ($total_page == "0") {
		$total_page = "1";
	}
?>
	<div style="clear:both">
	</div>
	<nav>
		<ul class="pagination">
			<li>
				<a href="category.php?page=1" aria-label="Previous">
				<span aria-hidden="true">&laquo;</span>
				</a>
			</li>
			<?php for($i=1;$i<=$total_page;$i++){ ?>
			<li><a href="category.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php } ?>
			<li>
				<a href="category.php?page=<?php echo $total_page;?>" aria-label="Next">
				<span aria-hidden="true">&raquo;</span>
				</a>
			</li>
		</ul>
	</nav>
<?php mysqli_close($link); ?>
<?php include "template_admin_bot.php"; ?>
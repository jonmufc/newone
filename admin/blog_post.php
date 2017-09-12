<?php
include "template_head.php";

require_once "dbcon.php";
//echo DBSERVER;
//return false;
//$con = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);

//$conn = new mysqli(DBSERVER,DBUSR,DBPWD,DBNAME);

// Check Login Person;
/*if (isset($_SESSION['valid_admin'])) {
	if ($_SESSION['valid_admin'] != "1") {
		header('Location: ad_login.php');
	}
} else {
	header('Location: ad_login.php');
}*/

// DB section
//$conn = mysql_connect(SERVER, USR, PWD);
$link = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);
//mysql_select_db(DB, $conn);
mysqli_query($link,"SET character_set_results=utf8");
mysqli_query($link,"SET character_set_client=utf8");
mysqli_query($link,"SET character_set_connection=utf8");

/*if (isset($_GET['key'])) {
	$search = $_GET['key'];
	//echo "<h4>ผลการค้นหาสินค้า</h4>";
} else {
	$search ="";
}
if (isset($_GET['cate'])) {
	$cate_id = $_GET['cate'];
	//echo "<h4>ผลการค้นหาสินค้า</h4>";
} else {
	$cate_id ="";
}
if (isset($_GET['bp'])) {
	$bp = $_GET['bp'];
} else {
	$bp ="";
}
if (isset($_GET['ep'])) {
	$ep = $_GET['ep'];
	//echo "<h4>ผลการค้นหาสินค้า</h4>";
} else {
	$ep ="";
}*/

/*if (isset($_GET['mode'])) {
	$mode = $_GET["mode"];
	echo "<h4>ผลการค้นหาสินค้า</h4>";
} else {
	$mode = "0";
}*/

$perpage = 10;
if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}
$start = ($page - 1) * $perpage;


/*if ($mode == "1") {
	$get_sql = "select p.*,s.company_name from product p inner join supplier s on p.sup_id=s.sup_id where p.pro_name like '%{$search}%' limit {$start} , {$perpage}";
	//echo $get_sql;
} else if ($mode == "2") {
	$get_sql = "select p.*,s.company_name from product p inner join supplier s on p.sup_id=s.sup_id where p.cate_id={$cate_id} limit {$start} , {$perpage}";
} else if ($mode == "3") {
	$get_sql = "select p.*,s.company_name from product p inner join supplier s on p.sup_id=s.sup_id where p.pro_name like '%{$search}%' and p.cate_id={$cate_id} limit {$start} , {$perpage}";
} else if ($mode == "4") {
	$get_sql = "select p.*,s.company_name from product p inner join supplier s on p.sup_id=s.sup_id where p.pro_price between {$bp} and {$ep} limit {$start} , {$perpage}";
} else if ($mode == "5") {
	$get_sql = "select p.*,s.company_name from product p inner join supplier s on p.sup_id=s.sup_id where p.pro_name like '%{$search}%' and p.pro_price between {$bp} and {$ep} limit {$start} , {$perpage}";
} else if ($mode == "6") {
	$get_sql = "select p.*,s.company_name from product p inner join supplier s on p.sup_id=s.sup_id where p.cate_id={$cate_id} and p.pro_price between {$bp} and {$ep} limit {$start} , {$perpage}";
} else if ($mode == "7") {
	$get_sql = "select p.*,s.company_name from product p inner join supplier s on p.sup_id=s.sup_id where p.pro_name like '%{$search}%' and p.cate_id={$cate_id} and p.pro_price between {$bp} and {$ep} limit {$start} , {$perpage}";
} else {
	$get_sql = "select p.*,s.company_name from product p inner join supplier s on p.sup_id=s.sup_id limit {$start} , {$perpage}";
}*/

$get_sql = "select * from tbl_posts where post_status = 1 limit {$start} , {$perpage}";

//echo $get_sql;
$result = mysqli_query($link,$get_sql);

?>
<style type="text/css">
	.thumb-img {
		width : 50px;
		height : 50px;
	}
	#search {
		height: 34px;
		padding: 6px 12px;
		font-size: 14px;
		font-size: 14px;
		line-height: 1.428571429;
		color: #555;
		vertical-align: middle;
		background-color: #fff;
		background-image: none;
		border: 1px solid #ccc;
		border-radius: 4px;
		-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
		box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
		-webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
		transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
	}
</style>

<script type="text/javascript">

$(document).ready(function(){

	$(".btn-danger").click(function(){
		var id=$(this).parent().next("td").text();
		var data = "hid_post_id="+id;
		//alert(data);
		data = data + "&type=del";
		$.ajax({
				type		:	"POST",
				url		:	"blog_postpro.php",
				data		:	data,
				success	:	function(html) {

								//alert(html);
								//$("#result_add_member").html(html);

								var arr_html = html.split("|");
								if (arr_html[0] != "0") {
									alert(arr_html[1]);
									window.location = "blog_post.php";
								} else {
									alert(arr_html[1]);
								}

							}
			});
	});

	/*$("#btn_search").click(function(){
		var key = $("#search").val();
		var cate = $("#cate_id :selected").val();
		var bp = $("#begin_price").val();
		var ep = $("#end_price").val();

		var url = "product.php";

		if ((key != "") && (cate == "0") && (bp == "") && (ep == "")) {
			url = "product.php?key="+key+"&mode=1";
		}
		if ((key == "") && (cate != "0") && (bp == "") && (ep == "")) {
			url = "product.php?cate="+cate+"&mode=2";
		}
		if ((key != "") && (cate != "0") && (bp == "") && (ep == "")) {
			url = "product.php?key="+key+"&cate="+cate+"&mode=3";
		}
		if ((key == "") && (cate == "0") && (bp != "") && (ep != "")) {
			url = "product.php?bp="+bp+"&ep="+ep+"&mode=4";
		}
		if ((key != "") && (cate == "0") && (bp != "") && (ep != "")) {
			url = "product.php?key="+key+"&bp="+bp+"&ep="+ep+"&mode=5";
		}
		if ((key == "") && (cate != "0") && (bp != "") && (ep != "")) {
			url = "product.php?cate="+cate+"&bp="+bp+"&ep="+ep+"&mode=6";
		}
		if ((key != "") && (cate != "0") && (bp != "") && (ep != "")) {
			url = "product.php?key="+key+"&cate="+cate+"&bp="+bp+"&ep="+ep+"&mode=7";
		}

		//alert(url);
		window.location = url;

	});*/

});

</script>

<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <!-- Page Title Zone -->
      <div class="page-title">
         <div class="title_left">
            <h3>บทความ</h3>
         </div>

         <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
               <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                     <button class="btn btn-default" type="button">Go!</button>
                  </span>
               </div>
            </div>
         </div>
      </div>

   <div class="clearfix"></div>

   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="x_panel">
            <!-- <div class="x_title">
               <h2>Header Text</h2>

               <div class="clearfix"></div>
		   </div> -->
            <div class="x_content">

				<p style="margin-bottom : 25px;">
 			   	<img src="../img/notepad.png" style="width:40px;" />&nbsp;&nbsp;<b style="font-size:1.2em;">รายการบทความ</b>
 			   	&nbsp;<input type="text" id="search" name="search" placeholder="ค้นหา..." value="<?php echo $search; ?>" />
				<button type="button" class="btn btn-default" id="btn_search" style="margin-top:5px;">ค้นหา</button>
				<a href="blog_postins.php"><button type="button" class="btn btn-primary" style="margin-top:5px;">เพิ่มบทความใหม่</button></a>
				<!--

 			   	<?php
 			   		//$get_sql2 = "select * from category where cate_status = 1";
 			   		//$result2 = mysqli_query($link,$get_sql2);
 			   	?>
 			   		<select id="cate_id" name="cate_id">
 			   			<option value="0">------------หมวดหมู่สินค้า-----------</option>
 			   			<?php
 			   				/*if (mysqli_num_rows($result2) > 0) {
 			   					while ($row2 = mysqli_fetch_array($result2)) {

 			   						if ($cate_id == $row2["cate_id"]) {
 			   							echo "<option value='".$row2["cate_id"]."' selected>".$row2["cate_name"]."</option>";
 			   						} else {
 			   							echo "<option value='".$row2["cate_id"]."'>".$row2["cate_name"]."</option>";
 			   						}

 			   					}
 			   				}*/
 			   			?>
 			   		</select>
 			   	ราคา <input type="textbox" style="width:80px;" id="begin_price" value="<?php echo $bp; ?>" /> ถึง <input type="textbox" style="width:80px;" id="end_price" value="<?php echo $ep; ?>" />
 			   	<button type="button" class="btn btn-default" id="btn_search">ค้นหา</button>
 			   	&nbsp;<a href="productins.php"><button type="button" class="btn btn-primary">เพิ่มข้อมูลสินค้า</button></a>
				// **COMMENT <a href="report.php?report=2" target="_blank"><button type="button" class="btn btn-default">ดูรายงาน</button></a>
				</p> -->
 			   <table class="table table-striped">
 			       <thead>
 			         <tr>
 			           	<th width="15%">หมายเลขโพส</th>
 			           	<th width="30%">ชื่อโพส</th>
	 			   		<th width="15%">ผู้เขียน</th>
	 			   		<th width="10%">วันที่เขียน</th>
	 			   		<th width="10%"></th>
	 			   		<th width="10%"></th>
 			         </tr>
 			       </thead>
 			       <tbody>
 			         <?php

 			   		if (mysqli_num_rows($result) != 0) {
 			   			while ($row=mysqli_fetch_array($result)) {
 			   				echo "<tr>";
 			   				echo "<td>".$row["post_id"]."</td>";

 			   				// Find feature picture
 			   				/*$get_img = "select * from product_image where img_group_id=".$row["img_group_id"]." limit 1";
 			   				$res_img = mysqli_query($link,$get_img);
 			   				if (mysqli_num_rows($res_img)>0) {
 			   					while ($row_img=mysqli_fetch_array($res_img)) {
 			   						$pro_img = $row_img["img_id"].".jpg";
 			   					}
 			   				}*/

 			   				//echo "<td><img src='../uploads/".$pro_img."' class='thumb-img' />&nbsp;&nbsp;".$row["pro_name"]."</td>";

 			   				echo "<td>".$row["post_name"]."</td>";
 			   				echo "<td>".$row["post_owner"]."</td>";
								echo "<td>".$row["post_date"]."</td>";

 			   				/*if ($row["cate_status"] == "1") {
 			   					$status_txt = "ใช้";
 			   				} else {
 			   					$status_txt = "ไม่ใช้";
 			   				}*/

 			   				//echo "<td>".$status_txt."</td>";
 			   				echo "<td><a href='blog_postedit.php?id=".$row["post_id"]."'><button type='button' class='btn btn-primary'>Edit</button></a></td>";
 			   				echo "<td><button type='button' class='btn btn-danger'>Del</button></td>";
 			   				echo "<td style='display:none'>".$row["post_id"]."</td>";
 			   				echo "</tr>";
 			   			}
 			   		} else {
 			   			echo "<tr>";
 			   			echo "<td colspan=6 style='text-align:center'>ไม่พบข้อมูลในระบบ</td>";
 			   			echo "</tr>";
 			   		}

 			   	  ?>
 			       </tbody>
 			     </table>
 			   <?php
 			   	$sql2 = "select * from tbl_posts ";
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
 			   				<a href="blog_post.php?page=1" aria-label="Previous">
 			   				<span aria-hidden="true">&laquo;</span>
 			   				</a>
 			   			</li>
 			   			<?php for($i=1;$i<=$total_page;$i++){ ?>
 			   			<li><a href="blog_post.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
 			   			<?php } ?>
 			   			<li>
 			   				<a href="blog_post.php?page=<?php echo $total_page;?>" aria-label="Next">
 			   				<span aria-hidden="true">&raquo;</span>
 			   				</a>
 			   			</li>
 			   		</ul>
 			   	</nav>

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
  mysqli_close($link);
  include "template_bottom.php";
?>

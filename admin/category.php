<?php
include "template_head.php";

require_once "dbcon.php";
//echo DBSERVER;
//return false;
//$con = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);


$conn = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);
//mysql_select_db(DB, $conn);
mysqli_query($conn,"SET character_set_results=utf8");
mysqli_query($conn,"SET character_set_client=utf8");
mysqli_query($conn,"SET character_set_connection=utf8");

$perpage = 10;
if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}
$start = ($page - 1) * $perpage;

$get_sql = "select * from category limit {$start} , {$perpage}";
$result = mysqli_query($conn,$get_sql);

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

<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <!-- Page Title Zone -->
      <div class="page-title">
         <div class="title_left">
            <h3>หมวดหมู่บทความ</h3>
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
               <h2>หมวดหมู่บทความ</h2>

               <div class="clearfix"></div>
            </div> -->
            <div class="x_content">

					<p style="margin-bottom : 25px;">
						<img src="../img/Bookmark-add.png" style="width:40px;" />&nbsp;&nbsp;<b style="font-size:1.2em;">รายการหมวดหมู่บทความ</b>
						&nbsp;<a href="categoryins.php"><button type="button" class="btn btn-default">เพิ่มข้อมูลหมวดหมู่บทความ</button></a>
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
								echo "<td colspan=5>ไม่พบข้อมูลในระบบ</td>";
								echo "</tr>";
							}

						  ?>
					    </tbody>
					  </table>
					<?php
						$sql2 = "select * from category ";
						$query2 = mysqli_query($conn, $sql2);
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
	mysqli_close($conn);
  	//$conn->close();
  	include "template_bottom.php";
?>

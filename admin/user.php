<?php
include "template_head.php";

require_once "dbcon.php";
//echo DBSERVER;
//return false;
//$con = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);

if (isset($_SESSION['valid_admin'])) {
	if ($_SESSION['valid_admin'] != "1") {
		header('Location: ad_login.php');
	}
} else {
	header('Location: ad_login.php');
}

// DB section
//$conn = mysql_connect(SERVER, USR, PWD);
$link = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);
//mysql_select_db(DB, $conn);
mysqli_query($link,"SET character_set_results=utf8");
mysqli_query($link,"SET character_set_client=utf8");
mysqli_query($link,"SET character_set_connection=utf8");

if (isset($_GET['key'])) {
	$search = $_GET['key'];
	echo "<h4>ผลการค้นหาผู้ใช้งาน</h4>";
} else {
	$search ="";
}

$perpage = 10;
if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}
$start = ($page - 1) * $perpage;

if (isset($_GET['key'])) {
	$get_sql = "select * from tbl_users where fullname like '%{$search}%' limit {$start} , {$perpage}";
} else {
	$get_sql = "select * from tbl_users limit {$start} , {$perpage}";
}

//echo $get_sql;

	$result = mysqli_query($link,$get_sql);


?>

<style type="text/css">

	#search {
		height: 34px;
		padding: 6px 12px;
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
		var data = "empn="+id;
		//alert(data);
		data = data + "&type=del";
		$.ajax({
				type		:	"POST",
				url			:	"user_pro.php",
				data		:	data,
				success		:	function(html) {

								//alert(html);
								//$("#result_add_member").html(html);

								var arr_html = html.split("|");
								if (arr_html[0] != "0") {
									alert(arr_html[1]);
									window.location = "user.php";
								} else {
									alert(arr_html[1]);
								}

							}
			});
	});

	$("#btn_search").click(function(){
		var key = $("#search").val();

		window.location = "user.php?key="+key;
	});

	$("#search").keypress(function(e) {
    if(e.which == 13) {
        var key = $(this).val();

		window.location = "user.php?key="+key;
    }
	});
});

</script>

<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <!-- Page Title Zone -->
      <div class="page-title">
         <div class="title_left">
            <h3>รายชื่อผู้ใช้งานระบบ</h3>
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

            <div class="x_content">
					<p style="margin-bottom : 25px;">
						&nbsp;<input type="text" style="margin-bottom: 5px;" id="search" name="search" placeholder="ค้นหาจากชื่อผู้ใช้งาน..." value="<?php echo $search; ?>" />
						<button type="button" class="btn btn-default" id="btn_search">ค้นหา</button>
						<a href="userins.php"><button type="button" class="btn btn-primary">เพิ่มข้อมูลผู้ใช้งาน</button></a>
						<!-- <a href="report.php?report=1" target="_blank"><button type="button" class="btn btn-default">ดูรายงาน</button></a> -->
					</p>
					<table class="table table-striped">
					    <thead>
					      <tr>
					        <th width="15%">เลขประจำตัว</th>
					        <th width="15%">รูปประจำตัว</th>
							<th width="25%">ชื่อ</th>
							<th width="20%">สังกัด</th>
							<th width="15%">เบอร์โทร</th>
							<th width="10%"></th>
							<th width="10%"></th>
					      </tr>
					    </thead>
					    <tbody>
					      <?php

							if (mysqli_num_rows($result) != 0) {
								while ($row=mysqli_fetch_array($result)) {
									echo "<tr>";
									echo "<td>".$row["empn"]."</td>";
									echo "<td><img src='userprofile/".$row["user_pic"]."' style='width:50px;height:50px;' /></td>";
									echo "<td>".$row["fullname"]."</td>";
									echo "<td>".$row["user_dept"]."</td>";
									echo "<td>".$row["user_tel"]."</td>";

									/*if ($row["cate_status"] == "1") {
										$status_txt = "ใช้";
									} else {
										$status_txt = "ไม่ใช้";
									}*/

									//echo "<td>".$status_txt."</td>";
									echo "<td><a href='userupd.php?id=".$row["empn"]."'><button type='button' class='btn btn-primary'>Edit</button></a></td>";
									echo "<td><button type='button' class='btn btn-danger'>Del</button></td>";
									echo "<td style='display:none'>".$row["empn"]."</td>";
									echo "</tr>";
								}
							} else {
								echo "<tr>";
								echo "<td colspan=6>ไม่พบข้อมูลในระบบ</td>";
								echo "</tr>";
							}

						  ?>
					    </tbody>
					  </table>
					<?php
						$sql2 = "select * from tbl_users ";
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
									<?php
										if (isset($_GET['key'])) {
											echo "<a href='user.php?page=1&key=".$search."' aria-label='Previous'>";
										} else {
											echo "<a href='user.php?page=1' aria-label='Previous'>";
										}
									?>
									<span aria-hidden="true">&laquo;</span>
									</a>
								</li>
								<?php for($i=1;$i<=$total_page;$i++){ ?>
								<li>
								<?php
										if (isset($_GET['key'])) {
											echo "<a href='user.php?page={$i}&key={$search}'>{$i}</a></li>";
										} else {
											echo "<a href='user.php?page={$i}'>{$i}</a></li>";
										}
									?>
								<?php } ?>
								<li>
									<?php
										if (isset($_GET['key'])) {
											echo "<a href='user.php?page={$total_page}&key={$search}' aria-label='Next'>";
										} else {
											echo "<a href='user.php?page={$total_page}' aria-label='Next'>";
										}
									?>
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
  //$conn->close();
  mysqli_close($link);
  include "template_bottom.php";
?>

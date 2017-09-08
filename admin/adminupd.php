<?php
include "template_head.php";

require_once "dbcon.php";
//echo DBSERVER;
//return false;
//$con = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);

$link = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);
//mysql_select_db(DB, $conn);
mysqli_query($link,"SET character_set_results=utf8");
mysqli_query($link,"SET character_set_client=utf8");
mysqli_query($link,"SET character_set_connection=utf8");

$ad_id = $_GET["id"];

$get_sql = "select * from admin where ad_id = ".$ad_id;
//echo $get_sql;
$result = mysqli_query($link,$get_sql);

if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_array($result)){
		$username = $row["ad_username"];
		$password = $row["ad_password"];
	}
}

?>

<script type="text/javascript">

$(document).ready(function(){

	$("#submit").click(function(){
		//alert("test");

		var data;
		var chk_val = "1";

		$("#frmedit input").each(function(){

			if ($(this).val() == "") {
				chk_val = "0";
			}

		});

		data = $("#frmedit").serialize();
		//alert(data);
		//return false;
		data = data + "&type=upd";

		if (chk_val == "0") {
			alert("กรุณากรอกข้อมูลให้ครบ");
			return false;
		} else {

			$.ajax({
				type		:	"POST",
				url			:	"admin_pro.php",
				data		:	data,
				success		:	function(html) {

								//alert(html);
								//$("#result_add_member").html(html);

								var arr_html = html.split("|");
								if (arr_html[0] != "0") {
									alert(arr_html[1]);
									window.location = "admin.php";
								} else {
									alert(arr_html[1]);
								}

							}
			});
		}

		return false;
	});
});

</script>

<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <!-- Page Title Zone -->
      <div class="page-title">
         <div class="title_left">
            <h3>แก้ไขผู้ดูแลระบบ</h3>
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
               <h2>แก้ไขผู้ดูแลระบบ</h2>

               <div class="clearfix"></div>
            </div> -->
            <div class="x_content">

					<div id="dv_formedit">
					<form class="form-horizontal" role="form" id="frmedit">
					  <div class="form-group">
					    <label class="control-label col-sm-5" for="username">Username:</label>
					    <div class="col-sm-4">
					      <input type="textbox" class="form-control" id="username" placeholder="Enter username" name="username" value="<?php echo $username; ?>"/>
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-sm-5" for="pwd">Password:</label>
					    <div class="col-sm-4">
					      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" value="<?php echo $password; ?>" />
					    </div>
					  </div>
					  <div class="form-group">
					    <div class="col-sm-offset-5 col-sm-10">
							<input type="hidden" name="hid_ad_id" value="<?php echo $ad_id; ?>"  />
					      <button id="submit" type="submit" class="btn btn-default">Submit</button>
						  <a href="admin.php"><button type="button" class="btn btn-default">Back</button></a>
					    </div>
					  </div>
					</form>
					</div>

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

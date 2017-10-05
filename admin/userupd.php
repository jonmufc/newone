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

$user_id = $_GET["id"];

$get_sql = "select * from tbl_users where empn = '".$user_id."'";
//echo $get_sql;
$result = mysqli_query($link,$get_sql);

if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_array($result)){
		$empn = $row["empn"];
		$fullname = $row["fullname"];
		$user_tel = $row["user_tel"];
		$user_password = $row["user_password"];
		$user_pic = $row["user_pic"];
		$user_dept = $row["user_dept"];
	}

}

?>
<script type="text/javascript">

$(document).ready(function(){

	$("#submit").click(function(){
		//alert("test");

		var data;
		var chk_val = "1";

		/*$("#frmedit input").each(function(){

			if ($(this).val() == "") {
				chk_val = "0";
			}

		});*/

		//data = $("#frmedit").serialize();
		data = new FormData($("#frmedit")[0]);
		//alert(data);
		//return false;
		//data = data + "&type=upd";

		if (chk_val == "0") {
			alert("กรุณากรอกข้อมูลให้ครบ");
			return false;
		} else {

			$.ajax({
				type		:	"POST",
				url			:	"user_pro.php",
				data		:	data,
				cache		: 	false,
				contentType	: 	false,
				processData	: 	false,
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
            <h3>แก้ไขข้อมูลลูกค้า</h3>
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

					<div id="dv_formedit">
					<form class="form-horizontal" role="form" id="frmedit" method="POST" enctype="multipart/form-data">
						<div class="form-group">
	  			       <label class="control-label col-sm-5" for="user">เลขประจำตัว:</label>
	  			       <div class="col-sm-5">
	  			         <input type="textbox" class="form-control" id="empn" name="empn" value="<?php echo $empn; ?>" disabled />
	  			       </div>
	  			     </div>
	 				 <div class="form-group">
	  			       <label class="control-label col-sm-5" for="name">ชื่อ:</label>
	  			       <div class="col-sm-5">
	  			         <input type="textbox" class="form-control" id="user_fullname" name="user_fullname" value="<?php echo $fullname; ?>" />
	  			       </div>
	  			     </div>
	  			     <div class="form-group">
	  			       <label class="control-label col-sm-5" for="telephone">เบอร์โทรศัพท์:</label>
	  			       <div class="col-sm-5">
	  			         <input type="textbox" class="form-control" id="user_tel" name="user_tel" value="<?php echo $user_tel; ?>" />
	  			       </div>
	  			     </div>
	  			     <div class="form-group">
	  			       <label class="control-label col-sm-5" for="password">Password:</label>
	  			       <div class="col-sm-5">
	  			         <input type="password" class="form-control" id="user_pass" name="user_pass" value="<?php echo $user_password; ?>" />
	  			       </div>
	  			     </div>
	 				 <div class="form-group">
	  			       <label class="control-label col-sm-5" for="dept">สังกัด:</label>
	  			       <div class="col-sm-5">
	  			         <input type="textbox" class="form-control" id="user_dept" name="user_dept" value="<?php echo $user_dept; ?>" />
	  			       </div>
	  			     </div>
	 				 <div class="form-group">
	 				    <label class="control-label col-sm-5" for="pro_img">อัพโหลดรูปประจำตัว:</label>
	 				    <div class="col-sm-5">
	 						<div id="wrapper">
								<span style="color:#353eb7;"><b><?php echo $user_pic; ?></b></span>
	 							<input id="fileUpload" type="file" name="fileUpload" />
	 							<!-- <div id="image-holder"></div> -->
	 						</div>
	 					</div>
	 				  </div>
					  <div class="form-group">
					    <div class="col-sm-offset-5 col-sm-7">
							 <input type="hidden" name="type" value="upd" />
							<input type="hidden" name="hid_empn" value="<?php echo $empn; ?>"  />
					      <button id="submit" type="submit" class="btn btn-default">Submit</button>
						  <a href="user.php"><button type="button" class="btn btn-default">Back</button></a>
					    </div>
					  </div>
					  <div id = "result_add_member">
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

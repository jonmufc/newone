<?php
include "template_head.php";

require_once "dbcon.php";
//echo DBSERVER;
//return false;
//$con = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);

//$conn = new mysqli(DBSERVER,DBUSR,DBPWD,DBNAME);
$link = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);
//mysql_select_db(DB, $conn);
mysqli_query($link,"SET character_set_results=utf8");
mysqli_query($link,"SET character_set_client=utf8");
mysqli_query($link,"SET character_set_connection=utf8");

$post_id = $_GET["id"];

$get_sql = "select * from tbl_posts where post_id = ".$post_id;
//echo $get_sql;
$result = mysqli_query($link,$get_sql);

if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_array($result)){

		$cate_id = $row["post_cate_id"];
		$post_name = $row["post_name"];
		$post_owner = $row["post_owner"];
		$post_desc = $row["post_desc"];
		$rad_status = $row["post_status"];
		//$sel_file_doc1 = $_POST["sel_file_doc1"];

		$get_sql2 = "select * from tbl_group_doc where post_id = ".$post_id;
		$result2 = mysqli_query($link,$get_sql2);
		$sel_file = "";
		if (mysqli_num_rows($result2) > 0) {

			while ($row2 = mysqli_fetch_array($result2)){
				$sel_file = $sel_file . "," .$row2["fd_id"];
			}
			$sel_file = substr($sel_file,1);
		}

	}

	if ($rad_status == "1") {
		$check1 = "checked";
		$check2 = "";
	} else {
		$check2 = "checked";
		$check1 = "";
	}
}

echo $cate_id." ".$post_name;

?>

<style type="text/css">
.thumb-image{float:left;width:100px;position:relative;padding:5px;}
.thumb-image2{float:left;width:100px;position:relative;padding:5px;}
</style>

<script src="../lib/tinymce/tinymce.min.js"></script>

<link href="../lib/bootstrap-select-1.12.4/dist/css/bootstrap-select.min.css" rel="stylesheet">

<script src="../lib/bootstrap-select-1.12.4/dist/js/bootstrap-select.min.js" ></script>


<script type="text/javascript">


	tinymce.init({
		selector: '#post_desc',
		height: 225,
		plugins: [
				 "advlist autolink link image lists charmap print preview hr anchor pagebreak",
				 "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
				 "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
		 ],
		toolbar: "insertfile undo redo | fontsizeselect | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor | responsivefilemanager",
		setup: function (editor) {
				editor.on('change', function () {
					 tinymce.triggerSave();
				});
		  },
		external_filemanager_path:"../lib/filemanager/",
		  filemanager_title:"Responsive Filemanager" ,
		  external_plugins: { "filemanager" : "../filemanager/plugin.min.js"},
	});

</script>

<script type="text/javascript">

$(document).ready(function(){

	$('.selectpicker').selectpicker('val', [<?php echo $sel_file; ?>]);

	$("#submit").click(function(){
		//alert("test");

		var data;
		var chk_val = "1";

		/*$("#frmedit input:not('#fileUpload')").each(function(){

			if ($(this).val() == "") {
				chk_val = "0";
			}

		});*/

		//data = $("#frmedit").serialize();
		data = new FormData($("#frmedit")[0]);
		//alert(data);
		//return false;
		//data = data + "&type=upd";
		var file_doc = $("#sel_file_doc").val();
		//alert(file_doc);
		data.append('sel_file_doc1', file_doc);

		if (chk_val == "0") {
			alert("กรุณากรอกข้อมูลให้ครบ");
			return false;
		} else {

			//alert("ajax");
			$.ajax({
				type		:	"POST",
				url		:	"blog_postpro.php",
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
									window.location = "blog_post.php";
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
            <h3>แก้ไขบทความ</h3>
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
            <div class="x_title">
               <h2>แก้ไขบทความ</h2>

               <div class="clearfix"></div>
            </div>
            <div class="x_content">

					<div id="dv_formedit">
					<form class="form-horizontal" role="form" id="frmedit" enctype="multipart/form-data">
					<div class="form-group">
					    <label class="control-label col-sm-4" for="cate_id">หมวดหมู่บทความ:</label>
					    <div class="col-sm-8">
						<?php
							$get_sql = "select * from category where cate_status = 1";
							$result = mysqli_query($link,$get_sql);
						?>
							<select class="form-control" id="cate_id" name="cate_id">
								<option value="0">------------โปรดเลือกข้อมูล-----------</option>
								<?php
									if (mysqli_num_rows($result) > 0) {
										while ($row = mysqli_fetch_array($result)) {
											if ($cate_id == $row["cate_id"]) {
												echo "<option value='".$row["cate_id"]."' selected>".$row["cate_name"]."</option>";
											} else {
												echo "<option value='".$row["cate_id"]."'>".$row["cate_name"]."</option>";
											}

										}
									}
								?>
							</select>
					    </div>
					  </div>

					  <div class="form-group">
					    <label class="control-label col-sm-4" for="post_name">ชื่อเรื่อง (บทความ):</label>
					    <div class="col-sm-8">
					      <input type="textbox" class="form-control" id="post_name" name="post_name" value="<?php echo $post_name; ?>" />
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-sm-4" for="post_owner">ชื่อผู้เขียน:</label>
					    <div class="col-sm-8">
					      <!-- <input type="textbox" class="form-control" id="cus_address" placeholder="Enter Address" name="cus_address" /> -->
						  <input type="textbox" class="form-control" id="post_owner" name="post_owner" value="<?php echo $post_owner; ?>" />
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-sm-4" for="post_desc">เนื้อหา:</label>
					    <div class="col-sm-8">
					      <textarea class="form-control" id="post_desc" name="post_desc" /><?php echo $post_desc; ?></textarea>
					    </div>
					  </div>
					  <div class="form-group">
	 				 	   <label class="control-label col-sm-4" for="file_doc">แนบไฟล์ Documents :</label>
	 				 	  <div class="col-sm-8">

	 				 	  <?php
	 				 		   $get_sql = "select * from tbl_file_doc order by fd_id desc";
	 				 		   $result = mysqli_query($link,$get_sql);
	 				 	   ?>

	 				 	  <select id="sel_file_doc" name="sel_file_doc" class="selectpicker" data-live-search="true" multiple>
	 				 		 <?php
	 				 		   if (mysqli_num_rows($result) > 0) {
	 				 			   while ($row = mysqli_fetch_array($result)) {
	 				 				   echo "<option value='".$row["fd_id"]."'>".$row["full_name"]."</option>";
	 				 			   }
	 				 		   }
	 				 		   ?>
	 				 	   </select>
	 				 	   </div>
	 				 </div>
					  <div class="form-group">
					    <label class="control-label col-sm-4" for="cus_status">สถานะบทความ:</label>
					    <div class="col-sm-8">
							<label class="radio-inline"><input type="radio" name="rad_status" value="1" <?php echo $check1; ?>>ปกติ</label>
							<label class="radio-inline"><input type="radio" name="rad_status" value="0" <?php echo $check2; ?>>ยกเลิก</label>
					    </div>

					  </div>
					  <div class="form-group">
					    <div class="col-sm-offset-4 col-sm-8">
							<input type="hidden" name="type" value="upd" />
							<input type="hidden" name="post_id" value="<?php echo $post_id; ?>" >
					      <button id="submit" type="submit" class="btn btn-default">Submit</button>
						  <a href="blog_post.php"><button type="button" class="btn btn-default">Back</button></a>
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
  //$conn->close();
  mysqli_close($link);
  include "template_bottom.php";
?>

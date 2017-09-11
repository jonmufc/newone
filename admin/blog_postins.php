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
?>

<style type="text/css">
.thumb-image{float:left;width:100px;position:relative;padding:5px;}
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

	//tinymce.init({ selector:'textarea' });

</script>

<script type="text/javascript">

$(document).ready(function(){

	$("#fileUpload").on('change', function() {
          //Get count of selected files
          var countFiles = $(this)[0].files.length;
          var imgPath = $(this)[0].value;
          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
          var image_holder = $("#image-holder");
          image_holder.empty();
          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++)
              {
                var reader = new FileReader();
                reader.onload = function(e) {
                  $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image"
                  }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
              }
            } else {
              alert("This browser does not support FileReader.");
            }
          } else {
            alert("Pls select only images");
          }
        });

	$("#submit").click(function(){
		//alert("test");

		var data;
		var chk_val = "1";

		$("#frmadd input").each(function(){

			if ($(this).val() == "") {
				chk_val = "0";
			}

		});

		//data = $("#frmadd").serialize();
		//alert(data);
		//return false;
		data = new FormData($("#frmadd")[0]);

		var tiny = tinymce.get('pro_desc').getContent();
		//data = data + "&type=add&pro_desc2="+tiny;

		//alert(data);

		if (chk_val == "0") {
			alert("กรุณากรอกข้อมูลให้ครบ");
			return false;
		} else {

			$.ajax({
				type		:	"POST",
				url			:	"product_pro.php",
				data		:	data,
				cache		: 	false,
				contentType	: 	false,
				processData	: 	false,
				success		:	function(html) {

								//alert(html);
								//$("#result").html(html);

								var arr_html = html.split("|");
								if (arr_html[0] != "0") {
									alert(arr_html[1]);
									window.location = "product.php";
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
            <h3>จัดการบทความ</h3>
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
               <h2>เพิ่มบทความใหม่</h2>

               <div class="clearfix"></div>
            </div>
            <div class="x_content">

 			   <div id="dv_formadd">
 			   <form class="form-horizontal" role="form" id="frmadd" method="POST" enctype="multipart/form-data">
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
 			   						echo "<option value='".$row["cate_id"]."'>".$row["cate_name"]."</option>";
 			   					}
 			   				}
 			   			?>
 			   		</select>
 			       </div>
 			     </div>

 			     <div class="form-group">
 			       <label class="control-label col-sm-4" for="post_name">ชื่อเรื่อง (บทความ):</label>
 			       <div class="col-sm-8">
 			         <!-- <input type="textbox" class="form-control" id="cus_address" placeholder="Enter Address" name="cus_address" /> -->
 			   	  <input type="textbox" class="form-control" id="post_name" name="post_name" placeholder="ใส่ชื่อเรื่อง" />
 			       </div>
 			     </div>
 			     <div class="form-group">
 			       <label class="control-label col-sm-4" for="post_owner">ชื่อผู้เขียน:</label>
 			       <div class="col-sm-8">
 			         <input type="textbox" class="form-control" id="post_owner" placeholder="ใส่ชื่อผู้เขียน" name="post_owner" />
 			       </div>
 			     </div>
 			     <div class="form-group">
 			       <label class="control-label col-sm-4" for="post_desc">เนื้อหา:</label>
 			       <div class="col-sm-8">
 			         <textarea class="form-control" id="post_desc" name="post_desc" /></textarea>
 			       </div>
 			     </div>

				 <div class="form-group">
				 	   <label class="control-label col-sm-4" for="pro_name">เลือกไฟล์ Documents :</label>
				 	  <div class="col-sm-8">

				 	  <?php
				 		   $get_sql = "select * from tbl_file_doc order by fd_id desc";
				 		   $result = mysqli_query($link,$get_sql);
				 	   ?>

				 	  <select class="selectpicker" data-live-search="true" multiple>
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
 			       <label class="control-label col-sm-4" for="cus_status">สถานะสินค้า:</label>
 			       <div class="col-sm-8">
 			   		<label class="radio-inline"><input type="radio" name="rad_status" value="1" checked>ปกติ</label>
 			   		<label class="radio-inline"><input type="radio" name="rad_status" value="0">ยกเลิก</label>
 			       </div>

 			     </div>


 			     <div class="form-group">
 			       <div class="col-sm-offset-4 col-sm-8">
 			   		<input type="hidden" name="type" value="add" />
 			         <button id="submit" type="submit" class="btn btn-default">Submit</button>
 			   	  <a href="product.php"><button type="button" class="btn btn-default">Back</button></a>
 			       </div>
 			     </div>

 			     <div id = "result">
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

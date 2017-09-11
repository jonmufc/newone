<?php include "template_admin_head.php"; ?>

<style type="text/css">
.thumb-image{float:left;width:100px;position:relative;padding:5px;}
.thumb-image2{float:left;width:100px;position:relative;padding:5px;}
</style>	
	
<script type="text/javascript">


	tinymce.init({
		selector: '#pro_desc',
		height: 225,
		setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        }
		
	});
	
</script>

<script type="text/javascript">

$(document).ready(function(){
	
	$("#fileUpload").on('change', function() {
          //Get count of selected files
		  
		  $(".thumb-image2").remove();
		  
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
		
		$("#frmedit input:not('#fileUpload')").each(function(){
			
			if ($(this).val() == "") {
				chk_val = "0";
			}
			
		});
		
		//data = $("#frmedit").serialize();
		data = new FormData($("#frmedit")[0]);
		//alert(data);
		//return false;
		//data = data + "&type=upd";
		
		if (chk_val == "0") {
			alert("กรุณากรอกข้อมูลให้ครบ");
			return false;
		} else {
		
			//alert("ajax");
			$.ajax({
				type		:	"POST",
				url			:	"product_pro.php",
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

<?php
	//ob_start();
	include_once("dbconfig.php");
	//session_start();
	//require_once('custom/PHPMailer/class.phpmailer.php');

	// DB section
	//$conn = mysql_connect(SERVER, USR, PWD);
	$link = mysqli_connect(SERVER, USR, PWD, DB);
	//mysql_select_db(DB, $conn);
	mysqli_query($link,"SET character_set_results=utf8");
	mysqli_query($link,"SET character_set_client=utf8");
	mysqli_query($link,"SET character_set_connection=utf8");

	$pro_id = $_GET["id"];

	$get_sql = "select * from product where pro_id = ".$pro_id;
	//echo $get_sql;
	$result = mysqli_query($link,$get_sql);
	
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)){
			$pro_id = $row["pro_id"];
			$pro_name = $row["pro_name"];
			$pro_price = $row["pro_price"];
			$pro_desc = $row["pro_desc"];
			$pro_status = $row["pro_status"];
			$cate_id = $row["cate_id"];
			$pro_qty = $row["pro_qty"];
			$img_group_id = $row["img_group_id"];
			$sup_id = $row["sup_id"];
		}
		
		if ($pro_status == "1") {
			$check1 = "checked";
			$check2 = "";
		} else {
			$check2 = "checked";
			$check1 = "";
		}
	}  
	
?>

<p>
	<p><b>แก้ไขข้อมูลสินค้า</b></p>
	
</p>

<div id="dv_formedit">
<form class="form-horizontal" role="form" id="frmedit" enctype="multipart/form-data">
<div class="form-group">
    <label class="control-label col-sm-4" for="cate_id">ประเภทสินค้า:</label>
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
    <label class="control-label col-sm-4" for="sup_id">เลือก Supplier:</label>
    <div class="col-sm-8">
	<?php
		$get_sql = "select * from supplier where com_status = 1";
		$result = mysqli_query($link,$get_sql);
	?>
		<select class="form-control" id="sup_id" name="sup_id">
			<option value="0">------------โปรดเลือกข้อมูล-----------</option>
			<?php
				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_array($result)) {
						if ($sup_id == $row["sup_id"]) {
							echo "<option value='".$row["sup_id"]."' selected>".$row["company_name"]."</option>";	
						} else {
							echo "<option value='".$row["sup_id"]."'>".$row["company_name"]."</option>";
						}
						
					}
				}
			?>
		</select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4" for="pro_name">ชื่อสินค้า:</label>
    <div class="col-sm-8">
      <input type="textbox" class="form-control" id="pro_name" placeholder="Enter Product Name" name="pro_name" value="<?php echo $pro_name; ?>" />
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4" for="pro_price">ราคา (บาท):</label>
    <div class="col-sm-8">
      <!-- <input type="textbox" class="form-control" id="cus_address" placeholder="Enter Address" name="cus_address" /> -->
	  <input type="textbox" class="form-control" id="pro_price" name="pro_price" placeholder="Enter Product Price" value="<?php echo $pro_price; ?>" />
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4" for="pro_qty">จำนวน:</label>
    <div class="col-sm-8">
      <input type="textbox" class="form-control" id="pro_qty" placeholder="Enter Qty" name="pro_qty" value="<?php echo $pro_qty; ?>" />
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4" for="pro_desclabel">รายละเอียดสินค้า:</label>
    <div class="col-sm-8">
      <textarea class="form-control" id="pro_desc" name="pro_desc" /><?php echo $pro_desc; ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4" for="pro_img">อัพโหลดรูปภาพ:</label>
    <div class="col-sm-8">
		<div id="wrapper">
			<input id="fileUpload" multiple="multiple" type="file" name="fileUpload[]" /> 
			<div id="image-holder"></div>
		</div>
		<?php
		$get_sql = "select * from product_image where img_group_id = ".$img_group_id;
		//echo $get_sql;
		$result = mysqli_query($link,$get_sql);
	
				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_array($result)) {
						//echo $row["img_id"];
						echo "<img src='../uploads/".$row["img_id"].".jpg' class='thumb-image2' />";
					}
				}
			?>
	</div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4" for="cus_status">สถานะสินค้า:</label>
    <div class="col-sm-8"> 
		<label class="radio-inline"><input type="radio" name="rad_status" value="1" <?php echo $check1; ?>>ปกติ</label>
		<label class="radio-inline"><input type="radio" name="rad_status" value="0" <?php echo $check2; ?>>ยกเลิก</label>
    </div>

  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-4 col-sm-8">
		<input type="hidden" name="type" value="upd" />
		<input type="hidden" name="pro_id" value="<?php echo $pro_id; ?>" >
      <button id="submit" type="submit" class="btn btn-default">Submit</button>
	  <a href="product.php"><button type="button" class="btn btn-default">Back</button></a>
    </div>
  </div>

  <div id = "result_add_member">
  </div>
</form>
</div>
<?php
	mysqli_close($link);
?>
<?php include "template_admin_bot.php"; ?>
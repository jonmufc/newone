<?php include "template_admin_head.php"; ?>

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

	$cate_id = $_GET["id"];

	$get_sql = "select * from category where cate_id = ".$cate_id;
	//echo $get_sql;
	$result = mysqli_query($link,$get_sql);
	
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)){
			$category = $row["cate_name"];
			$cate_status = $row["cate_status"];
		}
		
		if ($cate_status == "1") {
			$check1 = "checked";
			$check2 = "";
		} else {
			$check2 = "checked";
			$check1 = "";
		}
	}  
	
?>

<p>
	<p><b>แก้ไขประเภทสินค้า</b></p>
	
</p>

<div id="dv_formedit">
<form class="form-horizontal" role="form" id="frmedit">
  <div class="form-group">
    <label class="control-label col-sm-5" for="category">ประเภทสินค้า:</label>
    <div class="col-sm-4">
      <input type="textbox" class="form-control" id="category" placeholder="Enter category" name="category" value="<?php echo $category; ?>"/>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-5" for="pwd">สถานะประเภทสินค้า:</label>
    <div class="col-sm-4">
		<label class="radio-inline"><input type="radio" name="rad_status" value="1" <?php echo $check1; ?>>ใช้</label>
		<label class="radio-inline"><input type="radio" name="rad_status" value="0" <?php echo $check2; ?>>ไม่ใช้</label>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-5 col-sm-7">
		<input type="hidden" name="hid_cate_id" value="<?php echo $cate_id; ?>"  />
      <button id="submit" type="submit" class="btn btn-default">Submit</button>
	  <a href="category.php"><button type="button" class="btn btn-default">Back</button></a>
    </div>
  </div>
</form>
</div>
<?php
	mysqli_close($link);
?>
<?php include "template_admin_bot.php"; ?>
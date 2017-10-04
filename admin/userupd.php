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
				url			:	"customer_pro.php",
				data		:	data,
				success		:	function(html) {
						
								//alert(html);
								//$("#result_add_member").html(html);
								
								var arr_html = html.split("|");
								if (arr_html[0] != "0") {
									alert(arr_html[1]);
									window.location = "customer.php";
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

	$cus_id = $_GET["id"];

	$get_sql = "select * from customer where cus_id = ".$cus_id;
	//echo $get_sql;
	$result = mysqli_query($link,$get_sql);
	
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)){
			$cus_id = $row["cus_id"];
			$cus_name = $row["cus_name"];
			$cus_address = $row["cus_address"];
			$cus_tel = $row["cus_tel"];
			$cus_mail = $row["cus_mail"];
			$cus_user = $row["cus_user"];
			$cus_password = $row["cus_password"];
			$cus_status = $row["cus_status"];
		}
		
		if ($cus_status == "1") {
			$check1 = "checked";
			$check2 = "";
		} else {
			$check2 = "checked";
			$check1 = "";
		}
	}  
	
?>

<p>
	<p><b>แก้ไขข้อมูลลูกค้า</b></p>
	
</p>

<div id="dv_formedit">
<form class="form-horizontal" role="form" id="frmedit">
<div class="form-group">
    <label class="control-label col-sm-5" for="customer">ชื่อลูกค้า:</label>
    <div class="col-sm-5">
      <input type="textbox" class="form-control" id="cus_name" placeholder="Enter Customer Name" name="cus_name" value="<?php echo $cus_name; ?>" />
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-5" for="cus_address">ที่อยู่:</label>
    <div class="col-sm-5">
      <!-- <input type="textbox" class="form-control" id="cus_address" placeholder="Enter Address" name="cus_address" /> -->
	  <textarea class="form-control" id="cus_address" name="cus_address" placeholder="Enter Address" ><?php echo $cus_address; ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-5" for="telephone">เบอร์โทรศัพท์:</label>
    <div class="col-sm-5">
      <input type="textbox" class="form-control" id="cus_tel" placeholder="Enter Telephone" name="cus_tel" value="<?php echo $cus_tel; ?>" />
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-5" for="email">Email:</label>
    <div class="col-sm-5">
      <input type="textbox" class="form-control" id="cus_email" placeholder="Enter Email" name="cus_email" value="<?php echo $cus_mail; ?>" />
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-5" for="username">Username:</label>
    <div class="col-sm-5">
      <input type="textbox" class="form-control" id="cus_user" placeholder="Enter Username" name="cus_user" value="<?php echo $cus_user; ?>" />
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-5" for="password">Password:</label>
    <div class="col-sm-5">
      <input type="password" class="form-control" id="cus_pass" placeholder="Enter Password" name="cus_pass" value="<?php echo $cus_password; ?>" />
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-5" for="cus_status">สถานะลูกค้า:</label>
    <div class="col-sm-5"> 
		<label class="radio-inline"><input type="radio" name="rad_status" value="1" <?php echo $check1; ?>>ปกติ</label>
		<label class="radio-inline"><input type="radio" name="rad_status" value="0" <?php echo $check2; ?>>ยกเลิก</label>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-5 col-sm-7">
		<input type="hidden" name="hid_cus_id" value="<?php echo $cus_id; ?>"  />
      <button id="submit" type="submit" class="btn btn-default">Submit</button>
	  <a href="customer.php"><button type="button" class="btn btn-default">Back</button></a>
    </div>
  </div>
</form>
</div>
<?php
	mysqli_close($link);
?>
<?php include "template_admin_bot.php"; ?>
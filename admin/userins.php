<?php include "template_admin_head.php"; ?>

<script type="text/javascript">

$(document).ready(function(){
	$("#submit").click(function(){
		//alert("test");
		
		var data;
		var chk_val = "1";
		
		$("#frmadd input").each(function(){
			
			if ($(this).val() == "") {
				chk_val = "0";
			}
			
		});
		
		data = $("#frmadd").serialize();
		//alert(data);
		//return false;
		
		data = data + "&type=add";
		
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

<p>
	<p><b>เพิ่มข้อมูลลูกค้า</b></p>
</p>

<div id="dv_formadd">
<form class="form-horizontal" role="form" id="frmadd">
  <div class="form-group">
    <label class="control-label col-sm-5" for="customer">ชื่อลูกค้า:</label>
    <div class="col-sm-5">
      <input type="textbox" class="form-control" id="cus_name" placeholder="Enter Customer Name" name="cus_name" />
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-5" for="cus_address">ที่อยู่:</label>
    <div class="col-sm-5">
      <!-- <input type="textbox" class="form-control" id="cus_address" placeholder="Enter Address" name="cus_address" /> -->
	  <textarea class="form-control" id="cus_address" name="cus_address" placeholder="Enter Address" ></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-5" for="telephone">เบอร์โทรศัพท์:</label>
    <div class="col-sm-5">
      <input type="textbox" class="form-control" id="cus_tel" placeholder="Enter Telephone" name="cus_tel" />
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-5" for="email">Email:</label>
    <div class="col-sm-5">
      <input type="textbox" class="form-control" id="cus_email" placeholder="Enter Email" name="cus_email" />
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-5" for="username">Username:</label>
    <div class="col-sm-5">
      <input type="textbox" class="form-control" id="cus_user" placeholder="Enter Username" name="cus_user" />
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-5" for="password">Password:</label>
    <div class="col-sm-5">
      <input type="password" class="form-control" id="cus_pass" placeholder="Enter Password" name="cus_pass" />
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-5" for="cus_status">สถานะลูกค้า:</label>
    <div class="col-sm-5"> 
		<label class="radio-inline"><input type="radio" name="rad_status" value="1" checked>ปกติ</label>
		<label class="radio-inline"><input type="radio" name="rad_status" value="0">ยกเลิก</label>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-5 col-sm-7">
      <button id="submit" type="submit" class="btn btn-default">Submit</button>
	  <a href="customer.php"><button type="button" class="btn btn-default">Back</button></a>
    </div>
  </div>
  <div id = "result_add_member">
  </div>
</form>

</div>

<?php include "template_admin_bot.php"; ?>
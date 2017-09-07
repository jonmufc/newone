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

<p>
	<p><b>เพิ่มข้อมูลประเภทสินค้า</b></p>
</p>

<div id="dv_formadd">
<form class="form-horizontal" role="form" id="frmadd">
  <div class="form-group">
    <label class="control-label col-sm-5" for="category">ชื่อประเภทสินค้า:</label>
    <div class="col-sm-4">
      <input type="textbox" class="form-control" id="category" placeholder="Enter Category" name="category" />
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-5" for="pwd">สถานะประเภทสินค้า:</label>
    <div class="col-sm-4"> 
		<label class="radio-inline"><input type="radio" name="rad_status" value="1" checked>ใช้</label>
		<label class="radio-inline"><input type="radio" name="rad_status" value="0">ไม่ใช้</label>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-5 col-sm-7">
      <button id="submit" type="submit" class="btn btn-default">Submit</button>
	  <a href="category.php"><button type="button" class="btn btn-default">Back</button></a>
    </div>
  </div>
</form>
</div>

<?php include "template_admin_bot.php"; ?>
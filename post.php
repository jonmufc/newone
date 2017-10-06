<?php
	include "template_head.php";

	//$get_sql = "select * from admin";
	//$result = mysqli_query($link,$get_sql);
	//$result = mysqli_query($link,$get_sql);

	function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
	}

?>

<style type="text/css">

.article_desc {
    margin-top : 25px;
	min-height: 200px;
}

.post_comment {
	margin-top : 20px;
}

</style>

<script type="text/javascript">

$(document).ready(function(){

	$(window).load(function(){
		var post_id = $("input[name='txt_post_id']").val();
		//alert(post_id);
		var data = "post_id="+post_id;

		$.ajax({
			type		:	"POST",
			url		:	"cm_feed.php",
			data		:	data,
			success	:	function(html) {

							//alert(html);
							$("#result_add_member").html(html);

							/*var arr_html = html.split("|");
							if (arr_html[0] != "0") {
								alert(arr_html[1]);
								window.location = "user.php";
							} else {
								alert(arr_html[1]);
							}*/

						}
		});
	});

	$("#btn_submit_cm").click(function(){

		var txt_cm = $("#txt_comment").val();
		if (txt_cm == "" ) {
			alert("กรุณาใส่ข้อคิดเห็นก่อนกดปุ่มครับ");
			return false;
		}

		data = $("#frmadd").serialize();

		//data = new FormData($("#frmadd")[0]);
		//alert(data);
		//return false;

		//data = data + "&type=add";

			$.ajax({
				type		:	"POST",
				url		:	"cm_pro.php",
				data		:	data,
				success	:	function(html) {

								//alert(html);
								//$("#result_add_member").html(html);
								var post_id = $("input[name='txt_post_id']").val();
								var data = "post_id="+post_id;

								$.ajax({
									type		:	"POST",
									url		:	"cm_feed.php",
									data		:	data,
									success	:	function(html) {

													//alert(html);
													$("#result_add_member").html(html);

													/*var arr_html = html.split("|");
													if (arr_html[0] != "0") {
														alert(arr_html[1]);
														window.location = "user.php";
													} else {
														alert(arr_html[1]);
													}*/
													$("#txt_comment").val("");

												}
								});

								/*var arr_html = html.split("|");
								if (arr_html[0] != "0") {
									alert(arr_html[1]);
									window.location = "user.php";
								} else {
									alert(arr_html[1]);
								}*/

							}
			});

		return false;
	});

});

</script>
	<!-- <div style="margin : 0px 0px 10px 10px;width:100%">
		<img src="img/hot-item.png" id="hot-item" style="width : 130px;text-align:right" />
	</div> -->

	<div class="panel panel-default">
		<div class="panel-body">

	<?php
	if (isset($_GET['p'])) {
		$post_id = $_GET['p'];
	} else {
        echo "Nothing here";
        return false;
    }

    //echo $post_id;

    $get_post = "select * FROM tbl_posts a inner join category b on a.post_cate_id = b.cate_id WHERE a.post_id=".$post_id;
    //echo $get_post;
    //echo $link;

    $res_post = mysqli_query($link,$get_post);

    if (mysqli_num_rows($res_post)>0) {
        while ($row_post=mysqli_fetch_array($res_post)) {
            //echo $row_img["img_name"];
            //$img_name = explode(".",$row_img["img_name"]);
            //echo $img_name[1];
            //$pro_img = $row_img["img_id"].".".$img_name[1];
            $post_name = $row_post["post_name"];
            $post_desc = $row_post["post_desc"];
            $post_owner = $row_post["post_owner"];
            $post_date = $row_post["post_date"];
            $cate_name = $row_post["cate_name"];
				$post_cate_id = $row_post["post_cate_id"];
        }

    }

?>
    <div id="content_navigate">
        <span>Home</span>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;
        <span><a href="category.php?cate_id=<?php echo $post_cate_id; ?>"><?php echo $cate_name; ?></a></span>
    </div>
    <div class="article">

        <h2><?php echo $post_name; ?></h2>
        <div class="post_detail">
            <i class="fa fa-pencil-square"></i>&nbsp;ผู้เขียน : <span class="txt1"><?php echo $post_owner ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar"></i>&nbsp;เขียนเมื่อ : <span class="txt1"><?php echo DateThai($post_date); ?></span>
        </div>
        <div class="article_desc">
            <?php echo htmlspecialchars_decode(str_replace("../","",$post_desc)); ?>
        </div>
		<?php
		// ค้นหาไฟล์เอกสาร
		$get_doc = "select * FROM tbl_group_doc a inner join tbl_file_doc b on a.fd_id=b.fd_id WHERE a.post_id=".$post_id." order by gd_id asc";
		//echo $get_post;
		//echo $link;

		$res_doc = mysqli_query($link,$get_doc);

		if (mysqli_num_rows($res_doc)>0) {
			echo "<div>";
				echo "<span>เอกสารแนบ :</span><br>";
				echo "<ul>";
				while ($row_doc=mysqli_fetch_array($res_doc)) {
					echo "<li><a href='admin/files/".$row_doc["folder_name"]."/".$row_doc["file_name"]."' target='_blank' >".$row_doc["full_name"]."</a></li>";
				}
				echo "</ul>";
			echo "</div>";
		}

		if (isset($_SESSION["valid_user"])) {

		 ?>
		 <form class="form-horizontal" role="form" id="frmadd" method="POST" >
			 <div class="post_comment col-md-12 col-sm-12 col-xs-12" >
				 <h4>แสดงความคิดเห็น</h4>
				 <div class="row">
					 <div class="col-md-3 col-sm-3 col-xs-3" style="text-align:right" >
						 <span>ความเห็น : </span>
					 </div>
					 <div class="col-md-9 col-sm-9 col-xs-9" >
						 <textarea name="txt_comment" id="txt_comment" rows="3" cols="50" class="form-control"></textarea>
					 </div>
				</div>
				<div class="row" style="margin-top:10px;">
				   <div class="col-md-3 col-sm-3 col-xs-3" style="text-align:right" >
						<span>ชื่อ : </span>
				   </div>
				   <div class="col-md-9 col-sm-9 col-xs-9" >
						<input type="text" name="txt_name_cm" value="<?php echo $_SESSION["user_fullname"]; ?>" class="form-control" readonly />
						<input type="hidden" name="txt_empn" value="<?php echo $_SESSION["empn"]; ?>" class="form-control" />
						<input type="hidden" name="txt_post_id" value="<?php echo $post_id; ?>" class="form-control" />
				   </div>
			  </div>
			  <div class="row" style="margin-top:10px;">
				  <div class="col-md-3 col-sm-3 col-xs-3" style="text-align:right" >
					  <span></span>
				  </div>
				  <div class="col-md-9 col-sm-9 col-xs-9" >
					  <button type="button" name="btn_submit_cm" id="btn_submit_cm" class="btn btn-primary">ส่ง</button>
				  </div>
			 </div>
			 </div>
		 </form>
		<?php
		}
		?>
		<div id="result_add_member">
		</div>
		 <div class="fb-comments" data-href="http://localhost/new/newone/post.php?p=<?php echo	$post_id; ?>" data-numposts="5"></div>
    </div>
		</div>
	</div>




<?php include "template_bot.php"; ?>

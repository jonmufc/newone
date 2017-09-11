<?php
//header('Content-Type: text/plain');
error_reporting(E_ALL);
ini_set('display_errors', 1);
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

//print_r($_POST);
//return false;

if (isset($_POST)) {
	
	if ($_POST["type"]=="add") {
	
		//print_r($_POST);
		//print_r($_FILES);
		
		// Count # of uploaded files in array
		$total = count($_FILES['fileUpload']['name']);
		
		//echo $_FILES['fileUpload']['name'][0];
		//echo $total;
		$get_group = "select * from product_image order by img_id desc limit 1";
		$res_group = mysqli_query($link,$get_group);
		if (mysqli_num_rows($res_group) > 0) {
			while ($row = mysqli_fetch_array($res_group)) {
				$group_id = $row["img_group_id"]+1;
			}
		} else {
			$group_id = "1";
		}
		// Loop through each file
		for($i=0; $i<$total; $i++) {
			
			
			
			$ins_sql = "insert into product_image (img_group_id,img_name) values (".$group_id.",'".$_FILES['fileUpload']['name'][$i]."')";
			$res_ins = mysqli_query($link,$ins_sql);
			
			$get_img_id = "select * from product_image order by img_id desc limit 1";
			$res_id = mysqli_query($link,$get_img_id);
			while ($row = mysqli_fetch_array($res_id)) {
				$img_id = $row["img_id"];
			}
		  //Get the temp file path
			$tmpFilePath = $_FILES['fileUpload']['tmp_name'][$i];
			$tmpFileName = $_FILES['fileUpload']['name'][$i];
			
			$arr_tfname = explode(".",$tmpFileName);
			$cnt = count($arr_tfname);
			//Make sure we have a filepath
			if ($tmpFilePath != ""){
				//Setup our new file path
				//$newFilePath = "./uploads/" . $_FILES['fileUpload']['name'][$i];
				$newFilePath = "../uploads/" .$img_id.".".$arr_tfname[$cnt-1];

				//Upload the file into the temp dir
				if(move_uploaded_file($tmpFilePath, $newFilePath)) {

				  //Handle other code here
				  $move = "move file complete";

				}
			}
		}
		
		//return false;

		//echo "Good";
		$cate_id = $_POST["cate_id"];
		$pro_name = $_POST["pro_name"];
		$pro_price = $_POST["pro_price"];
		$pro_qty = $_POST["pro_qty"];
		$pro_desc = $_POST["pro_desc"];
		$pro_status = $_POST["rad_status"];
		$sup_id = $_POST["sup_id"];
		
		//date_default_timezone_set('Asia/Bangkok');
		//$cus_date = date("Y-m-d H:i:s");
		
		$sql_find_pro = "select pro_id from product where pro_name='".$pro_name."' limit 1";
		$result = mysqli_query($link,$sql_find_pro);
		
		if (mysqli_num_rows($result) < 1) {
			
			// Get latest ID
			$sql_last_id = "select pro_id from product order by pro_id desc limit 1";
			$res_last_id = mysqli_query($link,$sql_last_id);
			if (mysqli_num_rows($res_last_id) == 0) {
				$pro_ref_code = "P001";
			} else {
				while ($row = mysqli_fetch_array($res_last_id)) {
					$pro_ref_code = $row["pro_id"]+1;
				}
				while (strlen($pro_ref_code) < 3) {
					$pro_ref_code = "0".$pro_ref_code;
				}
				$pro_ref_code = "P".$pro_ref_code;
			}
			//echo $pro_desc."<hr>";
			//echo htmlspecialchars($pro_desc);
			//echo $pro_ref_code;
			$ins_new_pro = "insert into product (pro_ref_code,pro_name,pro_price,pro_desc,pro_status,cate_id,pro_qty,img_group_id,sup_id) ";
			$ins_new_pro .= "values ('".$pro_ref_code."','".$pro_name."',".$pro_price.",'".htmlspecialchars($pro_desc,ENT_QUOTES)."',".$pro_status.",".$cate_id.",".$pro_qty.",'".$group_id."',".$sup_id.")";
			//echo $ins_new_pro;
			
			$res_ins = mysqli_query($link,$ins_new_pro);
			if ($res_ins) {
				
				echo "1|เพิ่มข้อมูลสินค้าในระบบเรียบร้อยแล้ว";
				
			} else {
				echo "0|เกิดข้อผิดพลาด!";
			}
		} else {
			echo "0|มีชื่อสินค้านี้แล้วในระบบ";
		}
	} else if ($_POST["type"]=="upd") {
		
		//print_r($_POST);
		//print_r($_FILES);
		
		$total = count($_FILES['fileUpload']['name']);
		$chk_file_name = $_FILES['fileUpload']['name'][0];
		
		//echo "b".$chk_file_name."a";
		//return false;
		
		if ($chk_file_name != "") {
			//echo $_FILES['fileUpload']['name'][0];
			//echo $total;
			$get_group = "select * from product_image order by img_id desc limit 1";
			$res_group = mysqli_query($link,$get_group);
			if (mysqli_num_rows($res_group) > 0) {
				while ($row = mysqli_fetch_array($res_group)) {
					$group_id = $row["img_group_id"]+1;
				}
			} else {
				$group_id = "1";
			}
			// Loop through each file
			for($i=0; $i<$total; $i++) {
				
				
				
				$ins_sql = "insert into product_image (img_group_id,img_name) values (".$group_id.",'".$_FILES['fileUpload']['name'][$i]."')";
				$res_ins = mysqli_query($link,$ins_sql);
				
				$get_img_id = "select * from product_image order by img_id desc limit 1";
				$res_id = mysqli_query($link,$get_img_id);
				while ($row = mysqli_fetch_array($res_id)) {
					$img_id = $row["img_id"];
				}
			  //Get the temp file path
				$tmpFilePath = $_FILES['fileUpload']['tmp_name'][$i];
				$tmpFileName = $_FILES['fileUpload']['name'][$i];
				
				$arr_tfname = explode(".",$tmpFileName);
				$cnt = count($arr_tfname);
				//Make sure we have a filepath
				if ($tmpFilePath != ""){
					//Setup our new file path
					//$newFilePath = "./uploads/" . $_FILES['fileUpload']['name'][$i];
					$newFilePath = "../uploads/" .$img_id.".".$arr_tfname[$cnt-1];

					//Upload the file into the temp dir
					if(move_uploaded_file($tmpFilePath, $newFilePath)) {

					  //Handle other code here
					  $move = "move file complete";

					}
				}
			}
		}
		
		$pro_id = $_POST["pro_id"];
		$cate_id = $_POST["cate_id"];
		$pro_name = $_POST["pro_name"];
		$pro_price = $_POST["pro_price"];
		$pro_qty = $_POST["pro_qty"];
		$pro_desc = $_POST["pro_desc"];
		$pro_status = $_POST["rad_status"];
		$sup_id = $_POST["sup_id"];
		
		$sql_find_pro = "select pro_id from product where pro_id=".$pro_id." limit 1";
		$result = mysqli_query($link,$sql_find_pro);
		
		if (mysqli_num_rows($result) != 0) {
			
			// Get latest ID
		
			$upd_pro = "update product set pro_name='".$pro_name."',pro_price ='".$pro_price."',pro_desc='".htmlspecialchars($pro_desc,ENT_QUOTES)."',pro_status=".$pro_status;
			if ($chk_file_name != "") {
				$upd_pro .= ",cate_id=".$cate_id.",pro_qty='".$pro_qty."',img_group_id=".$group_id.",sup_id=".$sup_id;
			} else {
				$upd_pro .= ",cate_id=".$cate_id.",pro_qty='".$pro_qty."',sup_id=".$sup_id;
			}
			$upd_pro .= " where pro_id=".$pro_id;
			$res_upd = mysqli_query($link,$upd_pro);
			if ($res_upd) {
				
				echo "1|ปรับปรุงข้อมูลเรียบร้อยแล้ว";
				
			} else {
				echo "0|เกิดข้อผิดพลาด!";
			}
		} else {
			echo "0|ไม่พบสินค้านี้ในระบบ";
		}
		
	} else if ($_POST["type"] == "del") {
		
		$pro_id = $_POST["hid_pro_id"];
	
		$sql_find_pro = "select pro_id from product where pro_id=".$pro_id." limit 1";
		$result = mysqli_query($link,$sql_find_pro);
		
		if (mysqli_num_rows($result) != 0) {
			
			// Get latest ID
		
			$del_pro = "delete from product where pro_id = ".$pro_id;
			$res_del = mysqli_query($link,$del_pro);
			if ($res_del) {
				
				echo "1|ลบข้อมูลเรียบร้อยแล้ว";
				
			} else {
				echo "0|เกิดข้อผิดพลาด!";
			}
		} else {
			echo "0|ไม่พบ สินค้า นี้ในระบบ";
		}
		
	}
}

mysqli_close($link);
?>
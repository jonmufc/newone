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

//print_r($_POST);

if (isset($_POST)) {
	
	if ($_POST["type"]=="add") {
	
		//echo "Good";
		$cus_name = $_POST["cus_name"];
		$cus_address = $_POST["cus_address"];
		$cus_tel = $_POST["cus_tel"];
		$cus_email = $_POST["cus_email"];
		$cus_user = $_POST["cus_user"];
		$cus_pass = $_POST["cus_pass"];
		$cus_status = $_POST["rad_status"];
		
		date_default_timezone_set('Asia/Bangkok');
		$cus_date = date("Y-m-d H:i:s");
		
		$sql_find_cus = "select cus_id from customer where cus_name='".$cus_name."' limit 1";
		$result = mysqli_query($link,$sql_find_cus);
		
		if (mysqli_num_rows($result) < 1) {
			
			// Get latest ID
			$sql_last_id = "select cus_id from customer order by cus_id desc limit 1";
			$res_last_id = mysqli_query($link,$sql_last_id);
			if (mysqli_num_rows($res_last_id) == 0) {
				$cus_ref_code = "CUS001";
			} else {
				while ($row = mysqli_fetch_array($res_last_id)) {
					$cus_ref_code = $row["cus_id"];
				}
				while (strlen($cus_ref_code) < 3) {
					$cus_ref_code = "0".$cus_ref_code;
				}
				$cus_ref_code = "CUS".$cus_ref_code;
			}
		
			$ins_new_cus = "insert into customer (cus_ref_code,cus_name,cus_address,cus_tel,cus_mail,cus_date,cus_user,cus_password,cus_status) ";
			$ins_new_cus .= "values ('".$cus_ref_code."','".$cus_name."','".$cus_address."','".$cus_tel."','".$cus_email."','".$cus_date."','".$cus_user."','".$cus_pass."',".$cus_status.")";
			echo $ins_new_cus;
			$res_ins = mysqli_query($link,$ins_new_cus);
			if ($res_ins) {
				
				echo "1|เพิ่มข้อมูลลูกค้าในระบบเรียบร้อยแล้ว";
				
			} else {
				echo "0|เกิดข้อผิดพลาด!";
			}
		} else {
			echo "0|มีชื่อลูกค้านี้แล้วในระบบ";
		}
	} else if ($_POST["type"]=="upd") {
		
		$cus_name = $_POST["cus_name"];
		$cus_address = $_POST["cus_address"];
		$cus_tel = $_POST["cus_tel"];
		$cus_email = $_POST["cus_email"];
		$cus_user = $_POST["cus_user"];
		$cus_pass = $_POST["cus_pass"];
		$cus_status = $_POST["rad_status"];
		$cus_id = $_POST["hid_cus_id"];
		
		$sql_find_cus = "select cus_id from customer where cus_id=".$cus_id." limit 1";
		$result = mysqli_query($link,$sql_find_cus);
		
		if (mysqli_num_rows($result) != 0) {
			
			// Get latest ID
		
			$upd_cus = "update customer set cus_name='".$cus_name."',cus_address ='".$cus_address."',cus_tel='".$cus_tel."',cus_mail='".$cus_email."'";
			$upd_cus .= ",cus_user='".$cus_user."',cus_password='".$cus_pass."',cus_status=".$cus_status;
			$upd_cus .= " where cus_id=".$cus_id;
			$res_upd = mysqli_query($link,$upd_cus);
			if ($res_upd) {
				
				echo "1|ปรับปรุงข้อมูลเรียบร้อยแล้ว";
				
			} else {
				echo "0|เกิดข้อผิดพลาด!";
			}
		} else {
			echo "0|ไม่พบชื่อลูกค้านี้ในระบบ";
		}
		
	} else if ($_POST["type"] == "del") {
		
		$cus_id = $_POST["hid_cus_id"];
	
		$sql_find_cus = "select cus_id from customer where cus_id=".$cus_id." limit 1";
		$result = mysqli_query($link,$sql_find_cus);
		
		if (mysqli_num_rows($result) != 0) {
			
			// Get latest ID
		
			$del_cus = "delete from customer where cus_id = ".$cus_id;
			$res_del = mysqli_query($link,$del_cus);
			if ($res_del) {
				
				echo "1|ลบข้อมูลเรียบร้อยแล้ว";
				
			} else {
				echo "0|เกิดข้อผิดพลาด!";
			}
		} else {
			echo "0|ไม่พบ ลูกค้า นี้ในระบบ";
		}
		
	}
}

mysqli_close($link);
?>
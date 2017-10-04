<?php

//ob_start();
include_once("dbcon.php");
//session_start();
//require_once('custom/PHPMailer/class.phpmailer.php');

// DB section
//$conn = mysql_connect(SERVER, USR, PWD);
$link = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);
//mysql_select_db(DB, $conn);
mysqli_query($link,"SET character_set_results=utf8");
mysqli_query($link,"SET character_set_client=utf8");
mysqli_query($link,"SET character_set_connection=utf8");

//print_r($_POST);

if (isset($_POST)) {

	if ($_POST["type"]=="add") {

		//print_r($_POST);
		//print_r($_FILES);
		//return false;
		// Count # of uploaded files in array

		//Get the temp file path
		$tmpFilePath = $_FILES['fileUpload']['tmp_name'];
		$tmpFileName = $_FILES['fileUpload']['name'];

		//$arr_tfname = explode(".",$tmpFileName);
		$ext = pathinfo($tmpFileName, PATHINFO_EXTENSION);
		//Make sure we have a filepath

		if ($tmpFilePath != ""){

			$ins_sql = "insert into profile_image (pf_file_name) values ('".$_FILES['fileUpload']['name']."')";
			$res_ins = mysqli_query($link,$ins_sql);
			$img_id = mysqli_insert_id($link);
			//Setup our new file path
			//$newFilePath = "./uploads/" . $_FILES['fileUpload']['name'][$i];
			$new_file = $img_id.".".$ext;
			$newFilePath = "userprofile/" .$new_file;

			//Upload the file into the temp dir
			if(move_uploaded_file($tmpFilePath, $newFilePath)) {

			  //Handle other code here
			  $move = "move file complete";

			}
		}

		//echo "Good";
		$empn = $_POST["empn"];
		$fullname = $_POST["user_fullname"];
		$user_tel = $_POST["user_tel"];
		$user_pass = $_POST["user_pass"];
		$user_dept = $_POST["user_dept"];

		date_default_timezone_set('Asia/Bangkok');
		$record_date = date("Y-m-d H:i:s");

		$sql_find_cus = "select empn from tbl_users where fullname='".$fullname."' limit 1";
		$result = mysqli_query($link,$sql_find_cus);

		if (mysqli_num_rows($result) < 1) {

			$ins_new_cus = "insert into tbl_users (empn,fullname,user_tel,user_password,user_pic,user_dept,record_date) ";
			$ins_new_cus .= "values ('".$empn."','".$fullname."','".$user_tel."','".$user_pass."','".$new_file."','".$user_dept."','".$record_date."')";
			//echo $ins_new_cus;
			$res_ins = mysqli_query($link,$ins_new_cus);
			if ($res_ins) {

				echo "1|เพิ่มข้อมูลผู้ใช้งานในระบบเรียบร้อยแล้ว";

			} else {
				echo "0|เกิดข้อผิดพลาด!";
			}
		} else {
			echo "0|มีชื่อนี้แล้วในระบบ";
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

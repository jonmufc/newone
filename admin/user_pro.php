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
		} else {
			$new_file = "";
		}

		$empn = $_POST["hid_empn"];
		$fullname = $_POST["user_fullname"];
		$user_tel = $_POST["user_tel"];
		$user_pass = $_POST["user_pass"];
		$user_dept = $_POST["user_dept"];

		$sql_find_usr = "select empn from tbl_users where empn='".$empn."' limit 1";
		$result = mysqli_query($link,$sql_find_usr);

		if (mysqli_num_rows($result) != 0) {

			// Get latest ID

			$upd_usr = "update tbl_users set fullname ='".$fullname."',user_tel='".$user_tel."',user_password='".$user_pass."',user_dept='".$user_dept."'";
			if ($new_file != "") {
					$upd_usr .= ",user_pic='".$new_file."' ";
			}
			$upd_usr .= " where empn=".$empn;
			$res_upd = mysqli_query($link,$upd_usr);
			if ($res_upd) {

				echo "1|ปรับปรุงข้อมูลเรียบร้อยแล้ว";

			} else {
				echo "0|เกิดข้อผิดพลาด!";
			}
		} else {
			echo "0|ไม่พบชื่อลูกค้านี้ในระบบ";
		}

	} else if ($_POST["type"] == "del") {

		$empn = $_POST["empn"];

		$sql_find_usr = "select empn from tbl_users where empn='".$empn."' limit 1";
		$result = mysqli_query($link,$sql_find_usr);

		if (mysqli_num_rows($result) != 0) {

			// Get latest ID

			$del_usr = "delete from tbl_users where empn = '".$empn."'";
			$res_del = mysqli_query($link,$del_usr);
			if ($res_del) {

				echo "1|ลบข้อมูลเรียบร้อยแล้ว";

			} else {
				echo "0|เกิดข้อผิดพลาด!";
			}
		} else {
			echo "0|ไม่พบผู้ใช้งานนี้ในระบบ";
		}

	}
}

mysqli_close($link);
?>

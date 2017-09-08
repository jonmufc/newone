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

		//echo "Good";
		$username = $_POST["username"];
		$password = $_POST["password"];

		$sql_find_user = "select ad_id from admin where ad_username='".$username."' limit 1";
		$result = mysqli_query($link,$sql_find_user);

		if (mysqli_num_rows($result) < 1) {

			// Get latest ID
			$sql_last_id = "select ad_id from admin order by ad_id desc limit 1";
			$res_last_id = mysqli_query($link,$sql_last_id);
			if (mysqli_num_rows($res_last_id) == 0) {
				$ad_user_code = "A001";
			} else {
				while ($row = mysqli_fetch_array($res_last_id)) {
					$ad_user_code = $row["ad_id"]+1;
				}
				while (strlen($ad_user_code) < 3) {
					$ad_user_code = "0".$ad_user_code;
				}
				$ad_user_code = "A".$ad_user_code;
			}

			$ins_new_admin = "insert into admin (ad_user_code,ad_username,ad_password) ";
			$ins_new_admin .= "values ('".$ad_user_code."','".$username."','".$password."')";
			$res_ins = mysqli_query($link,$ins_new_admin);
			if ($res_ins) {

				echo "1|เพิ่มผู้ดูแลระบบใหม่เรียบร้อยแล้ว";

			} else {
				echo "0|เกิดข้อผิดพลาด!";
			}
		} else {
			echo "0|มี username นี้แล้วในระบบ";
		}
	} else if ($_POST["type"]=="upd") {

		$username = $_POST["username"];
		$password = $_POST["password"];
		$ad_id = $_POST["hid_ad_id"];

		$sql_find_user = "select ad_id from admin where ad_id=".$ad_id." limit 1";
		$result = mysqli_query($link,$sql_find_user);

		if (mysqli_num_rows($result) != 0) {

			// Get latest ID

			$upd_admin = "update admin set ad_username='".$username."',ad_password ='".$password."'";
			$upd_admin .= " where ad_id=".$ad_id;
			$res_upd = mysqli_query($link,$upd_admin);
			if ($res_upd) {

				echo "1|ปรับปรุงข้อมูลเรียบร้อยแล้ว";

			} else {
				echo "0|เกิดข้อผิดพลาด!";
			}
		} else {
			echo "0|ไม่พบ username นี้ในระบบ";
		}

	} else if ($_POST["type"] == "del") {

		$ad_id = $_POST["hid_ad_id"];

		$sql_find_user = "select ad_id from admin where ad_id=".$ad_id." limit 1";
		$result = mysqli_query($link,$sql_find_user);

		if (mysqli_num_rows($result) != 0) {

			// Get latest ID

			$del_admin = "delete from admin where ad_id = ".$ad_id;
			$res_del = mysqli_query($link,$del_admin);
			if ($res_del) {

				echo "1|ลบข้อมูลเรียบร้อยแล้ว";

			} else {
				echo "0|เกิดข้อผิดพลาด!";
			}
		} else {
			echo "0|ไม่พบ username นี้ในระบบ";
		}

	}
}

mysqli_close($link);
?>

<?php

//ob_start();
include_once("dbcon.php");
//session_start();
//require_once('custom/PHPMailer/class.phpmailer.php');

// DB section
//$conn = mysql_connect(SERVER, USR, PWD);
$conn = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);

//mysql_select_db(DB, $conn);
mysqli_query($conn,"SET character_set_results=utf8");
mysqli_query($conn,"SET character_set_client=utf8");
mysqli_query($conn,"SET character_set_connection=utf8");

//print_r($_POST);

if (isset($_POST)) {

	if ($_POST["type"]=="add") {

		//echo "Good";
		$category = $_POST["category"];
		$cate_status = $_POST["rad_status"];
		$prim_cate_id = $_POST["prim_cate_id"];

		$sql_find_cate = "select cate_id from category where cate_name='".$category."' limit 1";
		$result = mysqli_query($conn,$sql_find_cate);

		if (mysqli_num_rows($result) < 1) {

			// Get latest ID
			$sql_last_id = "select cate_id from category order by cate_id desc limit 1";
			$res_last_id = mysqli_query($conn,$sql_last_id);
			if (mysqli_num_rows($res_last_id) == 0) {
				$cate_ref_code = "C001";
			} else {
				while ($row = mysqli_fetch_array($res_last_id)) {
					$cate_ref_code = $row["cate_id"]+1;
				}
				while (strlen($cate_ref_code) < 3) {
					$cate_ref_code = "0".$cate_ref_code;
				}
				$cate_ref_code = "C".$cate_ref_code;
			}

			if ($prim_cate_id == "0") {
				$ins_new_cate = "insert into category (cate_ref_code,cate_name,cate_status,prim_cate_id) ";
				$ins_new_cate .= "values ('".$cate_ref_code."','".$category."','".$cate_status."',0)";
			} else {
				$ins_new_cate = "insert into category (cate_ref_code,cate_name,cate_status,prim_cate_id) ";
				$ins_new_cate .= "values ('".$cate_ref_code."','".$category."','".$cate_status."',".$prim_cate_id.")";
			}

			$res_ins = mysqli_query($conn,$ins_new_cate);
			if ($res_ins) {

				echo "1|เพิ่มหมวดหมู่บทความใหม่เรียบร้อยแล้ว";

			} else {
				echo "0|เกิดข้อผิดพลาด!";
			}
		} else {
			echo "0|มีหมวดหมู่บทความนี้แล้วในระบบ";
		}
	} else if ($_POST["type"]=="upd") {

		$cate_name = $_POST["category"];
		$cate_status = $_POST["rad_status"];
		$cate_id = $_POST["hid_cate_id"];
		$prim_cate_id = $_POST["prim_cate_id"];

		$sql_find_cate = "select cate_id from category where cate_id=".$cate_id." limit 1";
		$result = mysqli_query($conn,$sql_find_cate);

		if (mysqli_num_rows($result) != 0) {

			// Get latest ID

			$upd_cate = "update category set cate_name='".$cate_name."',cate_status ='".$cate_status."',prim_cate_id=".$prim_cate_id;
			$upd_cate .= " where cate_id=".$cate_id;
			$res_upd = mysqli_query($conn,$upd_cate);
			if ($res_upd) {

				echo "1|ปรับปรุงข้อมูลเรียบร้อยแล้ว";

			} else {
				echo "0|เกิดข้อผิดพลาด!";
			}
		} else {
			echo "0|ไม่พบหมวดหมู่บทความนี้ในระบบ";
		}

	} else if ($_POST["type"] == "del") {

		$cate_id = $_POST["hid_cate_id"];

		$sql_find_cate = "select cate_id from category where cate_id=".$cate_id." limit 1";
		$result = mysqli_query($conn,$sql_find_cate);

		if (mysqli_num_rows($result) != 0) {

			// Get latest ID

			$del_cate = "delete from category where cate_id = ".$cate_id;
			$res_del = mysqli_query($conn,$del_cate);
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

mysqli_close($conn);
?>

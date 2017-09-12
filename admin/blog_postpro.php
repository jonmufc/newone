<?php
//header('Content-Type: text/plain');
error_reporting(E_ALL);
ini_set('display_errors', 1);
//ob_start();
include_once("dbcon.php");
//session_start();
//require_once('custom/PHPMailer/class.phpmailer.php');

// DB section
//$conn = mysql_connect(SERVER, USR, PWD);
$link = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);
//echo mysql_errno($link) . ": " . mysql_error($link) . "\n";
//echo $link;

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

		// ข้อมูลเข้า Table tbl_posts *********************************

		//echo "Good";
		$cate_id = $_POST["cate_id"];
		$post_name = $_POST["post_name"];
		$post_owner = $_POST["post_owner"];
		$post_desc = $_POST["post_desc"];
		$rad_status = $_POST["rad_status"];
		$sel_file_doc1 = $_POST["sel_file_doc1"];

		date_default_timezone_set('Asia/Bangkok');
		$save_date = date("Y-m-d H:i:s");

		//$sql_find_pro = "select post_id from tbl_posts where pro_name='".$pro_name."' limit 1";
		//$result = mysqli_query($link,$sql_find_pro);

		//if (mysqli_num_rows($result) < 1) {

			//echo $pro_desc."<hr>";
			//echo htmlspecialchars($pro_desc);
			//echo $pro_ref_code;
			$ins_new_pro = "insert into tbl_posts (post_name,post_desc,post_owner,post_date,post_cate_id,post_status) ";
			$ins_new_pro .= "values ('".$post_name."','".htmlspecialchars($post_desc,ENT_QUOTES)."','".$post_owner."','".$save_date."',".$cate_id.",".$rad_status.")";
			//echo $ins_new_pro;

			$res_ins = mysqli_query($link,$ins_new_pro);
			//echo mysql_errno($link) . ": " . mysql_error($link) . "\n";

			if ($res_ins) {

				// เพิ่มไฟล์ Documents *********************************
				if ($sel_file_doc1 != "") {

					$last_id = mysqli_insert_id($link);

					$pos = strpos($sel_file_doc1, ",");

					// Note our use of ===.  Simply == would not work as expected
					// because the position of 'a' was the 0th (first) character.
					if ($pos === false) {
						 $arr_file[0] = $sel_file_doc1;
					} else {
					    $arr_file = explode(",",$sel_file_doc1);
					}

					$cnt_arr = count($arr_file);
					for ($i=0; $i < $cnt_arr ; $i++) {

						$ins_sql = "insert into tbl_group_doc (post_id,fd_id) values (".$last_id.",'".$arr_file[$i]."')";
						$res_ins = mysqli_query($link,$ins_sql);

					}

				}

				echo "1|เพิ่มข้อมูลบทความในระบบเรียบร้อยแล้ว";

			} else {
				echo "0|เกิดข้อผิดพลาด!";
			}
		/*} else {
			echo "0|มีชื่อสินค้านี้แล้วในระบบ";
		}*/

		//return false;

	} else if ($_POST["type"]=="upd") {

		$post_id = $_POST["post_id"];
		$cate_id = $_POST["cate_id"];
		$post_name = $_POST["post_name"];
		$post_owner = $_POST["post_owner"];
		$post_desc = $_POST["post_desc"];
		$rad_status = $_POST["rad_status"];
		$sel_file_doc1 = $_POST["sel_file_doc1"];

		date_default_timezone_set('Asia/Bangkok');
		$update_date = date("Y-m-d H:i:s");

		$sql_find_post = "select post_id from tbl_posts where post_id=".$post_id." limit 1";
		$result = mysqli_query($link,$sql_find_post);

		if (mysqli_num_rows($result) != 0) {

			// Get latest ID

			$upd_pro = "update tbl_posts set post_name='".$post_name."',post_owner ='".$post_owner."',post_desc='".htmlspecialchars($post_desc,ENT_QUOTES)."',post_status=".$rad_status;
			$upd_pro .= ",post_cate_id=".$cate_id.",post_update_date='".$update_date."'";
			$upd_pro .= " where post_id=".$post_id;

			$res_upd = mysqli_query($link,$upd_pro);
			if ($res_upd) {

				// แก้ไฟล์ Documents *********************************
				$get_sql2 = "select * from tbl_group_doc where post_id = ".$post_id;
				$result2 = mysqli_query($link,$get_sql2);
				$sel_file = "";
				if (mysqli_num_rows($result2) > 0) {

					while ($row2 = mysqli_fetch_array($result2)){
						$sel_file = $sel_file . "," .$row2["fd_id"];
					}
					$sel_file = substr($sel_file,1);
				}
				if ( $sel_file_doc1 != $sel_file) {

					$del_sql = "delete from tbl_group_doc where post_id=".$post_id;
					$res_del = mysqli_query($link,$del_sql);

					if ($res_del) {

						if ($sel_file_doc1 === NULL) {
							$nothing = "1";
						} else {
							$pos = strpos($sel_file_doc1, ",");

							// Note our use of ===.  Simply == would not work as expected
							// because the position of 'a' was the 0th (first) character.
							if ($pos === false) {
								 $arr_file[0] = $sel_file_doc1;
							} else {
								 $arr_file = explode(",",$sel_file_doc1);
							}

							$cnt_arr = count($arr_file);
							for ($i=0; $i < $cnt_arr ; $i++) {

								$ins_sql = "insert into tbl_group_doc (post_id,fd_id) values (".$post_id.",'".$arr_file[$i]."')";
								$res_ins = mysqli_query($link,$ins_sql);

							}
						}

					}
				}

				echo "1|ปรับปรุงข้อมูลเรียบร้อยแล้ว";

			} else {
				echo "0|เกิดข้อผิดพลาด!";
			}
		} else {
			echo "0|ไม่พบบทความนี้ในระบบ";
		}

	} else if ($_POST["type"] == "del") {

		$post_id = $_POST["hid_post_id"];

		$sql_find_post = "select post_id from tbl_posts where post_id=".$post_id." limit 1";
		$result = mysqli_query($link,$sql_find_post);

		if (mysqli_num_rows($result) != 0) {

			// Get latest ID

			$del_post = "update tbl_posts set post_status = 0 where post_id = ".$post_id;
			$res_del = mysqli_query($link,$del_post);

			if ($res_del) {

				echo "1|ลบข้อมูลเรียบร้อยแล้ว";

			} else {
				echo "0|เกิดข้อผิดพลาด!";
			}
		} else {
			echo "0|ไม่พบบทความนี้ในระบบ";
		}

	}
}

mysqli_close($link);
?>

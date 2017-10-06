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
//return false;

if (isset($_POST)) {

		//echo "Good";
		$post_id = $_POST["txt_post_id"];
		$txt_comment = $_POST["txt_comment"];
		$empn = $_POST["txt_empn"];

		date_default_timezone_set('Asia/Bangkok');
		$record_date = date("Y-m-d H:i:s");

		$ins_comments = "insert into tbl_comments (post_id,txt_comments,empn,record_date) ";
		$ins_comments .= "values (".$post_id.",'".$txt_comment."','".$empn."','".$record_date."')";
		//echo $ins_new_cus;
		$res_ins = mysqli_query($link,$ins_comments);
		if ($res_ins) {

			echo "1";

		} else {
			echo "0";
		}

}

mysqli_close($link);
?>

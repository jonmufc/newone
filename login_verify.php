<?php
	ob_start();
	include_once("dbcon.php");
	session_start();
?>
<?php

	$link = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);
	//mysql_select_db(DB, $conn);
	mysqli_query($link,"SET character_set_results=utf8");
	mysqli_query($link,"SET character_set_client=utf8");
	mysqli_query($link,"SET character_set_connection=utf8");

	//if (!isset($_SESSION['valid_user'])) {
	//print_r($_POST);

		if (isset($_POST["fb"])) {

			$user_pic = $_POST["user_pic"];
			$fullname = $_POST["fullname"];
			$empn = $_POST["empn"];

			$sql_find = "select empn from tbl_users where empn='".$empn."' and fb_name is null limit 1";
			//echo $sql_find_pwd;
			$result = mysqli_query($link,$sql_find);

			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_array($result)) {
					$sql_upd = "update tbl_users set fb_name='".$fullname."',fb_pro_img='".$user_pic."' where empn='".$empn."'";
					$re_upd = mysqli_query($link,$sql_upd);
				}
			}

				echo "1"; // 1 คือ login ผ่าน สามารถเข้าสู่ระบบได้
				$_SESSION['valid_user'] = "1";
				$_SESSION['empn'] = $empn;
				$_SESSION['user_fullname'] = $fullname;
				$_SESSION['user_pic'] = $user_pic;
				$_SESSION['fb'] = "1";
				//print_r($_SESSION);

		} else {

			if ((isset($_POST["input_usr"])) and (isset($_POST["input_pwd"]))) {
				//echo "Good";
				$empn = $_POST["input_usr"];
				$u_pass = $_POST["input_pwd"];

				$sql_find_pwd = "select user_password,fullname,user_pic from tbl_users where empn='".$empn."' limit 1";
				//echo $sql_find_pwd;
				$result = mysqli_query($link,$sql_find_pwd);

				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_array($result)) {
						$password = $row["user_password"];
						//$user_type = $row["user_type"];
						$user_fullname = $row["fullname"];
						$user_pic = $row["user_pic"];
					}
					if ($u_pass == $password) {
						echo "1"; // 1 คือ login ผ่าน สามารถเข้าสู่ระบบได้
						$_SESSION['valid_user'] = "1";
						//$_SESSION['show_menu'] = "1";
						//$_SESSION['user_type'] = $user_type;
						$_SESSION['empn'] = $empn;
						$_SESSION['user_fullname'] = $user_fullname;
						$_SESSION['user_pic'] = $user_pic;
						//print_r($_SESSION);
					} else {
						echo "0";
						//echo "password ไม่ถูกต้อง";
					}
				} else {
					echo "0";
					//echo "ไม่พบข้อมูล username และ password ในระบบ<br>";
					//echo "หรือคุณยังไม่ได้รับการอนุมัติเพื่อเข้าใช้ระบบ";
				}
			} else {
				echo "0";
				//echo "ไม่พบข้อมูล username และ password";
			}
		}
	//}

	mysqli_close($link);
?>

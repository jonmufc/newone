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

	if (isset($_POST["fb"])) {

		$u_mail = $_POST["email"];
		$sql_find_user = "select ad_mail from admin where ad_mail='".$u_mail."' limit 1";
		//echo $sql_find_pwd;
		$result = mysqli_query($link,$sql_find_user);

		if (mysqli_num_rows($result) > 0) {
			echo "1"; // 1 คือ login ผ่าน สามารถเข้าสู่ระบบได้
			$_SESSION['valid_admin'] = "1";
			//$_SESSION['show_menu'] = "1";
			//$_SESSION['user_type'] = $user_type;
			$_SESSION['ad_username'] = $ad_username;
			$_SESSION['fb_login'] = "1";
		} else {
			echo "0";
		}

	} else {

		if ((isset($_POST["u"])) and (isset($_POST["p"]))) {
			//echo "Good";
			$username = $_POST["u"];
			$u_pass = $_POST["p"];

			$sql_find_pwd = "select ad_password,ad_username from admin where ad_username='".$username."' limit 1";
			//echo $sql_find_pwd;
			$result = mysqli_query($link,$sql_find_pwd);

			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_array($result)) {
					$password = $row["ad_password"];
					//$user_type = $row["user_type"];
					$ad_username = $row["ad_username"];
				}
				if ($u_pass == $password) {
					echo "1"; // 1 คือ login ผ่าน สามารถเข้าสู่ระบบได้
					$_SESSION['valid_admin'] = "1";
					//$_SESSION['show_menu'] = "1";
					//$_SESSION['user_type'] = $user_type;
					$_SESSION['ad_username'] = $ad_username;
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

	mysqli_close($link);
?>

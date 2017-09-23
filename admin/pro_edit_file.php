<?php


require_once "dbcon.php";
//echo DBSERVER;
//return false;
//$con = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);

//$conn = new mysqli(DBSERVER,DBUSR,DBPWD,DBNAME);

$link = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);
//mysql_select_db(DB, $conn);
mysqli_query($link,"SET character_set_results=utf8");
mysqli_query($link,"SET character_set_client=utf8");
mysqli_query($link,"SET character_set_connection=utf8");

$fd_id = $_POST["hid_file_id"];
$full_name = $_POST["full_name"];

//echo $fd_id." ".$full_name;

     $sql = "update tbl_file_doc set full_name= '".$full_name."' where fd_id = ".$fd_id;

     //echo $sql;

     $res_sql = mysqli_query($link,$sql);

     echo "1";


     mysqli_close($link);

  ?>

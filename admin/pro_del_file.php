<?php


require_once "dbcon.php";
//echo DBSERVER;
//return false;
//$con = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);

$link = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);
//mysql_select_db(DB, $conn);
mysqli_query($link,"SET character_set_results=utf8");
mysqli_query($link,"SET character_set_client=utf8");
mysqli_query($link,"SET character_set_connection=utf8");

$fd_id = $_POST["hid_file_id"];
$file_name = $_POST["hid_file_name"];
$folder_name = $_POST["hid_folder_name"];

//echo $fd_id." ".$full_name;

     $sql = "delete from tbl_file_doc where fd_id = ".$fd_id;
     $res_sql = mysqli_query($link,$sql);

     if ($res_sql) {

       $flgDelete = unlink("files/".$folder_name."/".$file_name);
       if ($flgDelete) {
         rmdir("files/".$folder_name);
       }

     }
     
     echo "1";


  mysqli_close($link);

  ?>

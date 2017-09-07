<?php


require_once "dbcon.php";
//echo DBSERVER;
//return false;
//$con = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);

$conn = new mysqli(DBSERVER,DBUSR,DBPWD,DBNAME);

$fd_id = $_POST["hid_file_id"];
$full_name = $_POST["full_name"];

//echo $fd_id." ".$full_name;

     $sql = "update tbl_file_doc set full_name= ? where fd_id = ?";
     $stmt = $conn->prepare($sql);

     $stmt->bind_param('si', $full_name, $fd_id); //   s - string, b - blob, i - int, etc

     /*** for 2 Parameters
       $strCustomerID = "C001";
       $strEmail = "win.weerachai@thaicreate.com";
       $sql = "SELECT * FROM customer WHERE CustomerID = ? AND Email = ? ";
       $stmt = $conn->prepare($sql);
       $stmt->bind_param('ss', $strCustomerID,$strEmail); //   s - string, b - blob, i - int, etc
     **/

     $stmt ->execute();

     $result = $stmt->get_result();

     $aff_rows = $stmt->affected_rows;
     if ($aff_rows > 0) {
       echo "1";
     } else {
       echo "0";
     }


  $conn->close();

  ?>

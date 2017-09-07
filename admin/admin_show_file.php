<?php

require_once "dbcon.php";
//echo DBSERVER;
//return false;
//$con = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);

$conn = new mysqli(DBSERVER,DBUSR,DBPWD,DBNAME);

?>

<table class="table table-striped">
  <thead>
    <tr>
      <th>File ID</th>
      <th>File Name</th>
      <th>File Subject</th>
      <th>View</th>
      <th>Edit</th>
    </tr>
  </thead>
  <tbody>
  <?php

      $sql = "select * from tbl_file_doc order by fd_id desc";
      $stmt = $conn->prepare($sql);

      //$stmt->bind_param('s', $strCustomerID); //   s - string, b - blob, i - int, etc

      /*** for 2 Parameters
        $strCustomerID = "C001";
        $strEmail = "win.weerachai@thaicreate.com";
        $sql = "SELECT * FROM customer WHERE CustomerID = ? AND Email = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $strCustomerID,$strEmail); //   s - string, b - blob, i - int, etc
      **/

      $stmt ->execute();

      $result = $stmt->get_result();
      while ($row = $result->fetch_assoc())
      {
        echo "<tr>";
        echo "<td>".$row["fd_id"]."</td>";
        echo "<td>".$row["file_name"]."</td>";
        echo "<td>".$row["full_name"]."</td>";
        echo "<td><a href='files/".$row["folder_name"]."/".$row["file_name"]."' target='_blank' ><img src='images/search.png' /></a></td>";
        echo "<td><a href='admin_edit_file.php?fd_id=".$row["fd_id"]."' ><img src='images/edit.png' /></a></td>";
        echo "</tr>";
      }


   ?>
 </tbody>
</table>
<?php
  $conn->close();
?>

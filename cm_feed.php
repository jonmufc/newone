<style type="text/css" >
.cm_zone {
   padding: 15px;
   margin-top: 10px;
   background-color: #f3f2f0;
   border-radius: 10px;
}
</style>
<?php

include_once("dbcon.php");
//session_start();
//require_once('custom/PHPMailer/class.phpmailer.php');

function DateThai($strDate)
{
   $strYear = date("Y",strtotime($strDate))+543;
   $strMonth= date("n",strtotime($strDate));
   $strDay= date("j",strtotime($strDate));
   $strHour= date("H",strtotime($strDate));
   $strMinute= date("i",strtotime($strDate));
   $strSeconds= date("s",strtotime($strDate));
   $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
   $strMonthThai=$strMonthCut[$strMonth];
   return "$strDay $strMonthThai $strYear"." เวลา ".$strHour.":".$strMinute.":".$strSeconds." น.";
}

// DB section
//$conn = mysql_connect(SERVER, USR, PWD);
$link = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);
//mysql_select_db(DB, $conn);
mysqli_query($link,"SET character_set_results=utf8");
mysqli_query($link,"SET character_set_client=utf8");
mysqli_query($link,"SET character_set_connection=utf8");

$post_id = $_POST["post_id"];

$get_sql = "SELECT c.*,u.fullname,u.user_pic,u.fb_pro_img FROM tbl_comments c INNER JOIN tbl_users u ON c.empn = u.empn WHERE post_id={$post_id} ORDER BY cm_id asc";

//echo $get_sql;
$no = "1";
$result = mysqli_query($link,$get_sql);
if (mysqli_num_rows($result) > 0) {
   while ($row=mysqli_fetch_array($result)) {
      ?>
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12 cm_zone">
            <div class="x_panel">
               <div class="x_title">
                  <h4>ความคิดเห็นที่ <?php echo $no; ?></h4>

                  <div class="clearfix"></div>
               </div>
               <div class="x_content" style="height:40px;">

                  <?php echo $row["txt_comments"]; ?>

               </div>
               <div class="x_content">
                  <span><b>โดย : </b></span>
                  <img src="admin/userprofile/<?php echo $row["user_pic"]; ?>" alt="" style="vertical-align:middle" class="img-circle profile_img2" />
                  <?php echo $row["fullname"] ?>
                  <span><b>เขียนเมื่อ : </b></span>
                  <?php echo DateThai($row["record_date"]); ?>
               </div>
            </div>

         </div>
      </div>
      <?php
      $no = $no + 1;
   }
}

?>

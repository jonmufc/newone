<?php
include "template_head.php";

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

?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>จัดการไฟล์เอกสาร</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>แก้ไขไฟล์</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <?php

                    if (isset($_GET["fd_id"])) {

                        $file_id = $_GET["fd_id"];

                        $sql = "select * from tbl_file_doc where fd_id = ".$file_id." order by fd_id desc";
                        $res_sql = mysqli_query($link,$sql);
                        //$stmt = $conn->prepare($sql);

                        //$stmt->bind_param('i', $file_id); //   s - string, b - blob, i - int, etc

                        /*** for 2 Parameters
                          $strCustomerID = "C001";
                          $strEmail = "win.weerachai@thaicreate.com";
                          $sql = "SELECT * FROM customer WHERE CustomerID = ? AND Email = ? ";
                          $stmt = $conn->prepare($sql);
                          $stmt->bind_param('ss', $strCustomerID,$strEmail); //   s - string, b - blob, i - int, etc
                        **/
                        if (mysqli_num_rows($res_sql) > 0)
                        {
                            while ($row = mysqli_fetch_array($res_sql)) {

                            $file_name = $row["file_name"];
                            $full_name = $row["full_name"];
                            $folder_name = $row["folder_name"];

                            }
                        }


                     ?>

                     <script type="text/javascript">
                      $(document).ready(function(){
                        $("#btn_submit").click(function(){
                            //alert("xxxx");

                            var post_data = $("#frm1").serialize();
                            //alert(post_data);
                            $.ajax({
                    				   type: "POST",
                    				   url: "pro_edit_file.php",
                    				   data: post_data,
                    				   success: function(msg){
                    					        //alert( "Data Call : " + msg);
                    					        //$("p").append(msg);
                                      //alert(msg);
                                      if (msg == "1") {
                                        //alert("ปรับปรุงข้อมูลเรียบร้อยแล้ว");
                                        //$( "#dialog-message" ).dialog();
                                        $( "#dialog-confirm" ).dialog({
                                          resizable: false,
                                          height: "auto",
                                          width: 400,
                                          modal: true,
                                          buttons: {
                                            "OK": function() {
                                              $( this ).dialog( "close" );

                                              window.location = "admin_upfile.php";
                                            }
                                            /*Cancel: function() {
                                              $( this ).dialog( "close" );
                                            }*/
                                          }
                                        });
                                      } else {
                                        alert("เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ");
                                      }
                    				   }
                    				 });

                        });

                        $("#btn_delete").click(function(){

                          $( "#di-firm-del" ).dialog({
                            resizable: false,
                            height: "auto",
                            width: 400,
                            modal: true,
                            buttons: {
                              "ลบ": function() {


                                //$( this ).dialog( "close" );
                                var post_data = $("#frm1").serialize();
                                //alert(post_data);
                                $.ajax({
                                   type: "POST",
                                   url: "pro_del_file.php",
                                   data: post_data,
                                   success: function(msg){
                                          //alert( "Data Call : " + msg);
                                          //$("p").append(msg);
                                          if (msg == "1") {
                                            alert("ลบไฟล์เรียบร้อยแล้ว");
                                            window.location = "admin_upfile.php";
                                          } else {
                                            alert("เกิดข้อผิดพลาดกรุณาติดต่อผู้ดูแลระบบ");
                                          }
                                   }
                                 });
                                 $( this ).dialog( "close" );
                              },
                              "ยกเลิก": function() {
                                $( this ).dialog( "close" );
                              }
                            }
                          });

                        });

                        $("#btn_back").click(function(){
                          window.location = "admin_upfile.php";
                        });

                      });
                     </script>

                     <div id="dialog-confirm" title="System Message" style="display:none">
                        <p>ปรับปรุงข้อมูลเรียบร้อยแล้ว</p>
                      </div>

                      <div id="di-firm-del" title="ลบไฟล์?">
                        <p>คุณแน่ใจที่จะลบไฟล์นี้?</p>
                      </div>

                    <form id="frm1">
                      <div class="form-group">
                        <label for="file_id">File ID : </label>
                        <input type="textbox" class="form-control" id="file_id" name="file_id" value="<?php echo $file_id; ?>" disabled>
                        <input type="hidden" class="form-control" id="hid_file_id" name="hid_file_id" value="<?php echo $file_id; ?>">
                        <input type="hidden" class="form-control" id="hid_file_name" name="hid_file_name" value="<?php echo $file_name; ?>">
                        <input type="hidden" class="form-control" id="hid_folder_name" name="hid_folder_name" value="<?php echo $folder_name; ?>">
                      </div>
                      <div class="form-group">
                        <label for="file_name">File Name : </label>
                        <input type="textbox" class="form-control" id="file_name" name="file_name" value="<?php echo $file_name; ?>" disabled>
                      </div>
                      <div class="form-group">
                        <label for="full_name">File Subject :</label>
                        <input type="textbox" class="form-control" id="full_name" name="full_name" value="<?php echo $full_name; ?>">
                      </div>

                      <button type="button" class="btn btn-default" id="btn_submit">Submit</button>
                      <button type="button" class="btn btn-default" id="btn_delete">Delete File</button>
                      <button type="button" class="btn btn-default" id="btn_back">ย้อนกลับ</button>
                    </form>

                    <?php
                  } else {
                    echo "No Data";
                  }
                     ?>
                  </div>


                </div>

              </div>
            </div>



          </div>
        </div>
        <!-- /page content -->

<?php
  //$conn->close();
  mysql_close($link);
  include "template_bottom.php";
?>

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
                    <h2>เพิ่มไฟล์ใหม่</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                  <div id="upload_zone">
                      <!-- jQuery
                      ====================================================================== -->
                      <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> -->

                      <!-- Fine Uploader New/Modern CSS file
                      ====================================================================== -->
                      <link href="../lib/fine-uploader/fine-uploader-new.css" rel="stylesheet">

                      <!-- Fine Uploader jQuery JS file
                      ====================================================================== -->
                      <script src="../lib/fine-uploader/jquery.fine-uploader.js"></script>

                      <!-- Fine Uploader Thumbnails template w/ customization
                      ====================================================================== -->
                      <script type="text/template" id="qq-template-manual-trigger">
                          <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Drop files here">
                              <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                                  <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
                              </div>
                              <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                                  <span class="qq-upload-drop-area-text-selector"></span>
                              </div>
                              <div class="buttons">
                                  <div class="qq-upload-button-selector qq-upload-button">
                                      <div>Select files</div>
                                  </div>
                                  <button type="button" id="trigger-upload" class="btn btn-primary">
                                      <i class="icon-upload icon-white"></i> Upload
                                  </button>
                              </div>
                              <span class="qq-drop-processing-selector qq-drop-processing">
                                  <span>Processing dropped files...</span>
                                  <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
                              </span>
                              <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
                                  <li>
                                      <div class="qq-progress-bar-container-selector">
                                          <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                                      </div>
                                      <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                                      <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
                                      <span class="qq-upload-file-selector qq-upload-file"></span>
                                      <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
                                      <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                                      <span class="qq-upload-size-selector qq-upload-size"></span>
                                      <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Cancel</button>
                                      <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Retry</button>
                                      <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">Delete</button>
                                      <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                                  </li>
                              </ul>

                              <dialog class="qq-alert-dialog-selector">
                                  <div class="qq-dialog-message-selector"></div>
                                  <div class="qq-dialog-buttons">
                                      <button type="button" class="qq-cancel-button-selector">Close</button>
                                  </div>
                              </dialog>

                              <dialog class="qq-confirm-dialog-selector">
                                  <div class="qq-dialog-message-selector"></div>
                                  <div class="qq-dialog-buttons">
                                      <button type="button" class="qq-cancel-button-selector">No</button>
                                      <button type="button" class="qq-ok-button-selector">Yes</button>
                                  </div>
                              </dialog>

                              <dialog class="qq-prompt-dialog-selector">
                                  <div class="qq-dialog-message-selector"></div>
                                  <input type="text">
                                  <div class="qq-dialog-buttons">
                                      <button type="button" class="qq-cancel-button-selector">Cancel</button>
                                      <button type="button" class="qq-ok-button-selector">Ok</button>
                                  </div>
                              </dialog>
                          </div>
                      </script>

                      <style>
                          #trigger-upload {
                              color: white;
                              background-color: #00ABC7;
                              font-size: 14px;
                              padding: 7px 20px;
                              background-image: none;
                          }

                          #fine-uploader-manual-trigger .qq-upload-button {
                              margin-right: 15px;
                          }

                          #fine-uploader-manual-trigger .buttons {
                              width: 36%;
                          }

                          #fine-uploader-manual-trigger .qq-uploader .qq-total-progress-bar-container {
                              width: 60%;
                          }
                      </style>
                      <div id="fine-uploader-manual-trigger"></div>
                      <div id="upload_status"></div>
                      <!-- Your code to create an instance of Fine Uploader and bind to the DOM/template
                      ====================================================================== -->
                      <script>
                          $('#fine-uploader-manual-trigger').fineUploader({
                              validation : {
                                  allowedExtensions : ['pdf','docx','doc','xlsx','xls','ppt','pptx','txt','jpg','jpeg','png','gif']
                              },
                              template: 'qq-template-manual-trigger',
                              request: {
                                  endpoint: 'upload.php'
                              },
                              thumbnails: {
                                  placeholders: {
                                      waitingPath: '../lib/fine-uploader/placeholders/waiting-generic.png',
                                      notAvailablePath: '../lib/fine-uploader/placeholders/not_available-generic.png'
                                  }
                              },
                              autoUpload: false,
                              callbacks: {
                                  onComplete: function(id,name,responseJSON) {
                                      //alert("completed");
                                      var jsonStr = JSON.stringify(responseJSON);

                                      //$("#upload_status").append(id+name+jsonStr);

                                      $.ajax({
                                         type: "POST",
                                         url: "admin_show_file.php",
                                         success: function(msg){
                                                $(".doc_panel").html("");
                                                $(".doc_panel").html(msg);
                                         }
                                       });

                                  }
                              }
                          });

                          $('#trigger-upload').click(function() {
                              $('#fine-uploader-manual-trigger').fineUploader('uploadStoredFiles');

                          });
                      </script>
                    </div> <!-- End Div Upload Zone -->



                  </div>


                </div>

              </div>
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>รายชื่อไฟล์เอกสาร</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="panel panel-default doc_panel" >
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
                          $res_sql = mysqli_query($link,$sql);
                          //$stmt = $conn->prepare($sql);

                          //$stmt->bind_param('s', $strCustomerID); //   s - string, b - blob, i - int, etc

                        	/*** for 2 Parameters
                        		$strCustomerID = "C001";
                        		$strEmail = "win.weerachai@thaicreate.com";
                        		$sql = "SELECT * FROM customer WHERE CustomerID = ? AND Email = ? ";
                        		$stmt = $conn->prepare($sql);
                        		$stmt->bind_param('ss', $strCustomerID,$strEmail); //   s - string, b - blob, i - int, etc
                        	**/

                        	/*$stmt ->execute();

                        	$result = $stmt->get_result();
                        	while ($row = $result->fetch_assoc())*/
                            if (mysqli_num_rows($res_sql) > 0)
                        	{
                                while ($row = mysqli_fetch_array($res_sql)) {
                                    echo "<tr>";
                                	echo "<td>".$row["fd_id"]."</td>";
                                    echo "<td>".$row["file_name"]."</td>";
                                    echo "<td>".$row["full_name"]."</td>";
                                    echo "<td><a href='files/".$row["folder_name"]."/".$row["file_name"]."' target='_blank' ><img src='images/search.png' /></a></td>";
                                    echo "<td><a href='admin_edit_file.php?fd_id=".$row["fd_id"]."' ><img src='images/edit.png' /></a></td>";
                                    echo "</tr>";
                                }
                        	}


                       ?>
                     </tbody>
                   </table>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- /page content -->

<?php
  $conn->close();
  include "template_bottom.php";
?>

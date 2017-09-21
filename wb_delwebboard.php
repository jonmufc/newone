<?php
	//include("template_header.php");

	include_once("dbcon.php");

	// DB section
	$link = mysqli_connect(DBSERVER,DBUSR,DBPWD,DBNAME);
	//mysql_select_db(DB, $conn);
	mysqli_query($link,"SET character_set_results=utf8");
	mysqli_query($link,"SET character_set_client=utf8");
	mysqli_query($link,"SET character_set_connection=utf8");
?>

<script type='text/javascript'>
	function linkurl(url) {
		//alert(url);
		window.opener.location = url;
		window.close();
		//window.opener.location.reload();
		//window.opener.location = url;
	}

	function cancel() {
		window.close();
	}

	/*window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
    }*/

</script>

<?php
if(isset($_GET["qid"]))
{
	if ($_GET['type'] == "1") {
	$questionID = $_GET['qid'];
	//*** Insert Question ***//
	$strSQL = "delete from reply where QuestionID=".$questionID;
	$objQuery = mysqli_query($link,$strSQL);

	$strSQL = "delete from webboard where QuestionID=".$questionID;
	$objQuery = mysqli_query($link,$strSQL);

	header("location:wb_board.php");
	} else {
		echo "ยืนยันการลบข้อมูล?<br>";
		?>
		<button onclick="linkurl('wb_delwebboard.php?type=1&qid=<?php echo $_GET["qid"]; ?>');">ยืนยัน</button>
		<button onclick='cancel();'>ยกเลิก</button>
		<?php
	}
}


mysqli_close($link);
//include_once("template_bottom.php");

?>

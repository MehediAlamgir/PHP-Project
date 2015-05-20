<?php
	session_start();
	if( !isset($_SESSION['president_useremail']) ){
		header('location:index.php');
	}

	include('config.php');

	
?>
<?php
	$userid = $_REQUEST['userid'];
	$query = "UPDATE users set status=0 WHERE user_id=$userid";
	$result = mysql_query($query);
	$_SESSION['message'] = "<font size='4' color='green'><b>Disable Successfull</b></font>";
	header('location:presidentactivestudent.php');
?>
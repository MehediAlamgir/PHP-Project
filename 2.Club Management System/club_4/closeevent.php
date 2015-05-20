<?php
	session_start();
	if( !isset($_SESSION['president_useremail']) ){
		header('location:index.php');
	}

	include('config.php');

	
?>
<?php
	$eventid = $_REQUEST['event_id'];
	$query = "UPDATE events set event_status=0 WHERE event_id=$eventid";
	$result = mysql_query($query);
	$_SESSION['message'] = "<font size='4' color='green'><b>Event Close Successfull</b></font>";
	header('location:activeenent.php');
?>
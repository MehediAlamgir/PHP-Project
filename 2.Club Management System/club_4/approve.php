<?php 
	session_start();
	include("config.php");
	$user_id = $_REQUEST['user_id'];
	$event_id = $_REQUEST['event_id'];
	$club_id = $_REQUEST['club_id'];

	$query = "INSERT INTO event_members (event_id, member_id, member_status) VALUES($event_id, $user_id, 0)";
	mysql_query($query);
	$_SESSION['message'] = "<font size='4' color='green'><b>Request sent to President. Wait for approval</b></font>";
	header("location:userjoinevent.php");
	//exit();
?>

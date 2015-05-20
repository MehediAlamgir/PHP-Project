<?php
	session_start();
	if( !isset($_SESSION['president_useremail']) ){
		header('location:index.php');
	}

	include('config.php');

	
?>
<?php
	$userid = $_REQUEST['userid'];
	$query = "UPDATE users set status=1 WHERE user_id=$userid";
	$result = mysql_query($query);
	$_SESSION['message'] = "<font size='4' color='green'><b>Approve Successfull</b></font>";

	$query2 = "SELECT * FROM users WHERE user_id=$userid";
	$result2 = mysql_query($query2);
	$row2 = mysql_fetch_array($result2);
	$clubid = $row2['join_club_for'];

	$query3 = "INSERT INTO club_members (user_id, club_id) VALUES($userid, $clubid)";
	$result3 = mysql_query($query3);
	//echo $query3;
	header('location:presidentpendingstudent.php');
?>
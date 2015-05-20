<?php
	session_start();
	if( !isset($_SESSION['admin_useremail']) ){
		header('location:index.php');
	}
	include('config.php');
	
?>
<?php
	if(isset($_REQUEST['submitButton'] )){
		$clubname = $_REQUEST['clubname'];
		$clubdesc = $_REQUEST['clubdesc'];
		$clubpres = $_REQUEST['clubpres'];

		$query = "SELECT user_id FROM users WHERE first_name='$clubpres'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		$presidentid = $row['user_id'];

		$query2 = "INSERT INTO clubs (club_name, club_desc, club_president, status) VALUES('$clubname', '$clubdesc', $presidentid, 1)";
		$result2 = mysql_query($query2);
		if($result2){
			$_SESSION['message'] = "<font size='4' color='green'>Club Create Successfull</b></font>";
		}
		$query3 = "UPDATE users set type=3, status=1 WHERE user_id=$presidentid";
		$result = mysql_query($query3);
	}
?>
<html>
	<head>
		<title>Admin Panel</title>
		<link href="resources/style.css" rel="stylesheet" type="text/css">
		<link href="resources/style2.css" rel="stylesheet" type="text/css">
	<!--For AutoComplete --> 
		<script type="text/javascript" src="resources/jquery.js"></script>
		<script type="text/javascript" src="resources/jquery.autocomplete.js"></script>
		<link rel="stylesheet" type="text/css" href="resources/jquery.autocomplete.css" />
		<script>
			$(document).ready(function(){
 			$("#clubpres").autocomplete("autocompletename.php", {
			selectFirst: true
		});

	});

	</script>
	</head>
	<body>
		<?php include("header.php"); ?>
		<br/>
		<center>
			<span style="background-color: yellow">
			<?php if( isset($_SESSION['message']) ){ echo $_SESSION['message']; $_SESSION['message']= null;} ?> <br />
			</span>
		</center>
		<div class="centerAlign" style="background-color:#d1f1ff">
			<div class="right">
				
			</div>
			<table border="2" class="tbl-border">
				<tr>
					<td width="200" valign="top">
						<div>
							<?php include('adminmenu.php'); ?>
						</div>
					</td>
					<td width="785" valign="top">
							<form>
							<label class="mylabel"><u>Create New Club:</u></label> <br /><br />
							<table border="0" align="center">
								<tr height="35">
									<td><label class="mylabel">Club Name:</label></td>
									<td><input type="text" size="40" name="clubname" /></td>
								</tr>
								<tr height="35">
									<td><label class="mylabel">Club Description:</label></td>
									<td><input type="text" size="40" name="clubdesc" /></td>
								</tr>
								<tr height="35">
									<td><label class="mylabel">Club President:</label></td>
									<td><input type="text" size="40" name="clubpres" id="clubpres" /></td>
								</tr>
								<tr height="35">
									<td><label class="mylabel"> </label></td>
									<td><input type="submit" class="myButton" name="submitButton" value="Create Club" /> <input class="myButton" type="reset" name="resetButton "/></td>
								</tr>
							</table>
							</form>
							
							
								
</html>
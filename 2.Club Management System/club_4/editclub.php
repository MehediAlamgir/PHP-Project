<?php
	session_start();
	if( !isset($_SESSION['admin_useremail']) ){
		header('location:index.php');
	}
	include('config.php');
	
?>

<?php
	$_SESSION['checking'] = 1;
	$ch = $_SESSION['checking'];
	if($ch == 1)
	{
		$clubid = $_REQUEST['club_id'];
		$presid = $_REQUEST['club_pres'];
		$query5 = "SELECT * FROM clubs WHERE club_id = '$clubid' ";
		$result5 = mysql_query($query5);
		$row5 = mysql_fetch_array($result5);
		$cname = $row5['club_name'];
	
		$cdesc = $row5['club_desc'];
		$cpres = $row5['club_president'];
		$cstatus = $row5['status'];
	
		$query6 = "SELECT * FROM users WHERE user_id = '$cpres' ";
	
		$result6 = mysql_query($query6);
		$row6 = mysql_fetch_array($result6);
		$presname = $row6['first_name'];

	}
		$_SESSION['checking'] = 2;
?>

<?php
	if(isset($_REQUEST['submitButton'] ))
	{
		$clubname = $_REQUEST['clubname'];
		$clubdesc = $_REQUEST['clubdesc'];
		$clubpres = $_REQUEST['clubpres'];
		$activated = $_REQUEST['active'];
		
		/*echo $clubname;
		echo $clubdesc;
		echo $clubpres;
		echo $activated;
		*/
		
		$query = "SELECT * FROM users WHERE first_name='$clubpres'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		$presidentid = $row['user_id'];
		//echo $presidentid;

		$query2 = "UPDATE clubs SET club_desc='$clubdesc',club_president='$presidentid',status='$activated' WHERE club_name='$clubname' "; 
		$result2 = mysql_query($query2);
		//$row2 = mysql_fetch_array($result2);
		//$descr = $row2['club_desc'];
		//echo $descr;
		if($result2)
		{
			$_SESSION['message'] = "<font size='4' color='green'>Club Edit Successfull</b></font>";
		}
		//$query3 = "UPDATE users set type=3, status=1 WHERE user_id=$presidentid";
		//$result = mysql_query($query3);
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
							<form action = "editclub.php" method = "post">
							<label class="mylabel"><u>Edit Club:</u></label> <br /><br />
							<table border="0" align="center">
								<tr height="35">
									<td><label class="mylabel">Club Name:</label></td>
									<td><input type="text" size="40" disabled="disabled" name="clubname" value='<? echo $cname; ?>' /></td>
								</tr>
								<tr height="35">
									<td><label class="mylabel">Club Description:</label></td>
									<td><input type="text" size="40" name="clubdesc" value='<? echo $cdesc; ?>' /></td>
								</tr>
								<tr height="35">
									<td><label class="mylabel">Club President:</label></td>
									<td><input type="text" size="40" name="clubpres" id="clubpres" value='<? echo $presname ?>' /></td>
								</tr>
								<tr height="35">
									<td><label class="mylabel"></label></td>
									<td><input type="radio"  name="active" value="1" checked /> Active <input type="radio"  name="active" value="0" /> Deactive</td>
								</tr>
								<tr height="35">
									<td><label class="mylabel"> </label></td>
									<td><input type="submit" class="myButton" name="submitButton" value="Submit Change" /> <input class="myButton" type="reset" name="resetButton "/></td>
								</tr>
							</table>
							</form>
							
							
								
</html>
<?php
	session_start();
	if( !isset($_SESSION['president_useremail']) ){
		header('location:index.php');
	}
	include('config.php');
	
?>
<?php
		if(isset($_REQUEST['submitButton']) ){
		$fname = $_REQUEST['fname'];
		$lname = $_REQUEST['lname'];
		$email = $_SESSION['president_useremail'];

		$query = "UPDATE users set first_name='$fname', last_name='$lname' WHERE email='$email'";
		//echo $query;
		mysql_query($query);
		$_SESSION['message'] = "<font size='4' color='green'><b>Profile Update Successfull</b></font>";

	}
?>

<html>
	<head>
		<title>President Profile</title>
		<link href="resources/style.css" rel="stylesheet" type="text/css">
		<link href="resources/style2.css" rel="stylesheet" type="text/css">
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
							<?php include('presidentmenu.php'); ?>
						</div>
					</td>
					<td width="785" valign="top">
							
							<label class="mylabel"><u>Change Profile:</u></label> <br /><br />
							<?php
								$email = $_SESSION['president_useremail'];
								$query = "SELECT * FROM users WHERE email='$email'";
								$result = mysql_query($query);
								$row = mysql_fetch_array($result);
								$fname = $row['first_name'];
								$lname = $row['last_name'];
							?>
							<form>
							<table border="1" align="center">
								<tr height="35">
									<td><label class="mylabel">First Name:</label></td>
									<td><input type="text" size="40" name="fname" value=<? echo $fname; ?>></td>
								</tr>
								<tr height="35">
									<td><label class="mylabel">Last Name:</label></td>
									<td><input type="text" size="40" name="lname" value=<? echo $lname; ?>></td>
								</tr>
								<tr height="35">
									<td><label class="mylabel"></label></td>
									<td><input type="submit" value="Change Profile" class="mybutton" name="submitButton"></td>
								</tr>
							</table>
							</form>
							
							
			</table>					
</html>
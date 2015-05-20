<?php
	$str;
	include('config.php');
	if( isset($_REQUEST['submitButton']) ){
		$email = $_REQUEST['email'];
		$password = $_REQUEST['password'];
		if(!$username){
			$str = "<font color='red'>Enter Email</font>";
		}
		else if(!$password){
			$str = "<font color='red'>Enter Password</font>";
		}
		else{
			$query = "SELECT * FROM users WHERE users.email='$email' AND password='$password' ";
			$result = mysql_query($query);
			$row = mysql_fetch_array($result);
			$rowCount = mysql_num_rows($result);
			if($rowCount == 1){
				if($row['type'] == 1){
					if($row['status'] !=0 ){
						session_start();
						$_SESSION['registered_useremail'] = $email;
						header('location:userpanel.php');
					}
					else{
						session_start();
						$_SESSION['message'] = "<font color='red' size='4'><b>Your Account has been suspended.</b></font>";
						header('location:disablestatus.php');
					}
				}
				if($row['type'] == 2){
					if($row['status'] !=0 ){
						session_start();
						$_SESSION['president_useremail'] = $email;
						header('location:presidentpanel.php');
					}
					else{
						session_start();
						$_SESSION['message'] = "<font color='red' size='4'><b>Your Account has been suspended.</b></font>";
						header('location:disablestatus.php');
					}
				}
				if($row['type'] == 3){
					session_start();
					$_SESSION['admin_useremail'] = $email;
					header('location:admin.php');
				}
		}
		else{
			$str = "<font color='red'>User name and password Incorrect</font>";
			}
		}
	}
?>
<html>
	<head>
		<title>AIUB Club Management</title>
		<link href="resources/style.css" rel="stylesheet" type="text/css">
		<script src="script.js" type="text/javascript"></script>
	</head>
	<body>
		<?php include("header.php"); ?>
		<br/>
		<div class="centerAlign">
			<div class="right">
				<form method="post" onsubmit="return validateForm();">
				<table border="0">
					<tr><br />
						<td width="100" height="30"><label class="mylabel">User Email:</label></td>
						<td height="30"><input type="text" name="email" size="30" id="username"/><span id="usernameerror"></span></td>
					</tr>
					<tr>
						<td width="100" height="30"><label class="mylabel">Password:</label></td>
						<td height="30"><input type="password" name="password" id="password" size="30"/><span id="passworderror"></span></td>
					</tr>
					<tr>
						<td width="100"><label class="mylabel"></label></td>
						<td><input type="submit" name="submitButton" value="Login" class="myButton"/></td>
					</tr>
					<tr>
						<td width="100"><label class="mylabel"></label></td>
						<td><?php if( isset($str) ){ echo $str;} ?></td>
					</tr>
					<tr>
						<td width="100"><label class="mylabel"></label></td>
						<td><a href="registration.php" class="myLink">Create New Account</a><br /><br /></td>
					</tr>
				</table>
			</form>
			</div>
		</div>
		<?php include("footer.php"); ?>
	</body>
</html>
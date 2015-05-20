<?php
	session_start();
	include("config.php");
	if(isset($_REQUEST['submitButton'] ) )
	{	
		include("config.php");	
		$errorfname;
		$errorlname;
		$erroruname;
		$errorpassword;
		$errorpassword2;
		$erroremail;
		$fname = trim($_REQUEST['firstname']);
		$lname = trim($_REQUEST['lastname']);
		$password = trim($_REQUEST['password']);
		$password2 = trim($_REQUEST['password2']);
		$email = trim($_REQUEST['email']);
		$clubname = trim($_REQUEST['ClubName']);
		
		if(!$fname)
		{
			$errorfname = "<font color='red'>Invalid first name</font>";
		}
		else if(!$lname)
		{
			$errorlname = "<font color='red'>Invalid last name</font>";
		}
		else if(!$password)
		{
			$errorpassword = "<font color='red'>Invalid password</font>";
		}
		else if(!$password2)
		{
			$errorpassword2 = "<font color='red'>Invalid password</font>";
		}
		else if(!$email)
		{
			$erroremail = "<font color='red'>Invalid email</font>";
		}
		else
		{
			$q = "SELECT * FROM clubs where club_name = '$clubname' ";
			$res = mysql_query($q);
			$row = mysql_fetch_array($res);
			$clubid = $row['club_id'];
			
			$query = "INSERT INTO users (first_name, last_name, email, password, type, status, join_club_for) VALUES('$fname', '$lname', '$email', '$password', 1, 0, $clubid)";			
			mysql_query($query);
			
			$_SESSION['message'] = "Your Request is pending. Wait For aprooval";
			
			header('location:resgistrationmessage.php');
			
		/*	if($result)
			{
				session_start();
				$_SESSION['useremail'] = $email;
				header('location:welcome.php');
			}
			else{
				
				header('location:registration.php');
			}
		*/
		}
		
		}	
?>
<html>
	<head>
		<title>User Registration</title>
		<link href="resources/style.css" rel="stylesheet" type="text/css">
		<script src="script.js" type="text/javascript"></script>
	</head>
	<body>
		<?php include("header.php"); ?>
		<br/>
		<div class="centerAlign" style="background-color:#d1f1ff">
			<form method="post" onsubmit="return validateReg();">
			<table border="0" align="center" cellspacing = '5' cellpadding = '5'>
				<tr>
					<td width="140" height="30"><label class="myLabel">First Name:</label></td>
					<td height="30"><input type="text" size="40" name="firstname" id="firstname" /></td>
					<td width="200" height="30"><span id="errorfirstname"><?php if(isset($errorfname) ){ echo $errorfname;} ?></span></td>
				</tr>
				<tr>
					<td width="140" height="30"><label class="myLabel">Last Name:</label></td>
					<td height="30"><input type="text" size="40" name="lastname" id="lastname" /></td>
					<td width="200" height="30"><span id="errorlastname"><?php if(isset($errorlname) ){ echo $errorlname;} ?></span></td>
				</tr>
			
				<tr>
					<td width="140" height="30"><label class="myLabel">Email:</label></td>
					<td height="30"><input type="text" size="40" name="email" id="email" /></td>
					<td width="200" height="30"><span id="erroremail"><?php if(isset($erroremail) ){ echo $erroremail;} ?></span></td>
				</tr>
				<tr>
					<td width="140" height="30"><label class="myLabel">Password:</label></td>
					<td height="30"><input type="password" size="40" name="password" id="password"/></td>
					<td width="200" height="30"><span id="errorpassword1"><?php if(isset($errorpassword) ){ echo $errorpassword;} ?></span></td>
				</tr>
				<tr>
					<td width="140" height="30"><label class="myLabel">Re-Tye Pass:</label></td>
					<td height="30"><input type="password" size="40" name="password2" id="password2" /></td>
					<td width="200" height="30"><span id="errorpassword2"><?php if(isset($errorpassword2) ){ echo $errorpassword2;} ?></span></td>
				</tr>
				<?php 
					include("config.php");	
						
						$option =  "<option selected>Select Club</option>" ; 						 
						$q = "SELECT * FROM clubs";
						$res = mysql_query($q);
						while($row = mysql_fetch_array($res))
						{
						  $club_name = $row['club_name'];						  
						  $option .= "<option>$club_name</option>";
						}

				?>
					
					<tr>
						<td width="140" height="30"><label class="myLabel">Select Club</label></td>
						<td   height="30" >
							<select width="140" name = "ClubName"><?php echo $option ?></select>
						</td>
					</tr>
				<tr>
					<td width="140" height="30"><label class="myLabel"></label></td>
					<td height="30"><input type="submit" name="submitButton" value="Sign Up" class="myButton" /> <input type="reset" name="resetButton" value="Reset" class="myButton" /></td>
					<td width="200" height="30"><span id="errorpassword2"></span></td>
				</tr>
				<label class="myLabel">
				<?php

        			if(isset($message))
        			{
        				echo "<font color = 'red'><h2>$message</font></h2>";
        				$message="";
        			}
        		?>
				</label>
			</table>
			</form>
		</div>
		<?php include("footer.php"); ?>
	</body>
</html>
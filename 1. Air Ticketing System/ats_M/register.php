<?php
	session_start();
	if(isset($_REQUEST['submit']))
	{
		include("db.php");
		$name=trim($_REQUEST['name']);
		$un=trim($_REQUEST['un']);
		$pass=trim($_REQUEST['pass']);
		$conpass=trim($_REQUEST['conpass']);
		$phone=trim($_POST['mob']);
		//echo $phone . "</br>";
		$mail=trim($_REQUEST['email']);
		$len = strlen($pass);
	
		
		$flag = 1;
		
		$q="SELECT * from user WHERE username = '$un' ";
		$result=mysql_query($q);
		$row=mysql_fetch_array($result);
		
		
		if($row)
		{			
			$message = "User Name Already Exists !!!";
		}	
		
		else
		{
			
			if($name == "" || $un == "" || $pass == "" || $conpass == "" || $mail == "" || $phone == "")
			{
				echo "<h2 align='center'><font color='red'>You Have to Fill Up All Information !!!!</font></h2>";
				$flag = 0;
			}
				
			else if($pass != $conpass)
			{
				echo "<h2 align='center'><font color='red'>Password did not match !!!!</font></h2>";
				$flag=0;
			}
			
			else if($len<6)
			{
				echo "<h2 align='center'><font color='red'>Password must be atleast 6 character !!!!</font></h2>";
				$flag = 0;
			}


			if($flag)
			{
				//echo $phone . "</br>";
				$query="INSERT INTO user (`name`,`username`,`password`,`mobile`,`email`,`type`) VALUES('$name','$un','$pass','$phone','$mail','user')";
				mysql_query($query);

				echo "<h2 align='center'><font color='red'>Succesfully Registered.</font></h2>";				

			}
		}

	}

?>



<html>
	<head>
		<title>Registration</title>
		<script type = "text/javascript" src = "script.js"></script>
	</head>
	
	<body >
	<script src="ajax.js"></script>
	<h2 align = "center">Registration</h2>
	<a href = "index.php"><button>Back</button></a>
		<form method ="post" action ="register.php" style = "margin-top:1px"  >
			<center >
				<table border = "1" cellspacing = '10' cellpadding = '10'>
						<tr>
							<td>
								<label>Name</label>
							</td>
							<td>
								<input type = "text" name = "name" id = "name" placeholder = "Name"   />
							</td>
						</tr>
							
						<tr>
							<td>
								<label>User Name</label>
							</td>
							<td>
								<input type = "text" name = "un" id = "un" onBlur = "call_username();" placeholder = "User Name"   />
							</td>
							<td><label id = "un_msg"> </label></td>
						</tr>
							
						
						<tr>
							<td>
								<label>Password</label>
							</td>
							<td>
								<input type = "password" name = "pass" id = "pass" onBlur = "call_password();" placeholder = "Password"   />
							</td>
							<td><label id = "pass_msg"> </label></td>
						</tr>
							
						
						<tr>
							<td>
								<label>Confirm Password</label>
							</td>
							<td>
								<input type = "password" name = "conpass" id = "conpass" onBlur = "call_conpassword();" placeholder = "Confirm Password"   />
							</td>
							<td><label id = "conpassword_msg"> </label></td>
						</tr>
							
						<tr>
							<td>
								<label>Mobile</label>
							</td>
							<td>
								<input type = "text" name = "mob" id = "mob" placeholder = "Mobile"   />
							</td>
						</tr>
						
						
						<tr>
							<td>
								<label>Email</label>
							</td>
							<td>
								<input type = "text"  name = "email" id = "email" onBlur = "call_email();" placeholder = "Email"  />
							</td>
							<td><label id = "email_msg"> </label></td>
						</tr>
										
						
					</table> 
				<input type = "submit" name = "submit" value = "Register" />
				
				
				
			</center>
		</form>
		
		
		
	</body>

</html>
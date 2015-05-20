<?php
	if(isset($_REQUEST['submit']))
	{
		session_start();
		include("db.php");
		$message = "";
		$un=trim($_REQUEST['un']);
		$pwd=trim($_REQUEST['pwd']);


		if($un == "" || $pwd == "")
		{
			$message = "User Name or Password is Empty !!";
		}
		else
		{
			$query="SELECT * from user where username='$un' AND password='$pwd'";
			$res=mysql_query($query);
			$row = mysql_fetch_array($res);
			if($row)
			{
				   $type = $row['type'];
                   $_SESSION["type"] = $type;

                   if($type == 'admin')
                   {
                     $_SESSION['admin_name'] = $row['name'];
                     header("Location:admin.php");
                   }

                   else if($type == 'user')
                   {
                     $_SESSION['uname'] = $row['username'] ;
                     $_SESSION['user_name'] = $row['name'];
                     header("Location:user.php");
                   }

                   else
                   {
                     $message = "Invalid Username or Password";
                   }
			}
			
			else
			{
				$message = "Invalid User Name or Password !!";
			}
		}
	}

?>


<body>
  <center>
  	<form method="post"  >
  		<table  border = "0" cellspacing = '5' cellpadding = '4'>
  			<tr>
  				<td>
  					<label>User Name</label>

  				</td>
  				<td>
  					<input type="text" name="un" placeholder = "User Name"/>
  				</td>
  			</tr>

  			<tr>
  				<td>
  					<label>Password</label>
  				</td>
  				<td>
  					<input type="password" name="pwd" placeholder = "Password"/>
  				</td>
  			</tr>

  		</table>
  		<tr>
  			<td>
  				<input type="submit" name="submit" value="LogIn" />
  			</td>
  		</tr>

  	</form>
      <br><br><br><br><br>
     <a href="unregflightschedule.php"><button>View Flight Schedule</button></a>
     <a href="unregroutemaps.php"><button>View Route Maps</button></a>


  	<label>
  		<?php

  			if(isset($message))
  			{
  				echo "<font color = 'red'><h2>$message</font></h2>";
  				$message="";
  			}
  		?>

  	</label>

  </center>





</body>
  <br><br><br><br><br><br><br><br><br>
<label>New at this site ?? <a href="register.php">Sign Up</a> here</label>

</body>

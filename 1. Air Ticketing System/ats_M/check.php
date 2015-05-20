<?php
	include("db.php");		
	
	if (isset($_GET["un"]))
	{
		$un = $_REQUEST['un'];
		$sql1  = "SELECT * FROM user WHERE username = '$un' ";
		$result1 = mysql_query($sql1);
		$row1 = mysql_fetch_array($result1);
		
		if($row1)
		{
			echo "User Name already exist";
		}
		
		else if(!$row1) 
		{
			echo "User Name available";
		}
	}
	if (isset($_GET["email"]))
	{
		$email = $_REQUEST['email'];
		$sql2  = "SELECT * FROM user WHERE email = '$email' ";	
		$result2 = mysql_query($sql2);	
		$row2 = mysql_fetch_array($result2);
		
		if($row2)
		{
			echo "Email already exist";
		}
		
		else if(!$row2)
		{
			echo "Email available";
		}
	}
	
?>
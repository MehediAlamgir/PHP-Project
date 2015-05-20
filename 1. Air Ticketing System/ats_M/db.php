<?php
	
	$con = mysql_connect("localhost","root","");
	if(!$con)
	{
		die("Connection Error " . mysql_error());
	}
	$db = mysql_select_db("at", $con);
		
	if ($db == null)
	{
		die("Database Connection Error");
	}
		
?>
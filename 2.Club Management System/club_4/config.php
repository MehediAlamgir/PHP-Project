<?php
	$hostname = "localhost";
	$dbname = "club_db_4";
	$username = "root";
	$password = "";

	$connection = mysql_connect($hostname, $username, $password);
	if($connection){
		$db = mysql_select_db($dbname, $connection);
		if(!$db){
			die("Connect success but could not connect to database");
		}

	}
	else{
		die("Please check the Database Connection.");
	}
?>
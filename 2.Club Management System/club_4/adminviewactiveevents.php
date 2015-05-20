<?php
	session_start();
	if( !isset($_SESSION['admin_useremail']) ){
		header('location:index.php');
	}
	include('config.php');
	
?>
<html>
	<head>
		<title>Active Event</title>
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
							<?php include('adminmenu.php'); ?>
						</div>
					</td>
					<td width="785" valign="top">
							
							<label class="mylabel"><u>Active Event:</u></label> <br /><br />
							
							<?php 
							$query = "SELECT * FROM events where event_status = 1 ";
							$result = mysql_query($query);
							$tbl = "<table border='1' cellspacing='0' cellpadding='5' align = 'center' width='600'>
								<tr height='35'>
									<th>Event ID</th>
									<th>Event Name</th>
									<th>Event Description</th>
									<th>Start Date</th>
									<th>Control</th>
								
								</tr>";	
								
								while($row = mysql_fetch_array($result))
								{
									$eventid = $row['event_id'];
									
									$eventname = $row['event_name'];
									$eventdesc = $row['event_desc'];
									$eventdate = $row['event_date'];	
									//$type = $row['type'];
									//$status = $row['status'];
									 
									 $tbl .= "<tr height='35'><td>" . $eventid . "</td>"."<td>" . $eventname . "</td>" . "<td>" . $eventdesc . "</td>" . "<td>" . $eventdate . "</td><td><a href='admincloseevents.php?event_id=$eventid'><button class='mybutton'>Close</button></a></td></tr>";
									
								}
								
								$tbl .= "</table>";
								echo $tbl;
						?>
			</table>					
</html>
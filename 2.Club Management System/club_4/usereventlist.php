<?php
	session_start();
	if( !isset($_SESSION['registered_useremail']) ){
		header('location:index.php');
	}
	include('config.php');
	
?>
<html>
	<head>
		<title>User Panel</title>
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
							<?php include('usermenu.php'); ?>
						</div>
					</td>
					<td width="785" valign="top">
							
							<label class="mylabel"><u>Event List</u></label> <br /><br />
							<table border='1' cellspacing='5' cellpadding='5' align = 'center' >
								<tr>
									<th>Status</th>
									<th>Meaning</th>
								</tr>
								<tr>
									<td>
										<label class="mylabel">1</label>
									</td>
									<td>
										<label class="mylabel">Event Open</label>
									</td>
								</tr>
								<tr>
									<td>
										<label class="mylabel">0</label>
									</td>
									<td>
										<label class="mylabel">Event Closed</label>
									</td>
								</tr>
							</table>
							
							<br/><br/>
							<?php
								
								//$clubname = $_SESSION['clubname'];
								$clubname = $_REQUEST['ClubName'];
								//echo $clubname;
								$q1 = "SELECT * FROM clubs WHERE club_name = '$clubname' ";
								$res1 = mysql_query($q1);
								$row1 = mysql_fetch_array($res1);
								$clubid = $row1['club_id'];
								
								
								$q2 = "SELECT * FROM club_event_organize WHERE club_id = '$clubid' ";
								$res2 = mysql_query($q2);
								$row2 = mysql_fetch_array($res2);
								$eventid = $row2['event_id'];
								
								$q3 = "SELECT * FROM events WHERE event_id = '$eventid' ";
								$res3 = mysql_query($q3);

								$useremail = $_SESSION['registered_useremail'];
								$myquery= "SELECT * FROM users WHERE email='$useremail'";
								$myresult = mysql_query($myquery);
								$myrow = mysql_fetch_array($myresult);
								$userid = $myrow['user_id'];
								
								$tbl = "<table border='1' cellspacing='5' cellpadding='5' align = 'center'>
										<tr>
											<th>Event ID</th>
											<th>Event Name</th>
											<th>Description</th>
											<th>Date</th>
											<th>Status</th>											
											<th>Control</th>
										</tr>";	

								while ($row3 = mysql_fetch_array($res3))
								{
									$eventid = $row3['event_id'];
									$eventname = $row3['event_name'];
									$eventdesc = $row3['event_desc'];
									$eventdate = $row3['event_date'];
									$eventstatus = $row3['event_status'];
									$msg;
									$tbl .= "<tr><td>" . $eventid . "</td>"."<td>" . $eventname . "</td>" . "<td>" . $eventdesc . "</td>" . "<td>" . $eventdate . "</td>". "<td>" . $eventstatus . "</td>". "<td>". "<a href='approve.php?user_id=$userid&event_id=$eventid&club_id=$clubid'><button class='mybutton'>Join</button></a>" . "</td></tr>";
								}
								
								$tbl .= "</table>";
								echo $tbl;
								
							?>
							
							
					</td>
				</tr>
			</table>
		</div>
</html>
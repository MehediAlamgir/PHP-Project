<?php
	session_start();
	if( !isset($_SESSION['president_useremail']) ){
		header('location:index.php');
	}
	
	
	else if (isset($_REQUEST['submitButton'] ) )
	{	
		include("config.php");	

		$eventname = trim($_REQUEST['eventname']);
		$eventdescription = trim($_REQUEST['eventdescription']);
		$eventdate = trim($_REQUEST['eventdate']);
	//	$eventstatus = trim($_REQUEST['eventstatus']);
		
		if($eventname == "" || $eventdescription == "" || $eventdate == "")
		{
			$message = "You Have to Fill Up All Information";
		}
		else
		{
			
			$presidentemail = $_SESSION['president_useremail'];
			$q1 = "SELECT * FROM users where email = '$presidentemail' ";
			$res1 = mysql_query($q1);
			$row1 = mysql_fetch_array($res1);			
			$presidentid = $row1['user_id'];
			
			$q2 = "SELECT * FROM clubs where club_president = '$presidentid' ";
			$res2 = mysql_query($q2);
			$row2 = mysql_fetch_array($res2);
			$clubid = $row2['club_id'];
			
			
			$query = "INSERT INTO events (event_name,event_desc,event_date,event_status) VALUES('$eventname','$eventdescription', STR_TO_DATE('$eventdate', '%d-%m-%Y'),1)";			
			mysql_query($query);
			

			$query2 = "SELECT MAX(event_id) from events WHERE event_name='$eventname'";
			
			$result2 = mysql_query($query2);
			$row3 = mysql_fetch_array($result2);
			$myeventid = $row3[0];


			$query3 = "INSERT INTO club_event_organize (president_id, club_id, event_id) VALUES($presidentid, $clubid, $myeventid)";
			mysql_query($query3);
			$_SESSION['message'] = "<font color='green' size='4'><b>Event Create Successfull</b></font>";
			
			
			
		//	$message = "Event Created";			

		}
		
	}	

	
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Create Event</title>
		<link href="resources/style.css" rel="stylesheet" type="text/css">
		<link href="resources/style2.css" rel="stylesheet" type="text/css">

		<link href="resources/datepicker/jquery-ui.css" rel="stylesheet">
		<script src="resources/datepicker/jquery.min.js"></script>
		<script src="resources/datepicker/jquery-ui.min.js"></script>

		<script>
		/*
		 * jQuery UI Datepicker: Parse and Format Dates
		 * http://salman-w.blogspot.com/2013/01/jquery-ui-datepicker-examples.html
		 */
		$(function() {
			$("#datepicker").datepicker({
				dateFormat: "dd-mm-yy",
				onSelect: function(dateText, inst) {
					var date = $.datepicker.parseDate(inst.settings.dateFormat || $.datepicker._defaults.dateFormat, dateText, inst.settings);
					var dateText1 = $.datepicker.formatDate("D, d M yy", date, inst.settings);
					date.setDate(date.getDate() + 7);
					var dateText2 = $.datepicker.formatDate("D, d M yy", date, inst.settings);
					$("#dateoutput").html("Chosen date is <b>" + dateText1 + "</b>; chosen date + 7 days yields <b>" + dateText2 + "</b>");
				}
			});
		});
	</script>
	
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
							
						<label class="mylabel"><u>Create Event</u></label> <br /><br />	
					<form method="post" onsubmit="return validateReg();">				
					<table border="0"  cellspacing = '5' cellpadding = '5'>
						<tr>
							<td width="140" height="30"><label class="myLabel">Event Name</label></td>
							<td height="30"><input type="text" size="40" name="eventname" id="eventname" /></td>
							
						</tr>
						<tr>
							<td width="140" height="30"><label class="myLabel">Event Description</label></td>
							<td height="30"><input type="text" size="40" name="eventdescription" id="eventdescription" /></td>
							
						</tr>
					
						<tr>
							<td width="140" height="30"><label class="myLabel">Event Date</label></td>
							<td height="30"><input type="text" size="40" name="eventdate" id="datepicker" /></td>
							
						</tr>
						
						<tr>
							<td width="140" height="30"><label class="myLabel"></label></td>
							<td height="30"><input type="submit" name="submitButton" value="Create" class="myButton" /></td>
						</tr>
						<label>
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
			</td>
			</tr>	
			</table>
		
		</div>	

	</body>				
</html>
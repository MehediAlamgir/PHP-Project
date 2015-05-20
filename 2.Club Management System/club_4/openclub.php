<?php
	session_start();
	if( !isset($_SESSION['admin_useremail']) ){
		header('location:index.php');
	}
	include('config.php');
	
?>
<html>
	<head>
		<title>Manage Club</title>
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
							
							<label class="mylabel"><u>Active Club List:</u></label> <br /><br />
						
							<table border="1" cellpadding="5" align="center">
								<tr>
									<th>Club Id</th>
									<th>Club Name</th>
									<th>Club Description</th>
									<th>Club President</th>
									<th>Club Status</th>
									<th>Operation</th>
								</tr>
							<?php
								$query = "SELECT * FROM clubs WHERE status=1";
								$result = mysql_query($query);
								while($row = mysql_fetch_array($result))
								{
									$club_id = $row['club_id'];
									$club_name = $row['club_name'];
									$club_desc = $row['club_desc'];
									$club_president = $row['club_president'];
									$club_status = $row['status'];

									$query2 = "SELECT * from users WHERE user_id=$club_president";
									$result2 = mysql_query($query2);
									$row2 = mysql_fetch_array($result2);
									$presName = $row2['first_name'];

									$cstatus = ($club_status == 1) ? "Active" : "Closed";
									
									echo "
										<tr>
											<td>$club_id</td>
											<td>$club_name</td>
											<td>$club_desc</td>
											<td>$presName </td>
											<td>$cstatus</td>
											<td align='center'><a href='editclub.php?club_id=$club_id&club_pres=$club_president'><button class='mybutton'>Edit</button></a></td>
										</tr>
										";
								} // end loop
							?>
							</table> <br />
					
							<label class="mylabel"><u>Deactive Club List:</u></label> <br /><br />
							
							<table border="1" cellpadding="5" align="left">
								<tr>
									<th>Club Id</th>
									<th>Club Name</th>
									<th>Club Description</th>
									<th>Club President</th>
									<th>Club Status</th>
									<th>Operation</th>
								</tr>
							<?php
								$query = "SELECT * FROM clubs WHERE status=0";
								$result = mysql_query($query);
								while($row = mysql_fetch_array($result)){
								$club_id = $row['club_id'];
								$club_name = $row['club_name'];
								$club_desc = $row['club_desc'];
								$club_president = $row['club_president'];
								$club_status = $row['status'];

								$query2 = "SELECT * from users WHERE user_id=$club_president";
								$result2 = mysql_query($query2);
								$row2 = mysql_fetch_array($result2);
								$presName = $row2['first_name'];

								$cstatus = ($club_status == 1) ? "Active" : "Closed";
								
								echo "
									<tr>
										<td>$club_id</td>
										<td>$club_name</td>
										<td>$club_desc</td>
										<td>$presName</a></td>
										<td>$cstatus</td>
										<td><a class='mylink' href='openclub.php?club_id=$club_id&club_pres=$club_president'><button class='mybutton'>Open</button></a></td>
									</tr>
									";
								} // end loop
									
									if($club_status==0)
									{
										$clubid = $_REQUEST['club_id'];
										$clubpresident = $_REQUEST['club_pres'];
										
										$query = "UPDATE clubs set status = 1 WHERE club_id = $clubid ";
										$result = mysql_query($query);
										
										$_SESSION['message'] = "<font size='4' color='green'><b>'re-opened</b></font>";
									}
							?>
							</table> <br />
							
								
</html>
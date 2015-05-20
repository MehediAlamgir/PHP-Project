<?php
	session_start();
	if( !isset($_SESSION['president_useremail']) ){
		header('location:index.php');
	}

	include('config.php');

	
?>
<html>
	<head>
		<title>Pending Student</title>
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
							<?php include('presidentmenu.php'); ?>
						 </div>					
					</td>
					
					<td width="785" valign="top">
							
						<label class="mylabel"><u>Pending Student List</u></label> <br /><br />	

						<?php 
						
							$query = "SELECT * FROM users where type = 1 AND status = 0 ";
							$result = mysql_query($query);
							$tbl = "<table border='1' cellspacing='5' cellpadding='5' align = 'center'>
								<tr>
									<th>User ID</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Email</th>
									<th>Control</>
								</tr>";	
								
								while($row = mysql_fetch_array($result))
								{
									$userid = $row['user_id'];
									
									$fname = $row['first_name'];
									$lname = $row['last_name'];
									$email = $row['email'];	
									$type = $row['type'];
									$status = $row['status'];
									 
									 $tbl .= "<tr><td>" . $userid . "</td>"."<td>" . $fname . "</td>" . "<td>" . $lname . "</td>" . "<td>" . $email . "</td>". "<td>". "<a href='approveuser.php?userid=$userid'><button class='mybutton'>Approve</button></a>" . "</td></tr>";
									//echo  "<td><input type = 'submit' name = 'approveButton' value = 'Approve' /></td>";
									//echo "<tr><td>" . $userid . "</td>"."<td>" . $fname . "</td>" . "<td>" . $lname . "</td>" . "<td>" . $email . "</td>". "<td>". $type . "</td>". "<td>". $status . "</td></tr>";
									 
									/* if($_REQUEST['approveButton'])
									 {
										$query = "UPDATE users SET type = '1' AND status = '1'  WHERE user_id = '$userid' ";
										mysql_query($query);
									 }*/
								}
								
								$tbl .= "</table>";
								echo $tbl;
						?>
					</td>
				</tr>
			</table>
		
		</div>	

	</body>				
</html>
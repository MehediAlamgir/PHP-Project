<?php
	session_start();
	if( !isset($_SESSION['registered_useremail']) )
	{
		header('location:index.php');
	}
		include('config.php');
		$useremail = $_SESSION['registered_useremail'];
		
	/*if(isset($_REQUEST['submitButton']))
	{
		$_SESSION['clubname']=$_REQUEST['ClubName'] ;
		header("usereventlist.php");
	}
	*/
	
?>
<html>
	<head>
		<title>User Join Event</title>
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
							
							<label class="mylabel"><u>Join a Event:</u></label> <br /><br />
							
						<!--	<label class="mylabel"><u>Select Club:</u></label>	-->
						<form action = "usereventlist.php">
						<table>
							<?php 							
								
								$option =  "<option selected>Select Club</option>" ; 						 
								$q1 = "SELECT * FROM users WHERE email = '$useremail' ";
								$res1 = mysql_query($q1);
								$row1 = mysql_fetch_array($res1);
								$userid = $row1['user_id'];
								
								$q2 = "SELECT * FROM club_members WHERE user_id = '$userid' ";
								$res2 = mysql_query($q2);
								$row2 = mysql_fetch_array($res2);
								$clubid = $row2['club_id'];
								
								$q3 = "SELECT * FROM clubs WHERE club_id = '$clubid' ";
								$res3 = mysql_query($q3);
								
								
								while($row3 = mysql_fetch_array($res3))
								{
								  $club_name = $row3['club_name'];						  
								  $option .= "<option>$club_name</option>";
								}

						?>
					
					<tr>
						<td width="140" height="30"><label class="myLabel">Select Club</label></td>
						<td   height="30" >
							<select width="140" name = "ClubName">	<?php  echo $option; ?>	</select>
							
						</td>
					</tr>
					<tr>
					<td width="140" height="30"><label class="myLabel"></label></td>
					<td height="30"><input type="submit" name="submitButton" value="Click" class="myButton" /></td>
					

					
				</tr>
					</table>
					</form>
					
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>
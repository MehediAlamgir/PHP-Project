<?php
	session_start();
	if( !isset($_SESSION['admin_useremail']) ){
		header('location:index.php');
	}
	include('config.php');
	
?>
<?php
	if(isset($_REQUEST['submitButton']) )
	{
		$oldpassword = $_REQUEST['oldpassword'];
		$newpassword = $_REQUEST['newpassword'];
		$newpassword2 = $_REQUEST['newpassword2'];
		$email = $_SESSION['admin_useremail'];
		
		if($oldpassword == "" || $newpassword == "" || $newpassword2 == "")
		{
			$_SESSION['message'] = "<font size='4' color='red'><b>You Have to Fill Up All Information</b></font>";
		}
		
		else if($newpassword != $newpassword2)
		{
			$_SESSION['message'] = "<font size='4' color='red'><b>Password did not match</b></font>";
		}
		
		else
		{
			$query = "UPDATE users set password='$newpassword' WHERE email='$email'";
			//echo $query;
			mysql_query($query);
			$_SESSION['message'] = "<font size='4' color='red'><b>Password Change Successfull</b></font>";
		}

	}
?>
<html>
	<head>
		<title>Password Change</title>
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
							
					<label class="mylabel"><u>Password Change:</u></label> <br /><br />
					
					<form >	
						<table>
							<tr>
								<td width="140" height="30"><label class="myLabel">Old Password:</label></td>
								<td height="30"><input type="password" size="40" name="oldpassword" id="oldpassword"/></td>
								
							</tr>
							<tr>
								<td width="140" height="30"><label class="myLabel">New Password:</label></td>
								<td height="30"><input type="password" size="40" name="newpassword" id="newpassword"/></td>
							
							</tr>
							<tr>
								<td width="140" height="30"><label class="myLabel">Re-Tye Password:</label></td>
								<td height="30"><input type="password" size="40" name="newpassword2" id="newpassword2" /></td>
								
							</tr>
							<tr>
								<td width="140" height="30"><label class="myLabel"></label></td>
								<td height="30"><input type="submit" name="submitButton" class="mybutton" value="Change" </td>
							
							</tr>
						</table>	
					</form>
					</td>
				</tr>
			</table>
		</div>
</html>
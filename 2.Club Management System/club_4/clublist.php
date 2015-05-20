<html>
	<head>
		<title>Club List</title>
		<link href="resources/style.css" rel="stylesheet" type="text/css">
		<link href="resources/style2.css" rel="stylesheet" type="text/css">
		<script src="script.js" type="text/javascript"></script>
	</head>
	<body>
		<?php include("header.php"); ?>
		<br/>
		<div class="centerAlign" style="background-color:#d1f1ff">
			<label class="mylabel"><u>Club Lists</u></label> <br /><br />
			<table border="0" align="center" cellspacing = '5' cellpadding = '5'>
				
				<?php 
					include("config.php");	
						
						//$option =  "<ol ></ol>" ; 						 
						$q = "SELECT * FROM clubs";
						$res = mysql_query($q);
						while($row = mysql_fetch_array($res))
						{
						  $club_name = $row['club_name'];						  
						  $option .= "<li>$club_name</li>";
						}

				?>
					
					<tr>
						
						<td   height="30" >
							<?php echo "<ol class='mylabel'>". $option. "</ol>" ?>
						</td>
					</tr>
				
				<label class="myLabel">
				<?php

        			if(isset($message))
        			{
        				echo "<font color = 'red'><h2>$message</font></h2>";
        				$message="";
        			}
        		?>
				</label>
			</table>
			
		</div>
		
		<?php include("footer.php"); ?>
	</body>
</html>
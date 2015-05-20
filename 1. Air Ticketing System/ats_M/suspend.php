<?php
            include("db.php");
			echo "<a href = 'admin.php'><button>Back</button></a>"; 
            $query = "SELECT * FROM user";
            $result = mysql_query($query);
			
			$tbl = "<table border='1' cellspacing='5' cellpadding='5' align = 'center'><tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>User Name</th>
                    <th>Mobile</th>
                    <th>Email</th>                   
                </tr>";	

            while($row = mysql_fetch_array($result))
            {
			
				$tbl .= "<tr><td>" . $row['id'] . "</td>"."<td>" . $row['name'] . "</td>" . "<td>" . $row['username'] . "</td>" . "<td>" . $row['mobile'] . "</td>" . "<td>" .$row['email']."</td><tr>";
				
            }
			$tbl .= "</table>";
			echo $tbl;

			echo "<br/><br/>";
			
			if(isset($_POST['suspend']))
			{
				$id = $_POST['id'];
				
				if($id == "")
				{
					$message = "No ID is Select";
				}
				
				else
				{
				
					$q = "DELETE from user WHERE id = '$id' ";
					mysql_query($q);					
					$message = "Deleted";
				}
			}

?>


<html>
    <head>
          <title>Suspend User</title>
    </head>

    <body>
		<h3 align = "center">Suspend User</h3>
       

        <form action = "suspend.php" method = "post">
        <center>
                <table  border = '1' cellspacing = '5' cellpadding = '5' >

                    <tr>
                        <td>ID</td>
                        <td>
                        <input type="text" name = "id" />
                        </td>
                    </tr>
                </table>

				<input type = "submit" name = "suspend" value = "Suspend" />
				
				<label>
        		<?php

        			if(isset($message))
        			{
        				echo "<font color = 'red'><h2>$message</font></h2>";
        				$message="";
        			}
        		?>

        	</label>
     </center>

        </form>

    </body>

</html>
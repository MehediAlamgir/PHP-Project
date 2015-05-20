<?php
    if(isset($_POST['delete']))
    {
         include("db.php");
         $dc = trim($_POST["dc"]);
         $fn = trim($_POST["fn"]);

         if($dc == "" || $fn == "")
         {
             $message = "You Have to Fill up Both Information";
         }

         else
         {
             $query =   "DELETE from flight WHERE flightname = '$fn' AND destination = '$dc'";
             mysql_query($query);

             $message = "Flight Deleted";
         }
    }

?>

<html>

    <head>
        <title>Delete Flight</title>
    </head>

    <body>
        <h2 align = "center">Delete Flight</h2>
        <a href = "admin.php"><button>Back</button></a>  

        <?php
            include("db.php");

            $q = "SELECT * from flight";
            $res = mysql_query($q);
			
			$tbl = "<table border='1' cellspacing='5' cellpadding='5' align = 'center'><tr>
                    <th>Flight No</th>
                    <th>Flight Name</th>
                    <th>Destination</th>
                    <th>Source</th>

                </tr>";	

            while($r = mysql_fetch_array($res))
            {
				
				$tbl .= "<tr><td>" . $r['flightno'] . "</td><td>" .  $r['flightname']  . "</td>" . "<td>" . $r['destination'] . "</td>" . "<td>" .  $r['source'] . "</td><tr>";
				
			
            }
			
			$tbl .= "</table>";
			echo $tbl;

            $option1 = "<option></option>";
            $option2 = "<option></option>";

            $query = "SELECT * from flight";
            $result = mysql_query($query);

            while($row = mysql_fetch_array($result))
            {
              $dairport = $row['destination'];
              $fname = $row['flightname'];

              $option1 .= "<option>$dairport</option>";
              $option2 .= "<option>$fname</option>";

            }

        ?>

        <br/><br/>

        <form action = "deleteflight.php" method = "post">
            <center>
                <table border = "1" cellspacing = "10" cellpadding = "10">
                    <tr>
                        <td>Destination Country</td>
                        <td>
                            <select name="dc"><?php echo $option1; ?> </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Flight Name</td>
                        <td>
                            <select name="fn"><?php echo $option2; ?> </select>
                        </td>
                    </tr>

                </table>

                <input type="submit" name= "delete" value = "Delete" />

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
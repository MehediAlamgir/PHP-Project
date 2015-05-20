<?php
 session_start();
 $name = $_SESSION['user_name'];

    if(isset($_POST['cancel']))
    {
        include("db.php");

        $from = $_POST['from'];
        $to = $_POST['to'];
		
		$q1 = "SELECT * from book WHERE name='$name' AND fromm = '$from' AND too = '$to' ";
		$r2 = mysql_query($q1);
		$row1 = mysql_fetch_array($r2);


        if($from == "" || $to == "")
        {
            $message = "You Have to Fill Up Both Field";
        }
		
		
		else if(!$row1)
		{
			$message = "Invalid Selection";
		}

        else
        {
            $query = "DELETE from book WHERE `name`='$name' AND `fromm`='$from' AND `too`='$to' ";
            mysql_query($query);
            $message = "Ticket Cencelled";
        }

    }
 ?>

 <html>
     <head>
        <title>Cancel Ticket</title>
     </head>
     <body>
      <h2 align = "center">Cancel Ticket</h2>    
     <a href = "user.php"><button>Back</button></a>

            <?php                
                include("db.php") ;

                $query = "SELECT * FROM book WHERE name = '$name' ";
                $res = mysql_query($query);
				$tbl = "<table border='1' cellspacing='5' cellpadding='5' align = 'center'><tr>
                   <th>From</th>
                    <th>To</th>
                     <th>No of Seat</th>
                    <th>Class</th>
                    <th>Status</th>                   
                </tr>";	

                while($row = mysql_fetch_array($res))
                {
                    echo "<center>";
                    echo "<table   border = '1' cellspacing = '5' cellpadding = '5'>";
					
					$tbl .= "<tr><td>" . $row['fromm'] . "</td><td>" . $row['too'] . "</td>" . "<td>" . $row['no_of_seat'] . "</td>" . "<td>" . $row['class'] . "</td>" . "<td>" . $row['status'] . "</td><tr>";

                }
				
				$tbl .= "</table>";
				echo $tbl;


           $option1 =  "<option></option>";
           $option2 =  "<option></option>";

           $q = "SELECT * FROM airport";
           $res = mysql_query($q);

           while($row = mysql_fetch_array($res))
           {
              $country = $row['country'];
              $airportname = $row['airportname'];

              $option1 .= "<option>$country</option>";
              $option2 .= "<option>$airportname</option>";
           }

         ?>

         </br></br></br>

         <form action = "cancelticket.php" method = "post">
         <center>
            <table border = '1' cellspacing = '10' cellpadding = '10' >
                <tr>
                    <td>From</td>
                    <td>
                    <select name="from"><?php echo $option1; ?></select>
                    </td>
                </tr>
                 <tr>
                     <td>To</td>
                   <td>
                    <select name="to"><?php echo $option1; ?></select>
                    </td>
                </tr>
            </table>

            <input type="submit" name = "cancel" value = "Cancel" />

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
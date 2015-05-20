<?php
session_start();
include("db.php") ;

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

           if(isset($_POST['maps']))
           {
                  $_SESSION["fc"] = $_POST["from"];
                   $_SESSION["tc"] =$_POST["to"];

                   if($_POST["from"] == "" || $_POST["to"] == "")
                   {
                       $message = "You Have to Fill Up Both Field";
                   }
                   else
                   {
						header("Location:umaps.php");
                   }

           }

?>

<html>
<body>
         <a href = "user.php"><button>Back</button></a>
  <form action = "uroutemaps.php" method = "post">
         <center>
            <table border = '1' cellspacing = '10' cellpadding = '10' >
                <tr>
                    <td>From</td>
                    <td>
                    <select name="from">
                    <?php
                         echo $option1;
                    ?>
                    </select>
                    </td>
                </tr>
                 <tr>
                     <td>To</td>
                   <td>
                    <select name="to">
                    <?php
                         echo $option1;
                     ?>
                    </select>
                    </td>
                </tr>
            </table>

            <input type="submit" name = "maps" value = "Click" />

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

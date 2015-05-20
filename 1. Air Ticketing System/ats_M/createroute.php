<?php
    if(isset($_POST["create"]))
    {
      include("db.php");
       $from = trim($_POST["arrival"]);
       $to = trim($_POST["departure"]);
       $ta = trim($_POST["transit"]);
       $th = trim($_POST["th"]);
       $fn = trim($_POST["fn"]);

       if($from == "" || $to == "" || $ta == "" || $th == "" || $fn == "")
       {
         $message = "You Have to Fill UP All Information" ;
       }

       else
       {

         $query = "INSERT INTO route(`dairport`,`aairport`,`flightname`,`transitairport`,`transithour`) VALUES ('$to','$from','$fn','$ta','$th')";
         mysql_query($query);
         $message = " New Route Created";
       }

    }
?>


<html>

    <head>
            <title>Create Route</title>
    </head>

  <body>

  <h2 align = "center">Create New Route</h2>
  <a href = "admin.php"><button>Back</button></a>

  <?php

    include("db.php");
    $option1="<option></option>";
    $option2="<option></option>";
    $option3="<option></option>";

    $sql = "SELECT * FROM route";
	$result = mysql_query($sql);

    while($row = mysql_fetch_array($result))
	{
		$arivalairport = $row["aairport"];
		$option1.="<option>$arivalairport</option>";

        $departureairport = $row["dairport"];
        $option2.="<option>$departureairport</option>";
        $option3.=$option2;
	}


  ?>

    <form action = "createroute.php" method = "post">
        <center>
            <table  border = "1" cellspacing = "15" cellpadding = "15">

                <tr>
                    <td>
                     <label>From</label>
                    </td>
                    <td>
                          <select name = "arrival"><?php echo $option1 ; ?></select>
                     </td>

                </tr>



             <tr>
                    <td>
                         <label>To</label>
                    </td>
                    <td>
                          <select name = "departure"><?php echo $option2 ; ?></select>
                    </td>

             </tr>

              <tr>
                    <td>
                         <label>Transit Airport</label>
                    </td>
                    <td>
                          <select name = "transit"><?php echo $option3 ; ?></select>
                    </td>

              </tr>

                 <tr>
                    <td>
                         <label>Transit Hour</label>
                    </td>
                    <td>
                          <input type="text" name="th" />
                    </td>

              </tr>
                <tr>
                    <td>
                         <label>Flight Name</label>
                    </td>
                    <td>
                          <input type="text" name="fn" />
                    </td>

              </tr>

             </table>

             <input type="submit" name = "create" value = "create" />      <br/><br/><br/>

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
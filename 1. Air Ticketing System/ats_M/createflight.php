<?php
    if(isset($_POST["createflight"]))
    {
        include("db.php");

      $from = trim($_POST["from"]);
      $to = trim($_POST["to"]);
      $fn = trim($_POST["fn"]);
      $fno = trim($_POST["fno"]);
      $ts = trim($_POST["ts"]);
      $dt = trim($_POST['dt']);
      $at = trim($_POST['at']);
      $day = trim($_POST['day']);
      $sp = trim($_POST['sp']);
      $ta = trim($_POST['ta']);
      $th = trim($_POST['th']);
		
		$message = "";

     if($from == "" || $to == "" || $fn == "" || $fno == "" || $ts == "" || $dt == "" || $at == "" || $sp == "" || $ta == "" || $th == "" || $day == "")
       {
         $message = "You Have to Fill UP All Information" ;
       }

       else
       {

         $query = "INSERT INTO flight(`flightname`,`flightno`,`totalseat`,`destination`,`source`) VALUES ('$fn','$fno','$ts','$to','$from')";
         mysql_query($query);

         $q = "INSERT INTO schedule(flightname,dtime,atime,day,seatprice,transithour,transitairport) VALUES('$fn','$dt','$at','$day','$sp','$th','$ta')";
         mysql_query($q);

         $message = " New Flight Created";
       }
	   
	   echo "<center>";
	   if(isset($message))
       {
			echo "<font color = 'red' ><h2>$message</font></h2>";
        	$message="";
        }
		echo "</center>";
     }

?>


<html>

    <head>
        <title>Create Flight</title>
    </head>

    <body>
         <h2 align = "center">Create New Flight</h2>
         <a href = "admin.php"><button>Back</button></a> 

           <form action="createflight.php" method="post">
                <center>

                    <table border = "1" cellspacing = "5" cellpadding = "5">

                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text" name = "from" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>To</label>
                            </td>
                            <td>
                                <input type="text" name = "to" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Flight Name</label>
                            </td>
                            <td>
                                <input type="text" name = "fn" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Flight No</label>
                            </td>
                            <td>
                                <input type="text" name = "fno" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Total Seat</label>
                            </td>
                            <td>
                                <input type="text" name = "ts" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Departure Time</label>
                            </td>
                            <td>
                                <input type="text" name = "dt" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Arrival Time</label>
                            </td>
                            <td>
                                <input type="text" name = "at" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Day</label>
                            </td>
                            <td>
                                <input type="text" name = "day" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Seat Price</label>
                            </td>
                            <td>
                                <input type="text" name = "sp" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Transit Airport</label>
                            </td>
                            <td>
                                <input type="text" name = "ta" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Transit Hour</label>
                            </td>
                            <td>
                                <input type="text" name = "th" />
                            </td>
                        </tr>

                    </table>

                    <input type="submit" name="createflight" value ="Create" />

                    <label>
        		<?php

        			
        		?>

        	</label>

                </center>

           </form>


    </body>

</html>
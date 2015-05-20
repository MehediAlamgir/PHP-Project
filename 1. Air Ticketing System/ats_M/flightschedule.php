<html>
    <head>
        <title>Flight Schedule</title>
    </head>

    <body>
        <h3 align = "center">Flight Schedule</h3>
        <a href = "admin.php"><button>Back</button></a> 
		
        <?php

            include("db.php") ;

            $query = "SELECT flight.flightname, flight.flightno,flight.destination,flight.source,schedule.dtime,schedule.atime,schedule.day,schedule.transitairport,schedule.transithour FROM flight INNER JOIN schedule ON flight.flightname=schedule.flightname";
            $result = mysql_query($query);
				
			$tbl = "<table border='1' cellspacing='5' cellpadding='5' align = 'center'><tr>
                    <th>Flight Name</th>
                    <th>Flight No</th>
                    <th>Destination</th>
                    <th>Source</th>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
                    <th>Day</th>
                    <th>Transit Airport</th>
                    <th>Transit Hour</th>
                </tr>";	
            while($row = mysql_fetch_array($result))
            {		
					
			
              $fn = $row['flightname'];
                $fno = $row['flightno'];
                $destination =   $row['destination'] ;
                $source =  $row['source'] ;
                $dtime =   $row['dtime'] ;
                $atime =   $row['atime'] ;
                $day =    $row['day'] ;
                $ta =     $row['transitairport'] ;
                $th =      $row['transithour'] ;
              
				$tbl .= "<tr><td>" . $fn . "</td><td>" . $fno . "</td>" . "<td>" . $destination . "</td>" . "<td>" . $source . "</td>" . "<td>" . $dtime . "</td>" . "<td>" . $atime . "</td>" . "<td>" . $day . "</td>" . "<td>" . $ta . "</td>" . "<td>" . $th . "</td><tr>";
			  
            }
			$tbl .= "</table>";
			echo $tbl;

        ?>
		
		

    </body>
</html>
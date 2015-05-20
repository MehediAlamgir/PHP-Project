<?php
    include("db.php");

       echo " <h2 align = 'center'>Passenger's Statistics</h2> ";
       echo "  <a href = 'admin.php'><button>Back</button></a> ";

    $query = "SELECT * from book";
    $res = mysql_query($query);
	
	$tbl = "<table border='1' cellspacing='5' cellpadding='5' align = 'center'><tr>
                    <th>Name</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Arrival Airport</th>
                    <th>Destination Airport</th>
                    <th>No of Seat</th>
                    <th>Class</th>                   
                    <th>Status</th>
                </tr>";	

    while($row = mysql_fetch_array($res))
    {
         $name = $row['name'];
         $from = $row['fromm'];
         $to = $row['too'];
         $aa = $row['arrivalairport'];
         $da = $row['destinationairport'];
         $nos = $row['no_of_seat'];
         $class = $row['class'];
         $status = $row['status'];
		 
		 $tbl .= "<tr><td>" . $name . "</td>"."<td>" . $from . "</td>" . "<td>" . $to . "</td>" . "<td>" . $aa . "</td>" . "<td>" .$da . "</td>" . "<td>" . $nos . "</td>" . "<td>" . $class . "</td>" . "<td>" . $status . "</td><tr>";
		 
    }
	
	$tbl .= "</table>";
	echo $tbl;
?>

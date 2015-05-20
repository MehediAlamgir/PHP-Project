<?php
    session_start();    
	require_once("../database.php");
	
	// Shaphil
	if($_GET["func"] == "add_airlines")
		add_airlines();
	if($_REQUEST["func"] == "update_flight_info")
	{
		update_flight_info();
	}
	if($_GET["func"] == "AddAirport")
		AddAirport();			
	if($_REQUEST["func"] == "update_airport_info")
	{
		update_airport_info();
	}
	if ($_REQUEST["func"] == "create_new_schedule")
	{
		create_new_schedule();
	}
	if ($_REQUEST["func"] == "update_schedule")
	{
		update_schedule();
	}
	if ($_REQUEST["func"] == "schedule_info")
	{
		schedule_info();
	}
	if ($_GET["func"] == "plane_info") //Mehedi
	{
		plane_info();
	}
   
	if ($_REQUEST["func"] == "route_info")	//Mehedi
	{
		route_info();
	}
   
   
	if($_REQUEST["func"] == "search_schedule_info")	//Mehedi
	{
		search_schedule_info();
	}
	if($_REQUEST["func"] == "booking_tickets")	//Shourov
	{
		booking_tickets();
	}
  
	if($_REQUEST["func"] == "cancel_booking")	//Shourov
	{
		cancel_booking();
	}
	
	function add_airlines()
	{
		$name = trim($_GET["airlines_name"]);
		$id = trim($_GET["airlines_id"]);
		$q = "INSERT INTO AIRLINE VALUES('$id', '$name')";
		$stid = oci_parse($GLOBALS['conn'], $q);
		oci_execute($stid);
		
		oci_free_statement($stid);
		$r = "SELECT * FROM AIRLINE WHERE AIRLINE_ID = '$id'";
		$stid = oci_parse($GLOBALS['conn'], $r);
		oci_execute($stid);
		$row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
		echo "<tr><th>AIRLINE_ID</th><th>AIRLINES_NAME</th></tr>";
		echo "<tr><td>" . $row['AIRLINE_ID'] . "</td><td>" . $row['NAME'] . "</td></tr>";
	}
	//
	function update_flight_info()
	{
		$cnt = 0;
		$NewFlightID = trim($_REQUEST["NewFlightID"]);
		$economy_class = trim($_REQUEST["economy"]);
		$business_class = trim($_REQUEST["business"]);
		$normal_class = trim($_REQUEST["normal"]);
		$CurrFlight_id = trim($_REQUEST["CurrFlight_id"]);
		$active_status = trim($_REQUEST["status"]);
		// work here
		if ($NewFlightID != "")
		{
			$cnt++;
			$sql = "update Seat_Info set FLIGHT_ID='$NewFlightID' where FLIGHT_ID='$CurrFlight_id'";
			$st = oci_parse($GLOBALS['conn'], $sql);
			oci_execute($st);
		}
		
		if ($economy_class != "")
		{
			$cnt++;
			$sql = "update Seat_Info set ECONOMY_SEATS='$economy_class' where FLIGHT_ID='$NewFlightID'";
			$st = oci_parse($GLOBALS['conn'], $sql);
			oci_execute($st);
		}
		
		if ($business_class != "")
		{
			$cnt++;
			$sql = "update Seat_Info set BUSINESS_SEATS='$business_class' where FLIGHT_ID='$NewFlightID'";
			$st = oci_parse($GLOBALS['conn'], $sql);
			oci_execute($st);
		}
		
		if ($normal_class != "")
		{
			$cnt++;
			$sql = "update Seat_Info set NORMAL_SEATS='$normal_class' where FLIGHT_ID='$NewFlightID'";
			$st = oci_parse($GLOBALS['conn'], $sql);
			oci_execute($st);
		}
		if ($active_status != "")
		{
			$cnt++;
			$sql = "update Flight set isactive='$active_status' where FLIGHT_ID='$NewFlightID'";
			$st = oci_parse($GLOBALS['conn'], $sql);
			oci_execute($st);
		}
		
		if ($cnt > 0)
		{
			header("Location: ../admin.php?success_plane=1");
		}
		else
		{
			header("Location: ../admin.php?error_plane=-1");
		}
		
	}	
	//S
	function AddAirport()
	{
		$name = trim($_GET["name"]);
		$lat = trim($_GET["lat"]);
		$lon = trim($_GET["lon"]);
		
		$q = "INSERT INTO airport VALUES('A' || airport_aid.NEXTVAL, '$name', '$lat', '$lon')";
		$st = oci_parse($GLOBALS['conn'], $q);
		oci_execute($st);
		echo "<b>Successfully Added</b>";
	}
	
	function update_airport_info()
	{
		$old_name = trim($_REQUEST["old_name"]);
		$new_name = trim($_REQUEST["new_name"]);
		$lat = trim($_REQUEST["lat"]);
		$lon = trim($_REQUEST["lon"]);
		$cnt=0;
		if($new_name != "")
		{
			$cnt++;
			$sql = "update airport set name='$new_name' where name = '$old_name'";
			$st = oci_parse($GLOBALS['conn'], $sql);
			oci_execute($st);
		}
		if($lat != "")
		{
			$cnt++;
			$sql = "update airport set latitude='$lat' where name = '$new_name'";
			$st = oci_parse($GLOBALS['conn'], $sql);
			oci_execute($st);
		}
		if($lon != "")
		{
			$cnt++;
			$sql = "update airport set longitude='$lon' where name = '$new_name'";
			$st = oci_parse($GLOBALS['conn'], $sql);
			oci_execute($st);
		}
		
		if ($cnt > 0)
		{
			header("Location: ../admin.php?success_air=1");
		}
		else if ($cnt == 0)
		{
			header("Location: ../admin.php?error_air=-1");
		}
	}
	function create_new_schedule()
	{
		$flt_id_s = trim($_REQUEST["flt_id_s"]);
		
		$sat = trim($_REQUEST["sat"]);
		$sun = trim($_REQUEST["sun"]);
		$mon = trim($_REQUEST["mon"]);
		$tue = trim($_REQUEST["tues"]);
		$wed = trim($_REQUEST["wed"]);
		$thu = trim($_REQUEST["thus"]);
		$fri = trim($_REQUEST["fri"]);
		
		$dep_time = trim($_REQUEST["dep_time"]);
		$arr_time = trim($_REQUEST["arr_time"]);
		
		$sql = "iNSERT INTO Schedule VALUES('$sat', '$sun', '$mon', '$tue', '$wed', '$thu', '$fri', '$dep_time', '$arr_time', '$flt_id_s')";
		$st = oci_parse($GLOBALS['conn'], $sql);
		oci_execute($st);
		
		header("Location: ../admin.php");
	}
	function update_schedule()
	{
		$flt_id_s = trim($_REQUEST["flt_id_s"]);
		
		$sat = trim($_REQUEST["sat"]);
		$sun = trim($_REQUEST["sun"]);
		$mon = trim($_REQUEST["mon"]);
		$tue = trim($_REQUEST["tues"]);
		$wed = trim($_REQUEST["wed"]);
		$thu = trim($_REQUEST["thus"]);
		$fri = trim($_REQUEST["fri"]);
		
		$dep_time = trim($_REQUEST["dep_time"]);
		$arr_time = trim($_REQUEST["arr_time"]);
		
		$sql = "Update Schedule Set sat='$sat', sun='$sun', mon='$mon', tue='$tue', wed='$wed', thu='$thu', fri='$fri', DEPARTURE='$dep_time', ARRIVAL='$arr_time' Where FLIGHT_ID='$flt_id_s'";
		$st = oci_parse($GLOBALS['conn'], $sql);
		oci_execute($st);
		
		header("Location: ../admin.php");
	}
	function schedule_info()
	{
		$id = trim($_REQUEST["flt_id"]);
		$sql = "Select * From Flight Where FLIGHT_ID='$id'";
		$st = oci_parse($GLOBALS['conn'], $sql);
		oci_execute($st);
		$row = oci_fetch_array($st, OCI_ASSOC + OCI_RETURN_NULLS);
		echo "<table border='2' cellspacing='1' cellpadding='4' style='border-color: green; text-shadow: 5px 4px 9px green;'>\n";
		echo "<tr><th>FLIGHT_ID</th><th>ORIGIN</th><th>DESTINATION</th><th>isActive</th><th>AIRLINE_ID</th></tr>\n";
		echo "<tr>\n";
		foreach($row as $item)
		{
			echo "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
		}
		echo "</tr>\n</table>\n";
		
		oci_free_statement($st);
		$sql = "Select * From Schedule Where FLIGHT_ID='$id'";
		$st = oci_parse($GLOBALS['conn'], $sql);
		oci_execute($st);
		$row = oci_fetch_array($st, OCI_ASSOC + OCI_RETURN_NULLS);
		if(!$row)
			echo "<br /><b>This flight has not yet been scheduled.</b>";
		else
		{
			echo "<br /><br /><table border='2' cellspacing='1' cellpadding='4' style='border-color: green; text-shadow: 5px 4px 9px green;'>\n";
			echo "<tr><th>SAT</th><th>SUN</th><th>MON</th><th>TUE</th><th>WED</th><th>THU</th><th>FRI</th><th>DEPARTURE</th><th>ARRIVAL</th><th>FLIGHT_ID</th></tr>\n";
			echo "<tr>\n";
			foreach($row as $item)
			{
				echo "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
			}
			echo "</tr>\n</table>\n";
		}
	}
	
	function plane_info() 	//Mehedi
	{
		$plane_id = $_GET["plane_id"];
		
		$sql = "select * from flight where FLIGHT_ID='$plane_id'";
		$query = oci_parse($GLOBALS['conn'],$sql);
		oci_execute($query);
		
		$row = oci_fetch_array($query);
		
		$airline_id = $row["AIRLINE_ID"];
		
		$sql = "select * from Airline where AIRLINE_ID='$airline_id'";
		$query = oci_parse($GLOBALS['conn'],$sql);
		oci_execute($query);
		
		$row = oci_fetch_array($query);
		
		//echo $row['AIRLINE_ID'];
		
		echo '<tr><td>PLANE ID</td><td>' . $row["AIRLINE_ID"] . '</td></tr>';
		//echo '<tr><td>PLANE ID</td><td>$row["AIRLINE_ID"]</td></tr>';
		echo '<tr><td>PLANE NAME</td><td>' . $row["NAME"] . '</td></tr>';
		
		$sql = "select * from flight where flight_id='$plane_id'";
		$query = oci_parse($GLOBALS['conn'],$sql);
		oci_execute($query);
		$row = oci_fetch_array($query);
		
		$status = "ACTIVE";
		if ($row["ISACTIVE"] == 0)
		{
			$status = "INACTIVE";
		}
		echo "<tr><td>PLANE STATUS</td><td>$status</td></tr>";
	}
	
	
	function route_info()	//Mehedi
	{
		$route_id = trim($_GET["route_id"]);
		//echo $GLOBALS['conn'];
		/*$sql = "select * from fare where flight_id='$route_id'";
		$query = oci_parse( $GLOBALS['conn'],$sql);
		oci_execute($query);
		
		$row = oci_fetch_array($query,OCI_BOTH);
		
		echo "<tr><td>FLIGHT ID</td><td>" . $row['FLIGHT_ID'] ."</td></tr>";
		// src
		$sql = "select * from flight where flight_id='$route_id' ";
		$query = oci_parse($GLOBALS['conn'],$sql);
		oci_execute($query);           
		$row = oci_fetch_array($query,OCI_BOTH);
		
		$origin_airport_id = $row["ORIGIN"];
		$destination_airport_id = $row["DESTINATION"];
		
		$sql = "select * from airport where airport_id='$origin_airport_id' ";
		$query = oci_parse($GLOBALS['conn'],$sql);
		oci_execute($query);			
	   
		$row = oci_fetch_array($query,OCI_BOTH);
		
		
		if ($row)
		{
			echo "<tr><td>SOURCE AIRPORT</td><td>" . $row["NAME"] . "</td></tr>";
			$_SESSION["src_lat"] = $row["LATITUDE"];
			$_SESSION["src_lon"] = $row["LONGITUDE"];
			
			//echo  $_SESSION["src_lat"] ;
		}
		else
		{
			echo "<tr><td>SOURCE AIRPORT</td><td>" . "N\A" . "</td></tr>";
		}
	   
		
		// dest
		$sql = "select * from airport where airport_id='$destination_airport_id' ";
		$query = oci_parse($GLOBALS['conn'],$sql);
		oci_execute($query);			
	   
		$row = oci_fetch_array($query,OCI_BOTH);
		
		if ($row)
		{
			echo "<tr><td>DESTINATION AIRPORT</td><td>" . $row["NAME"] . "</td></tr>";
			$_SESSION["dest_lat"] = $row["LATITUDE"];
			$_SESSION["dest_lon"] = $row["LONGITUDE"];

			
		}
		else
		{
			echo "<tr><td>DESTINATION AIRPORT</td><td>" . "N\A" . "</td></tr>";
		}
		//FARE
		
		$sql = "select * from fare where flight_id='$route_id'";
		$query = oci_parse($GLOBALS['conn'],$sql);
		oci_execute($query);			
		$row = oci_fetch_array($query,OCI_BOTH);
		
		if($row)
		{
			echo "<tr><td>ECONOMY ClASS</td><td>" . $row["ECONOMY"] . "</td></tr>";
			echo "<tr><td>BUSINESS ClASS</td><td>" . $row["BUSINESS"] . "</td></tr>";
			echo "<tr><td>NORMAL ClASS</td><td>" . $row["NORMAL"] . "</td></tr>";

		}
		else
		{
			
		}*/
		$flight_id  = $route_id;
		$sql = "BEGIN showFareInfo(:f_id , :eco , :bus , :nor); END;";
					$stmt = oci_parse($GLOBALS['conn'] , $sql);
					
					oci_bind_by_name($stmt , ':f_id' , $flight_id , 32);
					oci_bind_by_name($stmt , ':eco' , $eco , 32);
					oci_bind_by_name($stmt , ':bus' , $bus , 32);
					oci_bind_by_name($stmt , ':nor' , $nor , 32);
					oci_execute($stmt);
					$tmp = "<tr><th>FLIGHT_ID</th><th>ECONOMY</th><th>BUSINESS</th><th>NORMAL</th></tr>";
					$tmp .= "<tr><td>" . $flight_id	 . "</td><td>" . $eco . "</td><td>" . $bus . "</td><td>" . $nor . "</td></tr>";
					
					echo $tmp;
		
	}
  
	
	function search_schedule_info()	//Mehedi
	{
		$from = trim($_REQUEST["from"]);
		$to = trim($_REQUEST["to"]);
		//echo  $from."<br>";
		//echo  $to;
		
	  /*  $sql = "select * from airport where name = '$from'";
		$q1 = oci_parse($GLOBALS['conn'],$sql);
		oci_execute($q1);
		$r1 = oci_fetch_array($q1, OCI_BOTH);
		
		$origin_airport_id = $r1["AIRPORT_ID"];
		
		//echo  $origin_airport_id ;
		
		$sql2 = "select * from airport where name = '$to'";
		$q2 = oci_parse($GLOBALS['conn'],$sql2);
		oci_execute($q2);
		$r2 = oci_fetch_array($q2, OCI_BOTH);
		
		$destination_airport_id = $r2["AIRPORT_ID"];
		*/
		//$sql3 = "select * from flight where origin = '$origin_airport_id' ";
		$sql3 = "select * from flight where origin = '$from' ";
		$q3 = oci_parse($GLOBALS['conn'],$sql3);
		oci_execute($q3);
		$r3 = oci_fetch_array($q3, OCI_BOTH);
		
		$origin_flight_id = $r3["FLIGHT_ID"];
		//echo $origin_flight_id;
		
		
		$sql4 = "select * from flight where destination = '$to' ";
		$q4 = oci_parse($GLOBALS['conn'],$sql4);
		oci_execute($q4);
		$r4 = oci_fetch_array($q4, OCI_BOTH);
		
		$destination_flight_id = $r4["FLIGHT_ID"];
		
		$sql5 = "select * from schedule where flight_id='$origin_flight_id'";
		$q5 = oci_parse($GLOBALS['conn'],$sql5);
		oci_execute($q5);
		
		$r5 = oci_fetch_array($q5, OCI_BOTH);
		//echo  $r5["FLIGHT_ID"];
	   
			if($r5)
			{   
			   
				echo "<tr><td>FLIGHT ID</td><td>" . $r5["FLIGHT_ID"]. "</td></tr>";
				$dep_time = $r5["DEPARTURE"];
				echo "<tr><td>DEPARTURE TIME</td><td>" . $dep_time. "</td></tr>";
				$arr_time = $r5["ARRIVAL"];
				echo "<tr><td>ARRIVAL TIME</td><td>" . $arr_time. "</td></tr>";
				
					$sat = $r5["SAT"];
					if ($sat == "1")
					{
						echo "<tr><td>DAY</td><td>" ."Saturday". "</td></tr>";
					}
					$sun = $r5["SUN"];
					if ($sun == "1")
					{
						echo "<tr><td>DAY</td><td>" ."Sunday". "</td></tr>";
					}
					$mon = $r5["MON"];
					if ($mon == "1")
					{
						echo "<tr><td>DAY</td><td>" ."Monday". "</td></tr>";
					}
					$tues = $r5["TUE"];
					if ($tues == "1")
					{
						echo "<tr><td>DAY</td><td>" ."Tuesday". "</td></tr>";
					}
					$wed = $r5["WED"];
					if ($wed == "1")
					{
						echo "<tr><td>DAY</td><td>" ."Wednesday". "</td></tr>";
					}
					$thus = $r5["THU"];
					if ($thus == "1")
					{
						echo "<tr><td>DAY</td><td>" ."Thursday". "</td></tr>";
					}
					$fri = $r5["FRI"];
					if ($fri == "1")
					{
						echo "<tr><td>DAY</td><td>" ."Friday". "</td></tr>";
					}
			}    

			else
			{
				echo "error";
			}
	}
	
	function booking_tickets()	//Shourov
	{
		$flight_id = ($_REQUEST["flight_id"]);
		
		//$user_id = $_SESSION["user_id"];
		$user_id = $_SESSION["email"];
		//echo $user_id;
		
		$eco = (int)trim($_REQUEST["eco"]);
		$exe = (int)trim($_REQUEST["exe"]);
		$fir = (int)trim($_REQUEST["fir"]);
		$flight_date = trim($_REQUEST["flight_date"]);
		$flight_date  ="2014-08-26";
		
		$arr = explode("-" , $flight_date);
		$k = $arr[1];
				
		$pp = $arr[2] . "-";
		if ($k == '01')
		{
			$pp .= "JAN";
		}
		if ($k == '02')
		{
			$pp .= "FEB";
		}
		if ($k == '03')
		{
			$pp .= "MAR";
		}
		if ($k == '04')
		{
			$pp .= "APR";
		}
		if ($k == '05')
		{
			$pp .= "MAY";
		}
		if ($k == '06')
		{
			$pp .= "JUN";
		}
		if ($k == '07')
		{
			$pp .= "JUL";
		}
		if ($k == '08')
		{
			$pp .= "AUG";
		}
		if ($k == '09')
		{
			$pp .= "SEP";
		}
		if ($k == '10')
		{
			$pp .= "OCT";
		}
		if ($k == '11')
		{
			$pp .= "NOV";
		}
		if ($k == '12')
		{
			$pp .= "DEC";
		}
		
		$pp .= "-" .  $arr[0];
		$flight_date = $pp;
		
		$tmp = "select passanger_id from userTable where mail='$user_id'";
		$stmt = oci_parse($GLOBALS['conn'] , $tmp);
		oci_execute($stmt);
		$row = oci_fetch_array($stmt , OCI_BOTH);
		$user_id = $row["PASSANGER_ID"];
		
		//echo $user_id;
		
		//echo $flight_date . "<br>";
		//echo $eco . "<br>";
		//echo $exe . "<br>";
		//echo $fir . "<br>";
		//echo $flight_id . "<br>";
		
		$sql = "insert into reservation Values('R' || resevation_rid.NEXTVAL , :flight_date , :eco , :exe , :fir , :flight_id , :user_id)";
		//$sql = "insert into reservation values('R' || resevation_rid.NEXTVAL , $flight_date , $eco , $exe , $fir , $flight_id , $user_id)";
		//$sql = "insert into reservation values('R6' , '12-FEB-14' , 20,  50 , 20 ,  'BG101', 'p4')";
		$query =  oci_parse($GLOBALS['conn'] , $sql);
			
		oci_bind_by_name($query,':flight_date',$flight_date);
		oci_bind_by_name($query,':eco',$eco);
		oci_bind_by_name($query,':exe',$exe);
		oci_bind_by_name($query,':fir',$fir);
		oci_bind_by_name($query,':flight_id',$flight_id);
		oci_bind_by_name($query,':user_id',$user_id);
		
	
		oci_execute($query);
		
		header("Location: ../user.php?booking_success=1");
		
	}
	
	
	function cancel_booking()	//Shourov
	{
		$user_id = $_SESSION["pas_id"];
		$flight_id = $_REQUEST["flight_id"];
		echo $user_id;
		echo $flight_id;
		
		$sql = "delete  from reservation where PASSANGER_ID='$user_id' and FLIGHT_ID='$flight_id'";
		$stmt = oci_parse($GLOBALS['conn'] , $sql);
		oci_execute($stmt);
		header("Location: ../user.php?success_cancel=1");
		
	}
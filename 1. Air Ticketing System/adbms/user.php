<?php
    session_start();
    include_once("navbar.php");
    include_once("database.php");
	
	/*$conn = oci_connect('system', 'tiger', 'localhost/XE');
	if(!$conn)
	{
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		
	}*/
	$email = $_SESSION['email'] ; 
	
	$sql = "SELECT name from userTable where mail = '$email' ";
	$query = oci_parse($conn, $sql);
	oci_execute($query);
	
	$row = oci_fetch_array($query,OCI_BOTH);
	$name = $row["NAME"];
	
    if(!isset($_SESSION["status"]))
    {
        header("Location: index.php");
    }
	
	if(isset($_REQUEST["success_cancel"]))
    {
        echo ' <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4 align="center">Booking Canceled</h4>' . 
            '</div>' . '</br>';
			
    }
	
	
	if(isset($_REQUEST["booking_success"]))
    {
        echo ' <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4 align="center">Booked Sucessfully</h4>' . 
            '</div>' . '</br>';
    }
    
?>

<head>
    <style>
        h3
        {
            text-shadow: 2px 5px 7px green;
        }
        h2
        {
            text-shadow: 2px 5px 7px green;
        }
    </style>
</head>


<body style="background-color: #FFFFFF;">
    <!--<h1 align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AIRLINES TICKETING SYSTEM</h1>-->
    <!--<h2 align='center'>WelCome, <?php echo $_SESSION["email"]; ?></h2> -->
	<h2 align='center'>WelCome, <?php echo $name; ?></h2>

    <div class="container-fluid">
    <div class="row-fluid padding_down" style="color: green;" align="center">
    <div  id="row-fluid" style="color: green;">
            <div class="span8 well offset2" style="background-color: transparent; border-color: green; padding: 30px;">
                <div>
                    <h3>BOOKING ACTIONS</h3>
					
					<a href="#show_route_info" class="btn btn-block" style="background-color: transparent; border-color: green; text-shadow: 5px 4px 9px green;">FARE INFORMATION</a>
                    <a href="#book_tickets" class="btn btn-block" style="background-color: transparent; border-color: green; text-shadow: 5px 4px 9px green;">BOOK TICKETS</a>
                    <a href="#cancel_booking" class="btn btn-block" style="background-color: transparent; border-color: green; text-shadow: 5px 4px 9px green;">CANCEL BOOKING</a>
                </div>
            </div>
            
            <div class="row">
                <div class="span4 well offset2" id="show_route_info" style="background-color: transparent; border-color: green; margin-left: 33%;">
                    <h3>FARE INFORMATION</h3>
                    
					<?php
						
						$sql = "SELECT flight_id from fare";
						$query1 = oci_parse($conn,$sql);
						oci_execute($query1);
						
						$flight_id = '<option selected = "selected" disabled = "disabled">Select Flight Number</option>';
						
						while($row1 = oci_fetch_array($query1, OCI_BOTH))
						{
							$flight_id .= '<option>' .$row1["FLIGHT_ID"] . '</option>';
						}
					?>
                    
                    
                <select id="route_id" onchange="loadRouteDetails()">
					<?php
						echo $flight_id;
					?>
                </select>
				
                <table id="route_details" border="2" cellspacing="1" cellpadding="4" style="border-color: green; text-shadow: 5px 4px 9px green;">
					
				</table>
                </div>
            </div>
            
            <!-- book tickets -->
            
            <div class="row">
                <div class="span4 well offset2" id="book_tickets" style="background-color: transparent; border-color: green; margin-left: 33%; text-shadow: 5px 4px 9px green;">
                <h3>BOOK TICKETS</h3>
                
				
					<?php
						$sql = "select * from flight";
						$stmt = oci_parse($conn , $sql);
						oci_execute($stmt);
						$tmp = "<option selected='selected' disabled='disabled'>Select A Flight</option>";
						while ($row = oci_fetch_array($stmt))
						{
							$tmp .= "<option>" . $row["FLIGHT_ID"] . "</option>";
						}
						
					?>
                    <select id="click_flight_id" onchange="loadFlightDetails()">
                        <?php echo $tmp ; ?>
                    </select>
                    <table id="flight_details" border="2" cellspacing="1" cellpadding="4" style="border-color: green; text-shadow: 5px 4px 9px green;">
                                 
                    </table>
                    <h4><code>10% Extra Airfare For Executive and 5% For Economy Class</code></h4>
                    <br>
                    <label>
						<table cellspacing = "5">
							<tr>
								<td>Number Of Tickets Of Economy class</td>
								<td><input type="text" id="book_eco" name="book_eco" placeholder="Number Of Tickets Of Economy class" /></td>
							</tr>
							<tr>
								<td>Number Of Tickets Of Business class</td>
								<td><input type="text" id="book_exe" name="book_exe" placeholder="Number Of Tickets Of Executive class" /></td>
							</tr>
							<tr>
								<td>Number Of Tickets Of First class</td>
								<td><input type="text" id="book_fir" name="book_fir" placeholder="Number Of Tickets Of First class" /></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="date" id="book_date" name="book_date" placeholder="Date" /></td>
							</tr>
                        </table>
                        <button onclick="bookTickets()" class="btn btn-info">Book Tickets!</button>    
                    </label>
                </div>
            </div>
            
            <!-- cancel booking -->
                
        <div class="row">
            <div class="span4 well offset2" id="cancel_booking"  style="background-color: transparent; border-color: green; margin-left: 33%;">
                <h3>CANCEL BOOKING</h3>
                
				<?php
				
					//echo $_SESSION['email'];
						
					$tmp = "select passanger_id from userTable where mail='" . $_SESSION['email'] ."'";
					$stmt = oci_parse($GLOBALS['conn'] , $tmp);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt , OCI_BOTH);
					$user_id = $row["PASSANGER_ID"];
					
					$_SESSION["pas_id"] = $user_id;

						//echo $user_id;
						$sql = "select flight_id from reservation where PASSANGER_ID='$user_id'";
						$stmt = oci_parse($conn , $sql);
						oci_execute($stmt);
						$tmp = "<option selected='selected' disabled='disabled'>Select A Flight</option>";
						while ($row = oci_fetch_array($stmt))
						{
							$tmp .= "<option>" . $row["FLIGHT_ID"] . "</option>";
						}
						
				?>
				
				
                <select id="select_flight">
                   <?php echo $tmp; ?>
                </select>
				
		</table>
                <br>
                <button onclick="cancelBooking()" class="btn btn-warning">Cancel</button>
            </div>
        </div>
           
    </div>
    </div>
    </div>
	<br />
	<br />
	<br /><hr />
	<footer style="color: green">
            <p align="center">&copy; Group404!</p>
    </footer>
</body>

    

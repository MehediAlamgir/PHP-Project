<?php
    session_start();
    include_once("navbar.php");
    require_once("database.php");
    if(!isset($_SESSION["status"]))
    {
        header("Location: logout.php");
    }
	
	$flag = false;
	if(isset($_POST["submit_plane_info"]))
	{
		$id = $_POST['flt_id'];
		$src = $_POST['flt_origin'];
		$dest = $_POST['flt_dest'];
		$business = $_POST['business_seats'];
		$eco = $_POST['economy_seats'];
		$normal = $_POST['normal_seats'];
		$isActive = $_POST['flight_isActive'];
		$AirlineID = $_POST['airline_id'];
		
		$q = "Insert into flight values('$id', '$src', '$dest', '$isActive', '$AirlineID')";
		$st = oci_parse($GLOBALS['conn'], $q);
		oci_execute($st);
		oci_free_statement($st);		
		$q = "Insert into Seat_Info values('S' || seat_info_sid.NEXTVAL, '$eco', '$business', '$normal', '$id')";
		$st = oci_parse($GLOBALS['conn'], $q);
		oci_execute($st);
		$flag = true;
	}
    
?>

<head>
	<meta charset='utf-8'>

	<title>Timepicker for jQuery &ndash; Demos and Documentation</title>
	<meta name="description" content="A lightweight, customizable jQuery timepicker plugin inspired by Google Calendar. Add a user-friendly javascript timepicker dropdown to your app in minutes." />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<script type="text/javascript" src="jquery.timepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="jquery.timepicker.css" />

	<script type="text/javascript" src="lib/bootstrap-datepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker.css" />

	<script type="text/javascript" src="lib/site.js"></script>
	<link rel="stylesheet" type="text/css" href="lib/site.css" />
</head>
<body>
    <div class="container-fluid">
    <div class="row-fluid padding_down" style="color: green;" align="center">
        <div class="span3 well" style="background-color: transparent; border-color: green;">
            <div id="top">
                <h4>MANAGE FLIGHTS</h4>
                <ul style="list-style: none;">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle btn btn-block" data-toggle="dropdown" style="background-color: transparent; border-color: green; text-shadow: 5px 4px 9px green;"><b class="fa fa-plane fa-2x"></b>&nbsp; Manage Flight</a>
                        <ul class="dropdown-menu">
                            <li><a href="#add_new_plane" style="text-shadow: 5px 4px 9px green;"><i class="fa fa-plane fa-1x"></i>&nbsp; Add a Flight</a></li>
                            <li><a href="#update_plane_info"><i class="fa fa-plane fa-1x"></i> &nbsp; Update Flight Info</a></li>
                        </ul>
                    </li>
                </ul>
                
                <ul style="list-style: none;"> 
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle btn btn-block" data-toggle="dropdown" style="background-color: transparent; border-color: green; text-shadow: 5px 4px 9px green;"><b class="fa fa-gears fa-2x"></b>&nbsp; Manage Airport</a>
                        <ul class="dropdown-menu">
                            <li><a href="#add_new_airport_info"><i class="fa fa-gears fa-1x"></i>&nbsp; Add New Airport Info!</a></li>
                            <li><a href="#update_airport_info"><i class="fa fa-gears fa-1px"></i> &nbsp; Update Airport Info!</a></li>
                        </ul>
                    </li>
                </ul>                
                
                <ul style="list-style: none;">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle btn btn-block" data-toggle="dropdown" style="background-color: transparent; border-color: green; text-shadow: 5px 4px 9px green;"><b class="fa fa-gears fa-2x"></b>&nbsp; Manage Schedule</a>
                        <ul class="dropdown-menu">
                            <li><a href="#add_new_schedule"><i class="fa fa-gears fa-1x"></i>&nbsp; Create a Schedule!</a></li>
                            <li><a href="#update_schedule"><i class="fa fa-gears fa-1x"></i>&nbsp; Update Schedule</a></li>
                        </ul>
                    </li>
                </ul>
               
                <ul style="list-style: none;">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle btn btn-block" data-toggle="dropdown" style="background-color: transparent; border-color: green; text-shadow: 5px 4px 9px green;"><b class="fa fa-camera fa-2x"></b>&nbsp; &nbsp;View Information!!</a>
                        <ul class="dropdown-menu">
                            <li><a href="#show_flight_info"><i class="fa fa-camera-retro fa-1x"></i>&nbsp; Show Fligt Info</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
		
		<!-- add new airline info -->
		<div class="span8 well row-fluid" id="add_new_airline_info" style="background-color: transparent; border-color: green;">
			<h4>Add new Airlines Info</h4>
			<hr /><br />
			<table cellpadding="5" >
				<tr>
					<td>Name of Airlines:</td>
					<td><input type="text" id="airlines_name" name="airlines_name" /></td>
				</tr>
				<tr>
					<td>Airlines ID:</td>
					<td><input type="text" id="airlines_id" name="airlines_id" /></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><button onclick="add_airlines()" class="btn btn-info">Add</button></td>
				</tr>
			</table>
			<table id="airlines_details" border="2" cellspacing="1" cellpadding="4" style="border-color: green; text-shadow: 5px 4px 9px green;">
			</table>
		</div>
        
        <!-- add plane info -->
		<div class="row-fluid">
        <div class="span8 well offset3" style="background-color: transparent; border-color: green;">
            <div id="add_new_plane">
                <br>
                <br>
                <br>
                <br>
                <h4>Add A Flight</h4>
                <form action="admin.php" method="post" onsubmit="return plane_info();">
				<table cellpadding="5" >
					<tr>
						<td>FLIGHT ID :</td>
                    
                       <td> <input type="text" id="flt_id" name="flt_id" placeholder="FLIGHT ID" /></td>
					 </tr>
                 </table>
                    <label>
                        <select name="normal_seats" id="normal_seats">
                            <option disabled="disabled" selected="selected">NORMAL CLASS</option>
                            <option>0</option>
                            <option>30</option>
                            <option>50</option>
                            <option>70</option>
                        </select>
                        
                        <select name="economy_seats" id="economy_seats">
                            <option disabled="disabled" selected="selected">ECONOMY CLASS</option>
                            <option>0</option>
                            <option>30</option>
                            <option>50</option>
                            <option>70</option>
                        </select>
                        
                        <select name="business_seats" id="business_seats">
                            <option disabled="disabled" selected="selected">BUSINESS CLASS</option>
                            <option>0</option>
                            <option>30</option>
                            <option>50</option>
                            <option>70</option>
                        </select>
                    </label>
					<label>
					
						
						<label>Source Airport						
					
					
					<select id="flt_origin" name="flt_origin">
					<?php
						$q = "select AIRPORT_ID from airport";
						$st = oci_parse($GLOBALS['conn'], $q);
						oci_execute($st);
						while($row = oci_fetch_array($st, OCI_ASSOC + OCI_RETURN_NULLS))
						{
							foreach($row as $item)
							{
								echo "<option value='$item'>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</option>\n";
							}
						}
					?>
					</select>
					
					</label>
					<label>Destination
					<select id="flt_dest" name="flt_dest">
					<?php
						$q = "select AIRPORT_ID from airport";
						$st = oci_parse($GLOBALS['conn'], $q);
						oci_execute($st);
						while($row = oci_fetch_array($st, OCI_ASSOC + OCI_RETURN_NULLS))
						{
							foreach($row as $item)
							{
								echo "<option value='$item'>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</option>\n";
							}
						}
					?>
					</select>
					</label>
					<label>Airline ID:
					<select id="airline_id" name="airline_id">
					<?php
						$q = "select AIRLINE_ID from AIRLINE";
						$st = oci_parse($GLOBALS['conn'], $q);
						oci_execute($st);
						while($row = oci_fetch_array($st, OCI_ASSOC + OCI_RETURN_NULLS))
						{
							foreach($row as $item)
							{
								echo "<option value='$item'>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</option>\n";
							}
						}
					?>
					</select>
					</label>
					<select id="flight_isActive" name="flight_isActive">
						<option value="1" selected>Active</option>
						<option value="0">Inactive</option>
					</select>
                    <label>
                        <input type="submit" name="submit_plane_info" id="submit_plane_info" value="Done!" class="btn btn-success btn-midium" style="border-color: black;"/>
                    </label>
                </form>
                <br>
				<div style="text-align:center;"><?php if($flag) echo "Successfully Added."; ?></div>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
		</div>
        
        <!-- Update plane info -->
        <div class="row-fluid">
            <div class="span8 well offset3" id="update_plane_info" style="background-color: transparent; border-color: green;">
                <h4>Update Flight Info</h4>
                <hr>
				<?php
					$q = "SELECT FLIGHT_ID FROM Seat_Info";
					$st = oci_parse($GLOBALS['conn'], $q);
					oci_execute($st);
					echo "<select id='CurrFlight_id'>";
					echo "<option selected='selected' disabled='disabled'>Select Current Flight</option>";
					while($row = oci_fetch_array($st, OCI_ASSOC + OCI_RETURN_NULLS))
					{
						foreach($row as $item)
						{
							echo "<option value='$item'>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</option>\n";
						}
					}
					echo "</select>";
					
					oci_free_statement($st);
					$q = "SELECT FLIGHT_ID FROM Flight";
					$st = oci_parse($GLOBALS['conn'], $q);
					oci_execute($st);
					echo "<select id='NewFlightID'>";
					echo "<option selected='selected' disabled='disabled'>Select New Flight</option>";
					while($row = oci_fetch_array($st, OCI_ASSOC + OCI_RETURN_NULLS))
					{
						foreach($row as $item)
						{
							echo "<option value='$item'>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</option>\n";
						}
					}
					echo "</select>";
				?>
                <table cellspacing = "5">
				<tr>
					<td>BUSINESS CLASS SEATS</td>
					<td><input type="text" id="updated_business_class_seats" placeholder="BUSINESS CLASS SEATS" /></td>
				 </tr>
				 <tr>
					<td>ECONOMY CLASS SEATS</td>
					<td><input type="text" id="updated_economy_class_seats" placeholder="ECONOMY CLASS SEATS" /></td>
				 </tr>
				 <tr>
					<td>NORMAL CLASS SEATS</td>
					<td><input type="text" id="updated_normal_class_seats" placeholder="NORMAL CLASS SEATS" /></td>
				 </tr>
                </table>
                <label>
				<select id="status">
					
                      <option selected="selected" disabled="disabled">Change Activation Status</option>
                        <option value="1">Activate</option>
                        <option value="0">De-Activate</option>
					
                    </select>
				
                </label>
                <label>
                    <button class="btn btn-info" onclick="return updateFlightInfo();">Update</button>
                </label>
                </br>
            </div>
        </div>
        
        
        <!-- add new airport info -->
        <div class="row-fluid">
            <div class="span8 well offset3" id="add_new_airport_info" style="background-color: transparent; border-color: green;">
                <h4>Add new Airport Info</h4>
			
				<table cellspacing = "5"
				<tr>
                   <td>NAME</td> 
				   <td><input type="text" id="NAME" placeholder="NAME" /></td>
				 </tr>
				<tr>
                   <td>LATITUDE</td> 
					<td><input type="text" id="LATITUDE" placeholder="LATITUDE" /></td>
				</tr>
				<tr>
                    <td>LONGITUDE</td>
					<td><input type="text" id="LONGITUDE" placeholder="LONGITUDE" /></td>
				</tr>
					</table>
            
				<label>
                    <button class="btn btn-info" onclick="AddAirport();">Update</button>
                </label>
				<div id="airport_info"></div>
            </div>
			
        </div>
        
        <!-- update_airport_info -->
        <div class="row-fluid">
            <div class="span8 well offset3" id="update_airport_info" style="background-color: transparent; border-color: green;">
                <h4>Update Airport Info</h4>
                
                <select id="old_airport_name">
				<?php
					$q = "select name from airport";
					$st = oci_parse($GLOBALS['conn'], $q);
					oci_execute($st);
					
					while($row = oci_fetch_array($st, OCI_ASSOC + OCI_RETURN_NULLS))
					{
						foreach($row as $item)
						{
							echo "<option value='$item'>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</option>\n";
						}
					}
				?>
                </select>
                <table id="airport_details" border="2" cellspacing="1" cellpadding="4" style="border-color: green; text-shadow: 5px 4px 9px green;">
				
				</table>
                
                <hr>
				<table cellspacing = "10">
					<tr>
						<td>CHANGE AIRPORT NAME</td>
						<td><input type="text" name="updated_airport_name" id="updated_airport_name" placeholder="CHANGE AIRPORT NAME" /></td>
					</tr>
					<tr>
						<td>CHANGE LATITUDE</td>
						<td><input type="text" name="updated_latitude" id="updated_latitude" placeholder="CHANGE LATITUDE" /></td>
					</tr>
					<tr>
						<td>CHANGE LONGITUDE</td>
						<td><input type="text" name="updated_longitude" id="updated_longitude" placeholder="CHANGE LONGITUDE" /></td>
					</tr>
				</table>
				<button class="btn btn-info" onclick="return updateAirportInfo();">Update</button>
                <br>
                    
                <?php
                    //
                ?>
                
            </div>
        </div>
        
        <!-- create new schedule -->
        <div class="row-fluid">
            <div class="span8 well offset3" id="add_new_schedule" style="background-color: transparent; border-color: green;">
                <h4>Create New Schedule</h4>
                <label>
                    <select id="flt_id_s">
                        <option selected="selected" disabled="disabled">Select a Flight</option>
                        <?php
							$q = "Select flight_id from Flight Where FLIGHT_ID not in (select FLIGHT_ID from SCHEDULE)";
							$st = oci_parse($GLOBALS['conn'], $q);
							oci_execute($st);
							
							while($row = oci_fetch_array($st, OCI_ASSOC + OCI_RETURN_NULLS))
							{
								foreach($row as $item)
								{
									echo "<option value='$item'>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</option>\n";
								}
							}
						?>
                    </select>
                    <br>
                    <h4 align='center' style="color: gray;">Select days for your flight</h4>
                    <label style="font-size: 20px;">
                        Sat <input type="checkbox" name="sat" id="sat" value="sat"/>
                        Sun <input type="checkbox" name="sun" id="sun" value="sun"/>
                        Mon <input type="checkbox" name="mon" id="mon" value="mon"/>
                        Tues <input type="checkbox" name="tues" id="tues" value="tues"/>
                        Wed <input type="checkbox" name="wed" id="wed" value="wed"/>
                        Thus <input type="checkbox" name="thus" id="thus" value="thus"/>
                        Fri <input type="checkbox" name="fri" id="fri" value="fri"/>
                    </label>
                    <br>
                    <i class="fa fa-clock-o fa-2x"></i>Departure Time
                    <input type="time" name="dep_time" id="dep_time" style="height: 5%;"/>
                    <i class="fa fa-clock-o fa-2x"></i>Arrival Time
                    <input type="time" name="arr_time" id="arr_time" style="height: 5%;"/>					
					<script>
						$(function() {
							$('#dep_time').timepicker({ 'timeFormat': 'h:i A' });
						});
						$(function() {
							$('#arr_time').timepicker({ 'timeFormat': 'h:i A' });
						});
					</script>
                    <br>
                    <button class="btn btn-info" onclick="createNewSchedule();">Create!</button>
                </label>
                <br>
            </div>
        </div>
       
       
        <!-- update  schedule -->
        <div class="row-fluid">
            <div class="span8 well offset3" id="update_schedule" style="background-color: transparent; border-color: green;">
                <h4>Update Schedule Info</h4>
				<select id="flt_id_s_u">
					<option selected="selected" disabled="disabled">Select a Flight</option>
					<?php
						$q = "Select flight_id from Schedule";
						$st = oci_parse($GLOBALS['conn'], $q);
						oci_execute($st);
						
						while($row = oci_fetch_array($st, OCI_ASSOC + OCI_RETURN_NULLS))
						{
							foreach($row as $item)
							{
								echo "<option value='$item'>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</option>\n";
							}
						}
					?>
                </select>
				<br>
				<h4 align='center' style="color: gray;">Select days for your flight</h4>
				<label style="font-size: 20px;">
					Sat <input type="checkbox" name="sat_u" id="sat_u" value="sat"/>
					Sun <input type="checkbox" name="sun_u" id="sun_u" value="sun"/>
					Mon <input type="checkbox" name="mon_u" id="mon_u" value="mon"/>
					Tues <input type="checkbox" name="tues_u" id="tues_u" value="tues"/>
					Wed <input type="checkbox" name="wed_u" id="wed_u" value="wed"/>
					Thus <input type="checkbox" name="thus_u" id="thus_u" value="thus"/>
					Fri <input type="checkbox" name="fri_u" id="fri_u" value="fri"/>
				</label>
				<br>
				<i class="fa fa-clock-o fa-2x"></i>Departure Time
				<input type="text" name="dep_time_u" id="dep_time_u" style="height: 5%;"/>
				<i class="fa fa-clock-o fa-2x"></i>Arrival Time
				<input type="text" name="arr_time_u" id="arr_time_u" style="height: 5%;"/>
				<script>
					$(function() {
						$('#dep_time_u').timepicker({ 'timeFormat': 'h:i A' });
					});
					$(function() {
						$('#arr_time_u').timepicker({ 'timeFormat': 'h:i A' });
					});
				</script>
				<br>
				<button onclick="updateSchedule()" class="btn btn-info" style="width: 10%;">Update</button>
                </label>
            </div>
        </div>
        
        <!-- show flight info -->
        <div class="row-fluid">
            <div class="span8 well offset3" id="show_flight_info" style="background-color: transparent; border-color: green;">
                <h4>Flight Information</h4>
                <select id="click_flight_id" onchange="loadFlightDetails()">
				<option selected="selected" disabled="disabled">Select Flight ID</option>
                <?php
					$q = "Select flight_id from Flight";
					$st = oci_parse($GLOBALS['conn'], $q);
					oci_execute($st);
					
					 
					 
					while($row = oci_fetch_array($st, OCI_ASSOC + OCI_RETURN_NULLS))
					{
						foreach($row as $item)
						{
							echo "<option value='$item'>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</option>\n";
						}
					}
				?>
                </select>
                <div id="flight_details"></div>
            </div>
        </div>       
        
    </div>
    </div>
    
    <footer style="color: green">
            <p align="center">&copy; Group404!</p>
    </footer>
</body>
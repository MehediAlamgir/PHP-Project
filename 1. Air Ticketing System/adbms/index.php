<?php
    session_start();
    include_once("navbar.php");
	require_once("database.php");
	/*
    $conn = oci_connect('system', 'tiger');
	if (!$conn) 
	{
	   $m = oci_error();
	   echo $m['message'], "\n";
	   exit;
	}
	*/
?>
<head>
    <style>
        h3
        {
            text-shadow: 2px 5px 7px green;
        }
    </style>
    
    <script
        src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">
    </script>

    <script>
        var myCenter=new google.maps.LatLng(23.843070900000000000,90.405449800000040000);
        
        function initialize()
        {
        var mapProp = {
          center:myCenter,
          zoom:5,
          mapTypeId:google.maps.MapTypeId.ROADMAP
          };
        
        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
        
        var marker=new google.maps.Marker({
          position:myCenter,
          animation:google.maps.Animation.BOUNCE
          });
        
        marker.setMap(map);
        map.setMapTypeId(google.maps.MapTypeId.HYBRID);
        }
        
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</head>


<body style="background-color: #FFFFFF;">
    <!--<h1 align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AIRLINES TICKETING SYSTEM</h1>-->
    <div class="container-fluid">
    <div class="row-fluid padding_down" style="color: green;" align="center">
    <div  id="row-fluid" style="color: green;">
            <div class="span3 well" style="background-color: transparent; border-color: green; padding: 30px;">
                <div>
                    <h3>Flight Information</h3>
                    <a href="#show_schedule_user" class="btn btn-block" style="background-color: transparent; border-color: green; text-shadow: 5px 4px 9px green;">Flight Schedule</a>
                    <a href="#show_route_user" class="btn btn-block" style="background-color: transparent; border-color: green; text-shadow: 5px 4px 9px green;">Fare Information</a>
                    <a href="#show_plane_info" class="btn btn-block" style="background-color: transparent; border-color: green; text-shadow: 5px 4px 9px green;">Plane Information</a>
                   <!-- <a href="#show_flight_info" class="btn btn-block" style="background-color: transparent; border-color: green; text-shadow: 5px 4px 9px green;">Specific Flight Information</a> -->
                    <a href="#"  onclick="alert('You have to login for Booking Tickets')" class="btn btn-block" style="background-color: transparent; border-color: green; text-shadow: 5px 4px 9px green; font-size: 20px;"><i class="fa fa-wheelchair fa-1.9x">&nbsp;BooK Tickets</i></a>
                    <a href="#" class="btn btn-block" style="background-color: transparent; border-color: green; text-shadow: 5px 4px 9px green;"><i class="fa fa-bug fa-2x"></i></i></a>
                    
                </div>
            </div>
            <div class="row-fluid">
                    <div class="span8 well offset1" id="show_schedule_user" style="padding-left: 2px; padding-right: 5px; background-color: transparent; border-color: green;">
                        <h3>Flight & Schedule Information</h3>
						<?php								
							$sql = "select DISTINCT name , Airport_ID from airport";
							$query = oci_parse($conn,$sql);
							oci_execute($query);
							$airport_id = "";
							while($row = oci_fetch_array($query,OCI_BOTH))
							{
								$airport_id .= "<option value='" . $row["AIRPORT_ID"] . "'>" . $row["NAME"] . "</option>";
							}		
								
						?>
					
                        <label>
                            <select id="from">
                                <option selected="selected" disabled="disabled">From</option>
								<?php
									echo $airport_id;
								?>
                            </select>
                            <select id="to">
                                <option selected="selected" disabled="disabled">To</option>
								<?php
									echo $airport_id;
								?>
                                
                            </select>
                            <br>
                            <table id="schedule_details" border="2" cellspacing="1" cellpadding="4" style="border-color: green; text-shadow: 5px 4px 9px green;">
				
                            </table>
                            <br>
                            <button onclick="searchScheduleDetails()" class="btn btn-info"><i class="fa fa-search"></i>&nbsp;Search</button>
                        </label>
                        
                        <br>
                        <br>
                        <h2><code>DEmo Location , GOOGLE MAPS -> Route Section</code> <i class="fa fa-meh-o"></i></h2>
                        <div id="googleMap" style="width:800px;height:380px;"></div>
                    </div>
            </div>
            
            <!-- route info -->
            <div class="row">
                <div class="span8 well offset4" id="show_route_user" style="background-color: transparent; border-color: green; margin-left: 33%;">
                    <h3>Fare Information</h3>
					
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
                <hr>
                    
                <h2><code>Google Maps -> Coming Soon !!!</code> <i class="fa fa-meh-o"></i></h2>
                
                <!-- Error Code 
                <script type="text/javascript"> //
                    var route_id = document.getElementById("route_id").value.trim();
                    if (route_id != "Select a Route") {
                        var src_lat = <?php  echo  $_SESSION['src_lat']?>;
                        var src_lon = <?php  echo $_SESSION["src_lon"];?>;
                        var via_1_lat = <?php  echo $_SESSION["via_1_lat"];?>;
                        var via_1_lon = <?php  echo $_SESSION["via_1_lon"];?>;
                        var via_2_lat = <?php  echo $_SESSION["via_2_lat"];?>;
                        var via_2_lon = <?php  echo $_SESSION["via_2_lon"];?>;
                        var via_3_lat = <?php  echo $_SESSION["via_3_lat"];?>;
                        var via_3_lon = <?php  echo $_SESSION["via_3_lon"];?>;
                        var dest_lat = <?php  echo $_SESSION["dest_lat"];?>;
                        var dest_lon = <?php  echo $_SESSION["dest_lon"];?>;
                
                        var x=new google.maps.LatLng(<?php  echo $_SESSION["src_lat"]?>,<?php  echo $_SESSION["src_lon"]?>);
                        //var stavanger=new google.maps.LatLng(58.983991,5.734863);
                        //var amsterdam=new google.maps.LatLng(52.395715,4.888916);
                        var y=new google.maps.LatLng(<?php  echo $_SESSION["dest_lat"]?>,<?php  echo $_SESSION["dest_lon"]?>);
            
                        function initialize2()
                        {
                        var mapProp = {
                          center:x,
                          zoom:4,
                          mapTypeId:google.maps.MapTypeId.ROADMAP
                          };
              
                        var map=new google.maps.Map(document.getElementById("route_map"),mapProp);
                        
                        //var myTrip=[stavanger,amsterdam,london];
                        var myTrip = [x,y];
                        var flightPath=new google.maps.Polyline({
                          path:myTrip,
                          strokeColor:"#0000FF",
                          strokeOpacity:0.8,
                          strokeWeight:2
                          });
                        
                        flightPath.setMap(map);
                        }
            
                        google.maps.event.addDomListener(window, 'load', initialize2);
                    }
                </script>
                 END OF ERROR CODE -->
                    <!--<div id="route_map" style="width:500px;height:380px;"></div>-->
                </div>
            </div>
              <!-- Plane List -->   
            <div class="row">
                <div class="span8 well offset4" id="show_plane_info" style="background-color: transparent; border-color: green; margin-left: 33%;">
                    <h3>Plane Information</h3>
					
					<?php
						$sql = "SELECT AIRLINE_ID from airline";
						$query = oci_parse($conn,$sql);
						oci_execute($query);
						
						$airline_id = "<option selected='selected' disabled='disabled'>SELECT AIRLINE ID</option>";
						while($row = oci_fetch_array($query,OCI_BOTH));
						{
							$airline_id .= "<option>" . $row["AIRLINE_ID"] ."</option>";
						}					
		
					?>
					
					<select id='plane_id' onchange='loadPlaneDetails()'>
						<?php
							echo $flight_id;
						?>
					</select>;
                    
                <table id="plane_details" border="2" cellspacing="1" cellpadding="4" style="border-color: green; text-shadow: 5px 4px 9px green;">
				
		</table>
                </div>
            </div>
            
            <!-- specific flight info -->
          <!--  <div class="row">
                <div class="span8 well offset4" id="show_flight_info" style="background-color: transparent; border-color: green; margin-left: 33%;">
                    <h3>Specific Flight Information</h3>
                    
                <select id="click_flight_id" onchange="loadFlightDetails()">
                                    </select>
                <table id="flight_details" border="2" cellspacing="1" cellpadding="4" style="border-color: green; text-shadow: 5px 4px 9px green;">
				
		</table>
                </div> -->
				
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

    

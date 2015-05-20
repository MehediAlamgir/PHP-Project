function loadPlaneDetails() //mehedi
{
	var xmlhttp;
	var plane_id = document.getElementById("plane_id").value;
	if (window.XMLHttpRequest)
	{	
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("plane_details").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","ajax/process.php?plane_id="+plane_id + "&func=plane_info",true);
	xmlhttp.send();
}



function loadRouteDetails() //mehedi
{
	var xmlhttp;
	var route_id = document.getElementById("route_id").value;
	if (window.XMLHttpRequest)
	{	
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("route_details").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","ajax/process.php?route_id="+route_id + "&func=route_info",true);
	xmlhttp.send();
}





function searchScheduleDetails()  // mehedi
{
	var xmlhttp;
	var from = document.getElementById("from").value.trim();
	var to = document.getElementById("to").value.trim();
	if (from == "From") {
		alert("please select your Source Airport")
		return false;
	}
	if (to == "To") {
		alert("please select your Destination Airport")
		return false;
	}
	if (from == to) {
		alert("Invalid Destination !!!");
		return false;
	}
	else
	{
		if (window.XMLHttpRequest)
		{	
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("schedule_details").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","ajax/process.php?from=" + from + "&func=search_schedule_info" + "&to=" + to ,true);
		xmlhttp.send();
	}
	return true;
}

function bookTickets() 	//Shourov
{
	var flight_id = document.getElementById("click_flight_id").value.trim();
	var eco = document.getElementById("book_eco").value.trim();
	var exe = document.getElementById("book_exe").value.trim();
	var fir = document.getElementById("book_fir").value.trim();
	var d = document.getElementById("book_date").value.trim();
	//var tmp = new Date();
	//var  cy =parseInt(tmp.getFullYear());
	//alert(typeof(cy));	
	//var cm = parseInt(tmp.getMonth());
	//alert(typeof(cm));
	//var cd = parseInt(tmp.getDay());
	//alert(typeof(cd));
	//var flight_date = d.split("-");
	//var by = parseInt(flight_date[0]);
	//alert((by));
	//var bm = parseInt(flight_date[1]);
	//alert((bm));
	//var fd = parseInt(flight_date[2]);
	//alert((fd));
	var dd = new Date(d);
	fd = dd.getDay()+1;
	//alert(fd);
	if (flight_id == "Select a Flight") {
		alert("Please select a flight");
		return false;
	}
	
	if (eco ==  "" && exe == "" &&fir == "") {
		alert("please insert no of seats do you want to book ");
		return false;
	}
	if (eco[0] == "-" || exe[0] == "-" || fir[0] == "-") {
		alert("Invalid Seat Number !!");
		return false;
	}
	if (parseInt(eco) > 5 || parseInt(exe) > 5 || parseInt(fir) > 5) {
		alert("You can't book more than 5 tickets for each class !!!");
		return false;
	}
	if (d == "") {
		alert("Please select your flight date");
		return false;
	}
	else
	{
		window.location.href="ajax/process.php?flight_id=" + flight_id + "&flight_date=" + d + "&flight_day=" + fd + "&eco=" + eco + "&exe=" + exe + "&fir=" + fir + "&func=booking_tickets";
	}
	/*if (by != cy || bm < cm) {
		alert("Invalid Flight Date !!!");
		return false;
	}*/
	return true;
}



function cancelBooking() //Shourov
{
	var flight_id = document.getElementById("select_flight").value.trim();
	if (flight_id == "Select Your Flight") {
		alert("please select your flight first");
		return false;
	}
	else
	{
		window.location.href="ajax/process.php?flight_id=" + flight_id + "&func=cancel_booking";
	}
	return true;
}


//
function add_airlines()
{
	var xmlhttp;
	var name = document.getElementById("airlines_name").value;
	var id = document.getElementById("airlines_id").value;
	if (window.XMLHttpRequest)
	{	
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("airlines_details").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","ajax/process.php?airlines_name="+name + "&airlines_id=" + id + "&func=add_airlines",true);
	xmlhttp.send();
}
//
function updateFlightInfo()
{
	var CurrFlight_id = document.getElementById("CurrFlight_id").value;
	var business = document.getElementById("updated_business_class_seats").value.trim();
	var economy = document.getElementById("updated_economy_class_seats").value.trim();
	var normal = document.getElementById("updated_normal_class_seats").value.trim();
	var NewFlightID = document.getElementById("NewFlightID").value;
	var status = document.getElementById("status").value;
	
	if (parseInt(business) < 0  || parseInt(economy) < 0 || parseInt(normal) < 0) {
		alert("Inavlid Number of SEats!!");
		return false;
	}
	if (status.trim().length > 11) {
		alert("Invalid Status !!!");
		return false;
	}
	else
	{
		window.location.href="ajax/process.php?CurrFlight_id="+CurrFlight_id + "&business=" + business + "&economy=" + economy + "&normal=" + normal + "&status=" + status + "&NewFlightID=" + NewFlightID + "&func=update_flight_info";
	}
	return true;
}

//
function AddAirport()
{
	var xmlhttp;
	var name = document.getElementById("NAME").value;
	var lat = document.getElementById("LATITUDE").value;
	var lon = document.getElementById("LONGITUDE").value;
	if (window.XMLHttpRequest)
	{	
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("airport_info").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","ajax/process.php?name=" + name + "&lat=" + lat + "&lon=" + lon + "&func=AddAirport",true);
	xmlhttp.send();
}
//
function updateAirportInfo()
{
	var old_name = document.getElementById("old_airport_name").value;
	var new_name = document.getElementById("updated_airport_name").value;
	var lat = document.getElementById("updated_latitude").value;
	var lon = document.getElementById("updated_longitude").value;
	
	if (new_name.trim() == "" && lat.trim() == "" && lon.trim() == "") {
		alert("updated value missing!!!");
		return false;
	}
	else
	{
		window.location.href="ajax/process.php?old_name=" + old_name + "&new_name=" + new_name + "&lat=" + lat + "&lon=" + lon  + "&func=update_airport_info";
	}
	return true;
}
//
function createNewSchedule() {
	var flt_id_s = document.getElementById("flt_id_s").value;
	
	var sat = document.getElementById("sat").checked ? 1 : 0;
	var sun = document.getElementById("sun").checked ? 1 : 0;
	var mon = document.getElementById("mon").checked ? 1 : 0;
	var tues = document.getElementById("tues").checked ? 1 : 0;
	var wed = document.getElementById("wed").checked ? 1 : 0;
	var thus = document.getElementById("thus").checked ? 1 : 0;
	var fri = document.getElementById("fri").checked ? 1 : 0;
	
	var dep_time = document.getElementById("dep_time").value;
	var arr_time = document.getElementById("arr_time").value;
	
	if (flt_id_s.trim() == "Select a Flight") {
		alert("Please select a flight !!");
		return false;
	}
	
	if (sat == 0 && sun == 0 && mon == 0 && tues == 0 && wed == 0 && thus == 0 && fri == 0) {
		alert("You must select your schedule day");
		return false;
	}
	
	if (dep_time == "" && arr_time == "") {
		alert("Please Fill all the section of Departure or Arrival Time .. !!!");
		return false;
	}
	else
	{
	    window.location.href="ajax/process.php?flt_id_s=" + flt_id_s + "&sat=" + sat + "&sun=" + sun + "&mon=" + mon + "&tues=" + tues + "&wed=" + wed + "&thus=" + thus + "&fri=" + fri + "&dep_time=" + dep_time + "&arr_time=" + arr_time + "&func=create_new_schedule"; 
	}
	return true;
}
//
function updateSchedule() {
	var flt_id_s = document.getElementById("flt_id_s_u").value;
	
	var sat = document.getElementById("sat_u").checked ? 1 : 0;
	var sun = document.getElementById("sun_u").checked ? 1 : 0;
	var mon = document.getElementById("mon_u").checked ? 1 : 0;
	var tues = document.getElementById("tues_u").checked ? 1 : 0;
	var wed = document.getElementById("wed_u").checked ? 1 : 0;
	var thus = document.getElementById("thus_u").checked ? 1 : 0;
	var fri = document.getElementById("fri_u").checked ? 1 : 0;
	
	var dep_time = document.getElementById("dep_time_u").value;
	var arr_time = document.getElementById("arr_time_u").value;
	
	if (flt_id_s.trim() == "Select a Flight") {
		alert("Please select a flight !!");
		return false;
	}
	
	if (sat == 0 && sun == 0 && mon == 0 && tues == 0 && wed == 0 && thus == 0 && fri == 0) {
		alert("You must select your schedule day");
		return false;
	}
	
	if (dep_time == "" && arr_time == "") {
		alert("Please Fill all the section of Departure or Arrival Time .. !!!");
		return false;
	}
	else
	{
	    window.location.href="ajax/process.php?flt_id_s=" + flt_id_s + "&sat=" + sat + "&sun=" + sun + "&mon=" + mon + "&tues=" + tues + "&wed=" + wed + "&thus=" + thus + "&fri=" + fri + "&dep_time=" + dep_time + "&arr_time=" + arr_time + "&func=update_schedule"; 
	}
	return true;
}
//
function loadFlightDetails()
{
	var xmlhttp;
	var flt_id = document.getElementById("click_flight_id").value;
	if (window.XMLHttpRequest)
	{	
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("flight_details").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","ajax/process.php?flt_id=" + flt_id + "&func=schedule_info",true);
	xmlhttp.send();
}
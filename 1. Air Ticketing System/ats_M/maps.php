<?php
    session_start();
    include("db.php");
    $from = $_SESSION["fc"];
    $to = $_SESSION["tc"];

    $q1 = "SELECT * FROM airport WHERE country = '$from' ";
    $r1 = mysql_query($q1);
    $row1 = mysql_fetch_array($r1);

    $flat = $row1['latitude'] ;
    $flong = $row1['longitude'];

    $q2 = "SELECT * FROM airport WHERE country = '$to'";
    $r2 = mysql_query($q2);
    $row2 = mysql_fetch_array($r2);

    $tlat = $row2['latitude'] ;
    $tlong = $row2['longitude'];

?>

<!DOCTYPE html>
<html>
<head>
<script
src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">
</script>

<script>
var x=new google.maps.LatLng(23.843070900000000000,90.405449800000040000);
var f=new google.maps.LatLng("<?php echo $flat; ?>","<?php echo $flong; ?>");
var t=new google.maps.LatLng("<?php echo $tlat; ?>","<?php echo $tlong; ?>");

function initialize()
{
var mapProp = {
  center:x,
  zoom:4,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

var myTrip=[f,t];

var flightPath=new google.maps.Polyline({
  path:myTrip,
  strokeColor:"#FF0000",
  strokeOpacity:0.8,
  strokeWeight:2
  });

flightPath.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>

<body>
<a href = "routemaps.php"><button>Back</button></a>
<div id="googleMap" style="width:1400px;height:600px;"></div>
</body>
</html>

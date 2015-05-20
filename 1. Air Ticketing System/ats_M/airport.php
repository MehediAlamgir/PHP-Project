 <?php
    include("db.php");
    $fp = fopen('data.txt','r');
    while(!feof($fp))
    {
        $country = trim(fgets($fp));
        $airportname = trim(fgets($fp));
        $latitude = trim(fgets($fp));
        $longitude = trim(fgets($fp));

        $query = "INSERT INTO airport (`country`,`airportname`,`latitude`,`longitude`) VALUES ('$country','$airportname','$latitude','$longitude') ";
        mysql_query($query);


    }
 ?>
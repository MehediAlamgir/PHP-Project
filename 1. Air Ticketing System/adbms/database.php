<?php
// Create connection to Oracle


	$conn = oci_connect('system', 'tiger', 'localhost/XE');
	if(!$conn)
	{
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}


/*$conn = oci_connect('system', 'tiger''localhost/XE');
if (!$conn) 
{
   $m = oci_error();
   echo $m['message'], "\n";
   exit;
}

else
 {
   //print "Connected to Oracle!";
}
// Close the Oracle connection
oci_close($conn);*/
?>
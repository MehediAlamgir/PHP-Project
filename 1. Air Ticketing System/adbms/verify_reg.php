<?php   
		include_once("navbar.php");
        include_once("database.php");
        
       	if(isset($_POST["submit"]))
		{
		
		$name = trim($_POST['name']);
		//echo $name;
		$email = trim($_POST['email']);
		$phone = trim($_POST['phone']);
		$gender = trim($_POST['gender']);
		$password = trim($_POST['pass']);
		$conpass = trim($_POST['repass']);
		$address = $_POST['address'];
		
		//echo "<font color = 'red'><h2>$email</font></h2>";
		
		$q=oci_parse($conn,"SELECT * from userTable WHERE mail = '$email' ");
		oci_execute($q);
		$row=oci_fetch_array($q,OCI_ASSOC+OCI_RETURN_NULLS);
		
		if($row)
		{
			$message = "Mail ID Already Exists !!!";
		}
		
		else
		{
			$query = oci_parse($conn,"INSERT INTO userTable values('p'||Passenger_pid.NEXTVAL,:name,:email,:password,:phone,:address,2,:gender)");
			oci_bind_by_name($query,':name',$name);
			oci_bind_by_name($query,':email',$email);
			oci_bind_by_name($query,':password',$password);
			oci_bind_by_name($query,':phone',$phone);
			oci_bind_by_name($query,':address',$address);
			oci_bind_by_name($query,':gender',$gender);
			
			oci_execute($query);

			$message = "Succesfully Registered.";				

		}
	}
        else{
            header("Location: reg.php");
        }
       
    
?>

 <label>
        		<?php
        			if(isset($message))
        			{
        				echo "<font color = 'red'><h2>$message</font></h2>";
        				$message="";
        			}
        		?>

        	</label>
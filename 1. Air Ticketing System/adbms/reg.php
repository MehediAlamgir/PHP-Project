<?php   
		session_start();
		include_once("navbar.php");
		include_once("database.php");
        
       	if(isset($_POST["submit"]))
		{
		/*
		$conn = oci_connect('system', 'tiger');
		if (!$conn) 
		{
		   $m = oci_error();
		   echo $m['message'], "\n";
		   exit;
		}
		*/
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
       
    
?>
<html>
     <body>
        </br></br>
        <form action="reg.php" method="post"  onsubmit="return validate();">
            <h1 align="center">Registration Form</h1>
            </br>
            <table align="center">
                <tr>
                    <td>Name: </td>
                    <td>
                        <input type="text" name="name" id="name" placeholder="Name" />
                    </td>
                </tr>
                
                <tr>
                    <td>Email: </td>
                    <td>
                        </i><input type="text" name="email" id="email"  placeholder="E-mail Address"/>
                    </td>
                </tr>
                
                <tr>
                    <td>Phone: </td>
                    <td>
                        <input type="text" name="phone" id="phone"  placeholder="Phone"/>
                    </td>
                </tr>
                
                <tr>
                    <td>Gender: </td>
		    <td>
			<i class="fa fa-male"> Male&nbsp;</i> <input type="radio" name="gender" value="Male" checked="checked" id="gender"/>  
			<i class="fa fa-female"> Female&nbsp;</i><input type="radio" name="gender" value="FeMale" id="gender" />
		    </td>			
		</tr>
                
                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="pass" id="pass" placeholder="Password" />
                    </td>
                </tr>
                
                <tr>
                    <td>Re-Password: </td>
                    <td>
                        <input type="password" name="repass" id="repass" placeholder="Retype-Password" />
                    </td>
                </tr>
                
                <tr>
                    <td>Address: </td>
                    <td>
                        <textarea name="address" id="address"></textarea>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" id="submit" value="Done!" class="btn btn-success btn-small" />
                    </td>
                </tr>

                
            </table>
			
			 <label>
        		<?php
        			if(isset($message))
        			{
        				echo "<center><font color = 'red'><h2>$message</h2></font></center>";
        				$message="";
        			}
        		?>

        	</label>
			
        </form>
		<br />
		<br />
		<br /><hr />
		<footer style="color: green">
            <p align="center">&copy; Group404!</p>
		</footer>
    </body>
</html>

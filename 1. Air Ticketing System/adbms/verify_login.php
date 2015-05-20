<?php
    session_start();
    include_once("database.php");
    if (isset($_POST["submit"]))
    {	
        $email = trim($_POST["login_email"]);
        $pass = trim($_POST["login_pass"]);
		
		//echo $email;
		//echo $pass;
        
        $sql = oci_parse($conn,"select * from userTable where mail='$email' and password='$pass' ");
		oci_execute($sql);
		$row=oci_fetch_array($sql,OCI_BOTH);
		
		//echo $row['TYPE'];
       
        if ($row)
        {            
            $type = $row['UTYPE'];
            if ($type == 1)
            {
                $_SESSION["status"] = "admin";
                header("Location: admin.php");
            }

            else if ($type == 2)
            {
                $_SESSION["status"] = "USER";
                header("Location: user.php");
            }
            $_SESSION["email"] = $email;

        }
        else
		{
            header("Location: index.php?error=-1");
        }
    }
?>
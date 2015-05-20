<?php
    if(isset($_POST['book']))
    {
        session_start();
         include("db.php");

        $un = $_SESSION['uname'];

        $name = $_SESSION['user_name'];
        $from = $_POST['fcountry'];
        $to =   $_POST['tcountry'];
        $aa =   $_POST['aairport'];
        $da =   $_POST['dairport'];
        $nos =  $_POST['nos'];
        $class = $_POST['class'];

        if($from == "" || $to == "" || $aa == "" || $da == "" || $nos == "" || $class == "")
        {
            $message = "You Have to Fill Up All Information";
        }

        else
        {
            $query = "INSERT INTO book (`username`,`name`,`fromm`,`too`,`arrivalairport`,`destinationairport`,`no_of_seat`,`class`,`status`) VALUES ('$un','$name','$from','$to','$aa','$da','$nos','$class','booked')";
            mysql_query($query);
            $message = "$nos Seat is Booked for You";
        }


    }
 ?>

 <html>

    <head>
        <title>Book Ticket</title>
    </head>

    <body>
        <h2 align = "center">Book Ticket</h2>
        <a href = "user.php"><button>Back</button></a>

        <?php
           include("db.php");
           $option1 =  "<option></option>";
           $option2 =  "<option></option>";

           $q = "SELECT * FROM airport";
           $res = mysql_query($q);

           while($row = mysql_fetch_array($res))
           {
              $country = $row['country'];
              $airportname = $row['airportname'];

              $option1 .= "<option>$country</option>";
              $option2 .= "<option>$airportname</option>";
           }

        ?>


        <form action="book.php" method = "post">
          <center>
                <table border = "1" cellspacing = "10" cellpadding = "10">
                    <tr>
                        <td>
                            <label>From</label>
                        </td>
                        <td>
                            <select name="fcountry" ><?php echo $option1; ?> </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Arrival Airport</label>
                        </td>
                        <td>
                            <select name="aairport" ><?php echo $option2; ?> </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>To</label>
                        </td>
                        <td>
                            <select name="tcountry" ><?php echo $option1; ?> </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Destination Airport</label>
                        </td>
                        <td>
                            <select name="dairport" ><?php echo $option2; ?> </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>No of Seat</label>
                        </td>
                        <td>
                            <input type="text" name="nos" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Class</label>
                        </td>
                        <td>
                            <select name="class" >
                                <option disabled="disabled" selected="selected">Select</option>
                                <option>Business</option>
                                <option>Premium</option>
                                <option>Normal</option>
                             </select>
                        </td>
                    </tr>

                </table>

                <input type="submit" name="book" value = "Book" />

          <label>
        		<?php

        			if(isset($message))
        			{
        				echo "<font color = 'red'><h2>$message</font></h2>";
        				$message="";
        			}
        		?>

        	</label>

          </center>

        </form>



    </body>

 </html>
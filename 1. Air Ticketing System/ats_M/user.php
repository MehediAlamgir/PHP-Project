<?php
session_start();
?>

<html>

    <head>
        <title>User</title>
    </head>

    <body>
        <h4 align = "right"><a href = "logout.php"><button>Logout</button></a></h4>

        <h1 align = "center">Welcome <?php echo  $_SESSION['user_name'] ; ?></h1>

        <center>
            <a href = "book.php"><button>Book Ticket</button></a>
            <a href = "confirm.php"><button>Confirm Ticket</button></a>
            <a href = "cancelticket.php"><button>Cancel Ticket</button></a>
            <a href = "uroutemaps.php"><button>View Route Maps</button></a>
        </center>
    </body>


</html>
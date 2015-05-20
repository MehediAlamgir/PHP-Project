<?php
    session_start();

?>


<html>
    <head>
    <title>Admin</title>

    </head>

    <body>
    <h4 align = "right"><a href = "logout.php"><button>Logout</button></a></h4>

    <h1 align = "center">Welcome <?php echo  $_SESSION['admin_name']."[ADMIN]"; ?></h1>
       <center>    
        <a href = "createroute.php"><button>Create Route</button></a>
        <a href = "createflight.php"><button>Create Flight</button></a>
        <a href = "deleteflight.php"><button>Delete Flight</button></a>
        <a href = "flightschedule.php"><button>Flight Schedule</button></a>
        <a href = "statistics.php"><button>View Statistics</button></a>
        <a href = "routemaps.php"><button>View Route Maps</button></a>
         <a href = "suspend.php"><button>Suspend User</button></a>


        </center>


    </body>
</html>
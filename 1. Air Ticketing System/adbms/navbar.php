
                <head>
                        <title>AIRLINES MANAGEMENT SYSTEM</title>
                        <meta charset="utf-8">
                        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
                        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.min.css">
                        <link rel="stylesheet" type="text/css" href="css/custom.css">
                        <script src="bootstrap/js/jquery.js"></script>
                        <script src="bootstrap/js/bootstrap.min.js"></script>
			<script type="text/javascript" src="js/validation.js"></script>
			<script type="text/javascript" src="js/ajax.js"></script>
			<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
                </head>
		<div class="navbar navbar-inverse navbar-static-top">
			<div class="navbar-inner">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="brand" href="#"><i><span class="icon-bar"></span></i></a>
			<ul class="nav">
			    <li class="active">
				<a  href="index.php">
				<i class="fa fa-home"></i> Home
				</a>
			    </li>
			     <li class="divider-vertical">
				<a  href="about.php">
				    <i class="fa fa-pencil-square-o"></i> About
				</a>
			    </li>
			    <li>
				<a  href="programmer.php">
				    <i class="fa fa-users"></i> Programmer
				</a>
			    </li>
                            <?php
				if (isset($_SESSION["status"]))
				{
				    
					$st = $_SESSION["status"];
					//if (isset($_SESSION["name"]))
					{
					    if($st == "admin")
					    {
						 echo "<li><a href='admin.php'><i class='fa fa-hand-o-right'></i> Back</a></li>" ;
					    }
					    else if($st == "USER")
					    {
						  echo "<li><a href='user.php'><i class='fa fa-hand-o-right'></i> Back</a></li>" ;
					    }
					}
				}
			    ?>
			</ul>
                        <?php
                        if (!isset($_SESSION["status"]))
                        {
                            echo '<form class="navbar-form pull-right" method="post" action="verify_login.php" onsubmit="return loginCheck();">
                                <input class="span2 input" type="text" placeholder="E-mail" name="login_email" id="login_email"/>
                                <input class="span2 input" type="password" placeholder="Password" name="login_pass" id="login_pass"/>
                                <input type="submit" class="btn btn-inverse" style="border-color: green;" value="SignIn" name="submit"/>
                                <a href="reg.php" class="btn btn-inverse" style="border-color: green;">SignUp</a>
                            </form>';
                        }
			else{
				echo '<a href="logout.php" class="btn pull-right btn-inverse" style="border-color: green;">SignOut</a>' . '&nbsp';
			}
                        ?>
			
		    </div>
		</div>
                
                

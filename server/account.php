<!doctype html>
<?php
session_start();
if(isset($_SESSION["check"])&&$_SESSION["check"]=true);
else {
  header("location: /project/server/a.php");
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "avy";
$conn = new mysqli($servername, $username, $password, $dbname);
if(isset($_SESSION["check"])&&$_SESSION["check"]=true);
else {
  header("location: /project/server/a.php");
}
$email=$_SESSION["username"];
$sql="SELECT * from PROFILE where email='$email' ";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
 ?>
<html>
<head>
	<title>melloMANIAC</title>

    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="../assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="../assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="/project/server/home.php" class="simple-text">
                    melloMANIAC
									                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="/project/server/home.php">
                        <i ></i>
                        <p>Home</p>
                    </a>
                </li>
                <li >
                    <a href="/project/server/profile.php">
                        <i></i>
                        <p>Profile</p>
                    </a>
                </li>
								<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <li>
                    <a href="/project/server/account.php">
                        <i class=""></i>
                        <p>Account</p>
                    </a>
                </li>
                <li>
                    <a href="/project/server/lg.php">
                        <i class=""></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" >Account</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="/project/server/account.php">
                               Account
                            </a>
                        </li>
                        <li>
                            <a href="/project/server/lg.php">
                                Log out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="header">
                    <h4 class="title">Edit Profile</h4>
                </div>
                <div class="content">
                    <form class="form" role="form"   action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email address</label>
                                  <h5>  <?php echo $row["email"] ?></h5>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
																	<h5>	<?php echo $row["fname"] ?></h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
																		<h5>	<?php echo $row["lname"] ?></h5>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label> City</label>
                                    <input type="text" name="city" class="form-control" value="<?php echo $row["city"] ?>" placeholder="City">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Country</label>
                                    <input type="text" name="country" value="<?php echo $row["country"] ?>"  class="form-control" placeholder="Country">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Update Status</label>
                                    <textarea rows="5" name="abtme" class="form-control" placeholder="<?php echo $row["abtme"] ?>"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit"  name="sbtun" class="btn btn-info btn-fill pull-right">Update Profile</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>


        <footer class="footer">
            <div class="container-fluid">

                <p class="copyright pull-right">
                    &copy; 2016 <a href="#">MelloMANIAC</a>, Built by:
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="../assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="../assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="../assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="../assets/js/demo.js"></script>
</html>

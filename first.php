<!doctype html>
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "avy";
$conn = new mysqli($servername, $username, $password, $dbname);
if(isset($_SESSION["username"]));
else {
  header("location: /Project/a.php");
}
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$err="";
if(isset($_POST["sbtun"])){
	if(!empty($_POST["fname"])&&!empty($_POST["lname"])&&!empty($_POST["city"])&&!empty($_POST["country"])&&!empty($_POST["abtme"])){
		$email=$_SESSION["username"];
		$fname=$_POST["fname"];
		$lname=$_POST["lname"];
		$city=$_POST["city"];
		$country=$_POST["country"];
		$abtme=$_POST["abtme"];
		$conn->query("UPDATE login_table SET first='25' WHERE username='".$email."'");
		$sql="INSERT INTO PROFILE VALUES ('$email','$fname','$lname','$city','$country','$abtme','default-profile.png','default-cover.jpg')";
		$conn->query($sql);

    header("location: /Project/home.php");
	}
	else {
$err="*Enter all details";
	}
}
?>
<html>
<head>
	<title>melloMANIAC</title>

    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

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
                <a  class="simple-text">
                    melloMANIAC
									                </a>
            </div>

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
                    <a class="navbar-brand" href="profile.php">Fill the profile</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="lg.php">
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
                                    <h3><?php echo $_SESSION["username"]?></h3>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text"  name="fname" class="form-control" placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="lname" class="form-control" placeholder="Last Name">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text"  name="city" class="form-control" placeholder="City">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Country</label>
                                    <input type="text" name="country" class="form-control" placeholder="Country">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Status</label>
                                    <textarea rows="5" name="abtme" class="form-control" placeholder="Here can be your description"></textarea>
                                </div>
                            </div>
                        </div>
													<?php echo $err; ?>
                        <button type="submit"  name="sbtun" class="btn btn-info btn-fill pull-right">Submit details</button>
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
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>
</html>

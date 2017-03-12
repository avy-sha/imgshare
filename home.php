<!doctype html>
<?php
session_start();
if(isset($_SESSION["username"]));
else {
  header("location: /Project/a.php");
}
$str=$_SERVER["PHP_SELF"];
$upost="uploadpost.php";
if(isset($_GET["page"])){
  $str=$_SERVER["PHP_SELF"].'?page='.$_GET["page"];
  $upost="uploadpost.php?page=".$_GET["page"];
  $npage=$_GET["page"];
}
else{
  $npage=1;
}
if(isset($_POST["sbtunnext"])){
if(!isset($_GET["page"])){
  header('location:home.php?page=2');
}
else if(isset($_GET["page"])){
  $npage=$_GET["page"]+1;
  header('location:home.php?page='.$npage.'');
}}
if(isset($_POST["sbtunprev"])){
if(isset($_GET["page"]) &&$_GET["page"]==2){
  header('location:home.php');
}
else if(isset($_GET["page"])){
  $npage=$_GET["page"]-1;
  header('location:home.php?page='.$npage.'');
}}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "avy";
$conn = new mysqli($servername, $username, $password, $dbname);
if(isset($_SESSION["check"]) && $_SESSION["check"]=true);
else {
  header("location: /Project/a.php");
}
$email=$_SESSION["username"];
$sql="SELECT * from PROFILE where email='$email' ";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$sql="SELECT MAX(id) from post";
$result = $conn->query($sql);
$rowvalue=$result->fetch_assoc();
//if($_GET["page"]==1);
if(!isset($_GET["page"])){
$_SESSION["max"] = $rowvalue["MAX(id)"];}

 ?>
<html>
<head>
	<title>MelloMANIAC</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

    <link href="assets/css/demo.css" rel="stylesheet" />
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple">

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="/Project/home.php" class="simple-text">
                    MelloMANIAC
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="/Project/home.php">
                        <i class=""></i>
                        <p>Home</p>
                    </a>
                </li>
                <li>
                    <a href="profile.php">
                        <i ></i>
                        <p>Profile</p>
                    </a>
                </li>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <li>
                    <a href="account.php">
                        <i class=""></i>
                        <p>Account</p>
                    </a>
                </li>
                <li>
                    <a href="lg.php">
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
                    <a class="navbar-brand" ><?php echo "Hey ".$row["fname"]." !!"; ?></a>
                </div>
                <div class="collapse navbar-collapse" >
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="account.php">
                               Account
                            </a>
                        </li>
                        <li>
                            <a href="lg.php" >
                                Log out
                            </a>
                        </li>
                    </ul>
                </div>
							</form>
            </div>
        </nav>

    <form  action="<?php echo $upost;?>" method="post" enctype="multipart/form-data">
      <textarea rows="2" name="status" class="form-control" placeholder="Post Something"></textarea>
    <label class="btn btn-link" style="border:0;">
      <p style="text-align:right;font-size:2rem;">Upload Pic</p>
      <input id="my-file-selector" type="file"  name='file' style="display:none;">
    </label>
    <input type="submit" class="btn btn-info btn-fill "  value="Post">
    </form>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
									<div class="col-md-10">
										<div class="card">

											<ul class="nav nav-tabs nav-justified">
  <li ><a data-toggle="tab" href="#hot"><h3>Hot</h3></a></li>
  <li class="active"><a data-toggle="tab" href="#fresh"><h3>Fresh</h3></a></li>
</ul>

<div class="tab-content">
  <div id="hot" class="tab-pane fade">
		<div class="table">
			<table class="table">
				<tbody>

				</tbody>
			</table>
		</div>
  </div>

  <div id="fresh" class="tab-pane fade in active">
    <div class="table">
			<table class="table">
				<tbody>
					<?php

          if($_SESSION["max"]>2){
            $var=3*$npage;
          }else{
            $var=$_SESSION["max"];
          }
          if($_SESSION["max"]-$var<0){
            $var=$_SESSION["max"];
          }
          for ($x = $_SESSION["max"]-(3*($npage-1)); $x >$_SESSION["max"]-$var; $x--) {
          $sql="SELECT * from post where id='$x' ";
          $postquery = $conn->query($sql);
          $pow = $postquery->fetch_assoc();
          $curremail=$pow["email"];
          $sql="SELECT fname,lname from PROFILE where email='$curremail'";
          $postquery = $conn->query($sql);
          $chow = $postquery->fetch_assoc();
           echo'<tr>
						<td>
              <div>
              <b><a href="http://localhost/Project/searchprofile.php?username='.$curremail.'"><p><h2>'.$chow["fname"].' '.$chow["lname"].'</h2></p></a><b>
              <p>'.$pow["status"].'</p>
              <div class="row">
                <div class="col-md-offset-1">
              <img src="'.$pow["linkimg"].'" height=400rem width=400rem />
              </div>
              </div>

              <div class="row">
                <!--buttons here-->
                <div class="col-md-offset-1 col-md-1">
                  1
                </div>
                <div class="col-md-1">
                  2
                </div>
                <div class="col-md-1">
                  3
                </div>
              </div>
              <hr>
              </div>
						</td>
					</tr>';
          if($_SESSION["max"]-$var+1==$x){
            echo '
              <tr>
                <td>
                <form class="form" role="form"   action="'.$str.'"  method="POST">';
                if($x==1){
                  echo'no more content to show';
                }
                  if($npage!=1){
                echo' <div class="col-md-1 col-centered text-center"><button type="submit"  name="sbtunprev" class="btn btn-info btn-fill pull-right">
                  prev</button>
                </div>';}
                if($npage!=ceil($_SESSION["max"]/3))
                echo' <div class="col-md-1 col-centered text-center"><button type="submit"  name="sbtunnext" class="btn btn-info btn-fill pull-right">
                  next</button>
                </div>';
                echo'
                </form></td>
    					</tr>
            </tbody>
            </table>
            </div>
            </div>';
          }}
           ?>

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

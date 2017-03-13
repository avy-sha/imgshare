<!doctype html>
<?php
session_start();
$email=$_GET["username"];
if($email==$_SESSION["username"]){
  header("location:profile.php");
}
$str=$_SERVER["PHP_SELF"].'?username='.$email;
if(isset($_GET["page"])){
  $str=$_SERVER["PHP_SELF"].'?page='.$_GET["page"].'&username='.$email;
  $npage=$_GET["page"];
}
else{
  $npage=1;
}
if(isset($_POST["sbtunnext"])){
if(!isset($_GET["page"])){
  header('location:Searchprofile.php?username='.$email.'&page=2');
}
else if(isset($_GET["page"])){
  $npage=$_GET["page"]+1;
  header('location:Searchprofile.php?username='.$email.'&page='.$npage.'');
}}
if(isset($_POST["sbtunprev"])){
if(isset($_GET["page"]) &&$_GET["page"]==2){
  header('location:Searchprofile.php?username='.$email);
}
else if(isset($_GET["page"])){
  $npage=$_GET["page"]-1;
  header('location:Searchprofile.php?username='.$email.'&page='.$npage.'');
}}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "avy";
$conn = new mysqli($servername, $username, $password, $dbname);
$folder = "uploads";

$result = $conn->query("SELECT * FROM profile WHERE email='$email'") ;
$row = $result->fetch_assoc();
$resultp = $row["pp"];
$resultc=$row["cover"];
$sql="SELECT count(id) from post where email='$email'";
$result = $conn->query($sql);
$rowvalue=$result->fetch_assoc();
//if($_GET["page"]==1);
if(!isset($_GET["page"])){
$_SESSION["count"] = $rowvalue["count(id)"];}
 ?>
 <html>
 <head>
   <title>MelloMANIAC</title>

   <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />

   <link href="../assets/css/animate.min.css" rel="stylesheet"/>

   <link href="../assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

   <link href="../assets/css/demo.css" rel="stylesheet" />
   <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
   <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
   <link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
   <style>
   #bottom {
     position: absolute;
     bottom: 0px;
   }

   *{margin:0px;padding:0px}
   body{font-family: Arial, Helvetica, sans-serif;background-color: #e9eaed;color: #333333;}
   #container{margin:0 auto;width:auto;}
   #timelineContainer{width:100%;position:relative}
   #timelineBackground {
     position: relative;
     margin-top: -20px;
     overflow: hidden;
   }

   .col-centered {
     float: none;
     margin: 0 auto;
   }

   #timelineProfilePic {
     width: 170px;
     height: 170px;
     border: 1px solid #666666;
     background-color: #ffffff;
     position: relative;;
     margin-top: -7%;
     z-index: 1000;
     overflow: hidden;
     border-radius: 30%;
   }
   #timelineTitle {
     color: #444;
     font-size: 24px;
     margin-top: 3rem;
     position: relative;
     font-weight: bold;
     text-rendering: optimizelegibility;
     text-shadow: 0 0 0.1rem rgba(0,0,0,.8);
     z-index: 999;
     text-transform: capitalize;
   }
   #timelineShade {
     min-height: 95px;
     position: relative;
     margin-top: -95px;
     width: 100%;
   }
   .timelineUploadBG {
     position: absolute;
     height: 40px;
     width: 40px;
   }
   #timelineNav {
     border: 1px solid #d6d7da;
     background-color: #ffffff;
     min-height: 43px;
     margin-bottom: 10px;
     position: relative;
   }
 </style>
 </head>
 <body>

   <div class="wrapper">
     <div class="sidebar" data-color="purple">

       <div class="sidebar-wrapper">
         <div class="logo">
           <a href="/project/server/home.php" class="simple-text">
             MelloMANIAC
           </a>
         </div>

         <ul class="nav">
           <li >
             <a href="/project/server/home.php">
               <i class=""></i>
               <p>Home</p>
             </a>
           </li>
           <li>
             <a href="profile.php">
               <i class=""></i>
               <p>Profile</p>
             </a>
           </li>
         </ul>
         <ul class="nav" id="bottom">
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
             <a class="navbar-brand" href="#">Search profile</a>
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


     <div class="content">
       <div class="container-fluid">
         <div class="row">
           <div class="col-md-10">
             <div id="container">

               <div id="timelineContainer">
                 <!-- timeline background -->
                 <div id="timelineBackground">
                   <img src="<?php echo $folder . '/' . $resultc?>" class="bgImage" style="margin-top:-10px; width:100%; height:auto; object-fit:contain;">
                 </div>
               </div>

               <!-- timeline profile picture -->
               <div class="row">
                 <div class="col-md-2 col-centered" id="timelineProfilePic"><img src="<?php echo $folder . '/' . $resultp?>" style="object-fit:fill; width:125%; height:auto; margin-left:-2rem"></div>
               </div>
               <!-- timeline title -->
               <div class="row">
                 <div class="col-md-offset-4 col-md-4 text-center" id="timelineTitle"><?php echo $row["fname"].' '.$row["lname"] ?></div>
               </div>

               <!-- timeline nav -->
               <div id="timelineNav">
                 <div class="table">
                   <table class="table">
                     <tbody>
                       <?php

                       if($_SESSION["count"]>2){
                         $var=3*$npage;
                       }else{
                         $var=$_SESSION["count"];
                       }
                       if($_SESSION["count"]-$var<0){
                         $var=$_SESSION["count"];
                       }
                       $sql="SELECT * FROM post where email='$email'";
                       $postquery = $conn->query($sql);

                       $pow = array();
                       while( $pow[] = $postquery->fetch_assoc());
                       $curremail=$pow[0]["email"];
                       $sql="SELECT fname,lname from PROFILE where email='$curremail'";
                       $postquery = $conn->query($sql);
                       $chow = $postquery->fetch_assoc();
                       for ($x = $_SESSION["count"]-(3*($npage-1)); $x >$_SESSION["count"]-$var; $x--) {
                         $y=$x-1;
                        echo'<tr>
                         <td>
                           <div>
                           <b><a href="http://localhost/project/server/searchprofile.php?username='.$curremail.'"><p><h2>'.$chow["fname"].' '.$chow["lname"].'</h2></p></a><b>
                           <p>'.$pow[$y]["status"].'</p>
                           <div class="row">
                             <div class="col-md-offset-1">
                           <img src="'.$pow[$y]["linkimg"].'" height=400rem width=400rem />
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
                       if($_SESSION["count"]-$var+1==$x){
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
                             if($npage!=ceil($_SESSION["count"]/3))
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

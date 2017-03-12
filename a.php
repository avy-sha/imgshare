<!--DOCTYPE html-->

<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "avy";
// Create connection

$name=$nemail=$npassword=$rpassword="";
$nameErr=$nemailErr=$npassErr=$rpassErr="";
$mainErr="";
// define variables and set to empty values
$emailErr =$passErr=  "";
$Err="";

$email = $password= "";
$tpassword="";
$display_1="";
$display_2="display:none";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
if( isset($_SESSION["check"])&&$_SESSION["check"]==true){
  echo("boo");
  header("location: /Project/home.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST["btnSubmit"])){

  if (empty($_POST["email"])) {
    $Err = "*Username cannot be empty!!";
  } else {
    $email = test_input($_POST["email"]);
    echo "$email";
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $Err = " *Invalid username format";
    }
    else
    $Err="";
  }
  if($Err==""){
    $sql="SELECT password,active,first from login_table where username='$email' ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
      $tpassword=$row["password"];
      $active=$row["active"];
      $first=$row["first"];

  if (empty($_POST["password"])) {
    $Err = "*Enter password!";
  } else {
    $password = md5(test_input($_POST["password"]));
    // check if password is correct
    if($password==$tpassword){
if($active==25){
    if($first==25){
  $_SESSION["username"] = $email;
  $_SESSION["check"]= true;
    header("Refresh:0;URL=/Project/home.php");}
    else if($first==24){
      $_SESSION["username"] = $email;
      $_SESSION["check"]= false;
    header("Refresh:0;URL=/Project/first.php");}
  }
    else
    $Err="account not verified!!";
  }
    else{
      $Err="username or password incorrect!!";
    }
  }}

}
elseif (isset($_POST["change"])) {
  $nameErr=$nemailErr=$npassErr=$rpassErr="";
  $mainErr="";
  $emailErr =$passErr=  "";
  $Err="";

}
else {
  $display_1="display:none";
  $display_2="";
  if (empty($_POST["name"])) {
    $mainErr = "name cannot be empty!!";
  } else {
    $name = test_input($_POST["name"]);
    // check if e-mail address is well-formed
  }
  if (empty($_POST["nemail"])) {
    $nemailErr = "*Email cannot be empty!!";
  } else {
    $nemail = test_input($_POST["nemail"]);
    echo "$nemail";
    // check if e-mail address is well-formed
    if (!filter_var($nemail, FILTER_VALIDATE_EMAIL)) {
      $nemailErr = " *Invalid email format";
    }
    else{
    $nemailErr="";
    $sql="SELECT username from login_table where username='$nemail' ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if($result->num_rows>0)
      $nemailErr="email already exists";

  }
  }
  if (empty($_POST["npassword"])) {
    $npassErr = "*password cannot be empty!!";
  }else{
    $npassword = md5(test_input($_POST["npassword"]));
  }
  if (empty($_POST["rpassword"])) {
    $rpassErr = "*repeat password!!";
  }else{
    $rpassword = md5(test_input($_POST["rpassword"]));
    if($rpassword!=$npassword)
    $rpassErr="input same password!!";
  }
  if($mainErr=="" &&$npassErr=="" &&$nemailErr=="" && $rpassErr=="")
  {$hash = md5( rand(0,1000) );
    require ("/PHPMailer/mailtest.php");
    if($rpassErr=='Verification mail has been sent'){
      $sql="INSERT INTO login_table  VALUES ('$nemail', '$npassword', '24','$hash','24')";
      $result = $conn->query($sql);
    }
  }
}}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="login.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript" src="loginsignup.js"></script>

</head>
<body>
  <div class="container"><br><br>
    <div class="row">
      <div class="col-md-12">
        <dic class="col-md-offset-7 col-md-5">
          <div class="login" id="login_div" style="<?php echo $display_1;?>">
            <h2 class="text-center"> Login </h2><br>
            <form class="form" role="form"   action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-group">
              <div class="input-group input-group-unstyled">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="email" name="email" value="<?php echo $email;?>" class="form-control" placeholder="Username" />
                  <span class="error"> </span>
              </div>
              <br>
              <div class="input-group input-group-unstyled">
                <span class="input-group-addon"><i class="fa fa-key"></i></span><input type="password" name="password"  class="form-control"placeholder="Password" />
                  <span class="error"> </span>
              </div>
              <br>
              <span class="error"> <?php echo $Err;?></span>
              <div class='text-center'>
                <button class='btn btn-lg btn-blue btn-grey' name="btnSubmit" value="btnSubmit"><i class='fa fa-sign-in'></i> Login</button><br><br>
                Not a member? <a href="#" class="btn_click" name="change">Sign Up!</a>
              </div>
            </div></form>
          </div>

          <div class="signup" id="signup_div" style="<?php echo $display_2;?>" >
            <h2 class="text-center"> Signup </h2><br>
            <form class="form" role="form"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">
            <div class="form-group">
              <div class="input-group input-group-unstyled">
                <span class="input-group-addon"><i class="fa fa-user"></i></span><input type="text" name="name" value="<?php echo $name;?>" class="form-control" placeholder="Name" />
              </div>
              <span class="error"> <?php echo $mainErr;?></span>
              <br>
              <div class="input-group input-group-unstyled">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" name="nemail" value="<?php echo $nemail;?>" class="form-control" placeholder="Email ID" />
              </div>
              <span class="error"> <?php echo $nemailErr;?></span>
              <br>
              <div class="input-group input-group-unstyled">
                <span class="input-group-addon"><i class="fa fa-key"></i></span><input type="password" name="npassword"  class="form-control" placeholder="Password" />
              </div>
                <span class="error"> <?php echo $npassErr;?></span>
              <br>
              <div class="input-group input-group-unstyled">
                <span class="input-group-addon"><i class="fa fa-key"></i></span><input type="password" name="rpassword"  class="form-control" placeholder="Repeat Password" />
              </div>
                <span class="error"> <?php echo $rpassErr;?></span>
              <br>

              <div class='text-center'>
                <button class='btn btn-lg btn-blue btn-grey'><i class='fa fa-sign-in'></i> Signup</button><br><br>
                Already a member? <a href="#" class="btn_click" name="change">Login!</a>
              </div>
            </div></form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

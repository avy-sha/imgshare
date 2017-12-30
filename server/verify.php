<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "avy";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_GET['ck']) && !empty($_GET['ck']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    // Verify data
    $email =($_GET['ck']); // Set email variable
    $hash = ($_GET['hash']); // Set hash variable

    $result = $conn->query("SELECT username, hash, active FROM login_table WHERE username='".$email."' AND hash='".$hash."' AND active='24'") ;
    $row = $result->fetch_assoc();
    if($result->num_rows>0){
        // We have a match, activate the account
        $conn->query("UPDATE login_table SET active='25' WHERE username='".$email."' AND hash='".$hash."' AND active='24'");
        echo 'Your account has been activated . redirecting to home page';
        $_SESSION["username"] = $email;
        $_SESSION["check"]= false;
      header("Refresh:3; url=/Project/server/first.php");}
      }
?>

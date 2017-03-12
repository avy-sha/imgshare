<?php
//turn on php error reporting
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "avy";
$conn = new mysqli($servername, $username, $password, $dbname);
$email=$_SESSION["username"];
$result = $conn->query("SELECT value FROM servervariables WHERE variable='post'") ;
$row = $result->fetch_assoc();
$tobename=$row["value"]+1;
$result = $conn->query("SELECT MAX(id) from post") ;
$row = $result->fetch_assoc();
$id=$row["MAX(id)"]+1;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$status   = $_POST["status"];
	$name     = $_FILES['file']['name'];
	$tmpName  = $_FILES['file']['tmp_name'];
	$error    = $_FILES['file']['error'];
	$size     = $_FILES['file']['size'];
  $ext	  = strtolower(pathinfo($name, PATHINFO_EXTENSION));

	switch ($error) {
		case UPLOAD_ERR_OK:
			$valid = true;
			//validate file extensions
			if ( !in_array($ext, array('jpg','jpeg','png','gif')) ) {
				$valid = false;
				$response = 'Invalid file extension.';
			}
			//validate file size
			if ( $size/1024/1024 > 2 ) {
				$valid = false;
				$response = 'File size is exceeding maximum allowed size.';
			}
			//upload file
			if ($valid) {
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				$targetPath =  dirname( __FILE__ ) . DIRECTORY_SEPARATOR. 'posts' . DIRECTORY_SEPARATOR. 'post'.$tobename.'.'.$ext;
			//	move_uploaded_file($tmpName,$targetPath);
				$nextname='posts/post'.$tobename.'.'.$ext;
				move_uploaded_file($tmpName,$targetPath);
//insert wali query
				$conn->query("INSERT INTO post VALUES ('$id','$email','$nextname','$status')");
				$conn->query("UPDATE servervariables SET value='$tobename' WHERE variable='post'");
				if(!isset($_GET["page"])){
			  header( 'Location: home.php' ) ;}
				else{
					header( 'Location: home.php?page='.$_GET["page"].'' ) ;
				}
				exit;
			}
			break;
		case UPLOAD_ERR_INI_SIZE:
			$response = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
			break;
		case UPLOAD_ERR_PARTIAL:
			$response = 'The uploaded file was only partially uploaded.';
			break;
		case UPLOAD_ERR_NO_FILE:{
			$response = 'No file was uploaded.';
			if(!isset($_GET["page"])){
			header( 'Location: home.php' ) ;}
			else{
				header( 'Location: home.php?page='.$_GET["page"].'' ) ;
			}
		 }
			break;
		case UPLOAD_ERR_NO_TMP_DIR:
			$response = 'Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.';
			break;
		case UPLOAD_ERR_CANT_WRITE:
			$response = 'Failed to write file to disk. Introduced in PHP 5.1.0.';
			break;
		default:
			$response = 'Unknown error';
		break;
	}

	echo $response;
}
?>

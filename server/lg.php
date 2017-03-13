<?php
session_start();
if(isset($_SESSION["check"]));
else {
  header("location: /project/server/a.php");
}
session_unset();
unset($_SESSION["check"]);
session_destroy();
header("location:/project/server/a.php");
 ?>

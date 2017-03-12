<?php
date_default_timezone_set('Asia/Kolkata');
require 'PHPMailerAutoload.php';
$mail = new PHPMailer;

//$mail->SMTPDebug = 1;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp-mail.outlook.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'OUTLOOK EMAIL';                 // SMTP username
$mail->Password = 'OUTLOOK PASSWORD';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('OUTLOOK EMAIL');
$mail->addAddress($nemail);     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Verification Email';
$mail->Body    = 'Verify to activate your account<br>click on this link to activate your account :  http://localhost/Project/verify.php?ck='.$nemail.'&hash='.$hash;
$mail->AltBody = '';

if(!$mail->send()) {
  $rpassErr= 'Mail could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    $rpassErr= 'Verification mail has been sent';
}
?>

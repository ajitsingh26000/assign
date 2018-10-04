<?php
include 'myauth.php';
include 'functions.php';
$user = new User();
if(!$user->check_email($_POST['email'])){
    echo "Email entered is not correct";
    die();
}
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mailserv = "smtp.gmail.com";
include 'connection.php';
// $temp= ;
$data=array($_POST["email"]);
$userid = $connection->prepare("Select * from Users WHERE email = ?");
// echo "USER ID:";
// print_r($userid);
// echo "<br>Set Fetch Mode";
// print_r($userid->setFetchMode(PDO::FETCH_NUM));
$userid->setFetchMode(PDO::FETCH_NUM);
// echo "<br>";
// $userid->setFetchMode(PDO::FETCH_ASSOC);
$userid->execute($data);
$row = $userid->fetchall();
if(!$row){
    echo "No email found"; 
    die();
}

$mail = new PHPMailer(true);                      // Passing `true` enables exceptions
try {
//Server settings
//    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
   $mail->isSMTP();                                      // Set mailer to use SMTP
   $mail->Host = $mailserv;  // Specify main and backup SMTP servers
   $mail->SMTPAuth = true;                               // Enable SMTP authentication
   $mail->Username = $options['username'];                 // SMTP username
   $mail->Password = $options['password'];                           // SMTP password
   $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
   $mail->Port = $options['port'];//587;                                    // TCP port to connect to
   
   //Recipients
   $mail->setFrom('ajitsingh26000@gmail.com', 'Mailer');
   
   $mail->addAddress($_POST["email"], 'Joe User');     // Add a recipient
//    $mail->addAddress('ajitsingh26000@gmail.com');               // Name is optional
   // $mail->addReplyTo('info@example.com', 'Information');
   // $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

   //Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

   //Content
   $mail->isHTML(true);                                  // Set email format to HTML
   $mail->Subject = "Your Password";
   $mail->Body    = "Your Password is ".$row[0][3];
   // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
  // print_r($mail);
   //die();
   $mail->send();
   echo 'Password has been set to the specific email address';
} catch (Exception $e) {
   echo 'Message could not be sent. Please try again';
}
?>
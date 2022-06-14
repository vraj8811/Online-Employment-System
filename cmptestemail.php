<?php

ob_start();

//changes
session_start();

if(!isset($_SESSION['secretcode'])) {
    header('Location: index.php');
}
$sendaddr = $_SESSION['cmpemail'];
$secretcode = $_SESSION['secretcode'];
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'kalppariya1234@outlook.com';                     //SMTP username
    $mail->Password   = '@\#12kalp12#\@';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('kalppariya1234@outlook.com', 'Naukri.com');
    $mail->addAddress($sendaddr, $username);

    //Attachments  //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Verification Code for Registration';
    $mail->Body    = '<div class="container p-5"><p>Here is your verification code :-</p>
    <h1><b> <strong>'.$secretcode.'</strong></b></h1>
    <sub>Only valid for <strong color="red">5 MINUTES</strong></sub>
    </div>';
    $mail->AltBody = 'This E-mail does not support obsolete Mail clients without HTML support!';

    $mail->send();
    echo 'Message has been sent';

    setcookie("erroruserreg", false);
    setcookie("successuserreg", true);

    header("Location: verificationcmp.php");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
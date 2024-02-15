<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';


$subject = $_POST['subject'];
$message = $_POST['message'];
$recipientEmail = $_POST['recipientEmail'];

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true;
    $mail->Username = 'aensate@gmail.com'; 
    $mail->Password = 'qkwm agor oddh xati'; 
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('aensate@gmail.com', 'Your Name'); 
    $mail->addAddress($recipientEmail);
    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->send();

    echo 'Email sent successfully';
} catch (Exception $e) {
    echo 'Error: ' . $mail->ErrorInfo;
}
?>
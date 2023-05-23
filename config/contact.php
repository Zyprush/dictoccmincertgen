<?php
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Get form inputs
$name = $_POST['name'];
$receiver_email = $_POST['receiver_email'];
$sender_email = $_POST['sender_email'];
$message = $_POST['message'];

// Set SMTP settings
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = 'certgendict@gmail.com';
$mail->Password = $_ENV['PASS_KEY'];

// Set sender
$mail->setFrom($sender_email, $sender_email);

$mail->addAddress($receiver_email, 'Jake');
$mail->Subject = $name;
$mail->Body = $message;

// Send the email
try {
    $mail->send();
    echo 'Sent email to ' . $receiver_email;
  } catch (Exception $e) {
    echo 'Error sending email to ' . $receiver_email . ': ' . $receiver_email->ErrorInfo;
  }

?>
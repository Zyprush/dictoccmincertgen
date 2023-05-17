<?php
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Get variables
$selectedAttendees = json_decode($_POST['selectedAttendees']);
$completedCertificates = json_decode($_POST['completedCertificates']);
$folderPath = $_POST['folderPath'];

// Get form inputs
$subject = $_POST['subject'];
$message = $_POST['message'];

// Set SMTP settings
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.sendgrid.net';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = 'apikey';
$mail->Password = $_ENV['SENDGRID_API_KEY'];

// Set sender
$mail->setFrom('bausahanz@gmail.com', 'hanz');

// Send separate email to each recipient with their respective certificate
foreach ($selectedAttendees as $attendee) {
  $email = $attendee->certificate_email;
  $name = $attendee->certificate_name;
  $certificatePath = $folderPath . '/' . str_replace(' ', '_', htmlspecialchars($email, ENT_QUOTES)) . '.pdf';

  // Create a new email instance for each recipient
  $mail->clearAllRecipients();
  $mail->clearAttachments();
  $mail->addAddress($email, $name);

  // Attach the recipient's certificate
  $mail->addAttachment($certificatePath);

  // Set email content
  $mail->Subject = $subject;
  $mail->Body = $message;

  // Send the email
  try {
    $mail->send();
  } catch (Exception $e) {
    echo 'Error sending email to ' . $email . ': ' . $mail->ErrorInfo;
  }
}

$_SESSION['status'] = "Email Sent!";
header('location: ../pages/webinarlist.php');
?>

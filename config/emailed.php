<?php
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Get variables
$selectedAttendees = json_decode($_POST['selectedAttendees']);
$completedCertificates = json_decode($_POST['completedCertificates']);
$folderPath = $_POST['folderPath'];

$webinar_id = $_POST['webinar_id'];

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

  // Hide the loading overlay and redirect the user to a new page
  echo '<script>hideLoadingOverlay(); window.location.href = "../pages/webinarlist.php";</script>';

}

// Delete the folder and its contents
if (file_exists($folderPath)) {
  $success = deleteFolder($folderPath);
  if (!$success) {
    echo 'Error deleting folder: ' . $folderPath;
  }
}

include('dbcon.php');
// Update the status value to 1
$webinarRef = $database->getReference('webinars/' . $webinar_id . '/status');
$webinarRef->set(1);

// Function to delete a folder and its contents recursively
function deleteFolder($folder) {
  if (!is_dir($folder)) {
    return false;
  }

  $files = glob($folder . '/*');
  foreach ($files as $file) {
    if (is_dir($file)) {
      deleteFolder($file);
    } else {
      unlink($file);
    }
  }

  return rmdir($folder);
}

$_SESSION['status'] = "Email Sent!";
header('location: ../pages/webinarlist.php');
?>

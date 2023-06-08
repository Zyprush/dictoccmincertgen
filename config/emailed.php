<?php
require '../vendor/autoload.php';
session_start();

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
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true;
$mail->Username = 'certgendict@gmail.com';
$mail->Password = $_ENV['PASS_KEY'];

// Set sender
$mail->setFrom('certgendict@gmail.com', 'DICT - Certificate');

// Enable SMTP keep-alive
$mail->SMTPKeepAlive = true;

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

include('dbconfig.php');

// Prepare the SQL query
$sql = "UPDATE webinars SET status = 1 WHERE webinar_id = '$webinar_id'";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Status updated successfully";
} else {
    echo "Error updating status: " . $conn->error;
}

// Close the database connection
$conn->close();

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

$_SESSION['status'] = "Email Successfully Sent!";
header('location: ../pages/dashboard.php');
?>

<?php
// signup.php

// Include the database configuration
require_once 'dbconfig.php';
require '../vendor/autoload.php';

// Start the session
session_start();

// Include PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Check if the table exists, if not, create it
$createTableQuery = "CREATE TABLE IF NOT EXISTS certgen_users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role TINYINT(1) NOT NULL DEFAULT 0
)";
$conn->query($createTableQuery);

// Check if the signup_tokens table exists, if not, create it
$createTokensTableQuery = "CREATE TABLE IF NOT EXISTS signup_tokens (
  id INT AUTO_INCREMENT PRIMARY KEY,
  token VARCHAR(255) NOT NULL,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($createTokensTableQuery);

// Check if the certgen_users table is empty
$checkEmptyQuery = "SELECT COUNT(*) FROM certgen_users";
$result = $conn->query($checkEmptyQuery);
$row = $result->fetch_row();
$isTableEmpty = $row[0] == 0;

// Check if the whitelisted table exists
$checkWhitelistedTableQuery = "SHOW TABLES LIKE 'whitelisted'";
$result = $conn->query($checkWhitelistedTableQuery);
$whitelistedTableExists = $result->num_rows > 0;

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the submitted data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Hash the password
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  if (!$whitelistedTableExists) {
    // Whitelisted table doesn't exist
    $_SESSION['status'] = "There is no whitelist yet";
    header('Location: ../pages/signup.php');
    exit();
  }

  // Check if the user's email already exists in the certgen_users table
  $checkEmailQuery = "SELECT COUNT(*) FROM certgen_users WHERE email = ?";
  $stmt = $conn->prepare($checkEmailQuery);
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_row();
  $emailExists = $row[0] > 0;

  if ($emailExists) {
    // Email already exists
    $_SESSION['status'] = "Email already exists!";
    header('Location: ../pages/signup.php');
    exit();
  }

  if ($isTableEmpty) {
    // First time signing up, assign admin role
    $role = 1; // Admin role
  } else {
    // Check if the user is whitelisted
    $whitelistedQuery = "SELECT * FROM whitelisted WHERE email = ?";
    $stmt = $conn->prepare($whitelistedQuery);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
      // User is whitelisted, assign normal user role
      $role = 0; // Normal user role
    } else {
      // User is not whitelisted
      $_SESSION['status'] = "Email is not whitelisted!";
      header('Location: ../pages/signup.php');
      exit();
    }
  }

  // Generate a unique token
  $token = bin2hex(random_bytes(32));

  // Insert the token into the signup_tokens table
  $insertTokenQuery = "INSERT INTO signup_tokens (token, name, email, password) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($insertTokenQuery);
  $stmt->bind_param('ssss', $token, $name, $email, $hashedPassword);
  $insertResult = $stmt->execute();

  if ($insertResult) {
    // Send email with signup link
    $signupLink = 'http://localhost/dictoccmincertgen/config/signup_confirmation.php?token=' . urlencode($token);
    $mail = new PHPMailer;
    $mail->isSMTP();
    // Configure your SMTP settings
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Username = 'certgendict@gmail.com';
    $mail->Password = $_ENV['PASS_KEY'];
    $mail->setFrom('certgendict@gmail.com', 'DICT');
    $mail->addAddress($email, $name);
    $mail->Subject = 'Signup Confirmation';
    $mail->Body = "Please click the following link to confirm access your account: $signupLink";

    if (!$mail->send()) {
      // Email sending failed
      $_SESSION['status'] = "Error sending email. Please try again!";
      header('Location: ../pages/signup.php');
      exit();
    }

    // Redirect to a success page or display a success message
    $_SESSION['status'] = "Email sent! Please check your inbox.";
    header('Location: ../pages/signup.php');
    exit();
  } else {
    // Token insertion failed
    $_SESSION['status'] = "Error! Please sign up again!";
    header('Location: ../pages/signup.php');
    exit();
  }
}
?>

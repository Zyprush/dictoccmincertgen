<?php
// signup_confirmation.php

// Include the database configuration
require_once 'dbconfig.php';

// Start the session
session_start();

// Check if the token is provided in the URL
if (isset($_GET['token'])) {
  $token = $_GET['token'];

  // Check if the token exists in the signup_tokens table
  $checkTokenQuery = "SELECT * FROM signup_tokens WHERE token = ?";
  $stmt = $conn->prepare($checkTokenQuery);
  $stmt->bind_param('s', $token);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result && $result->num_rows > 0) {
    // Token is valid, retrieve user data
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $email = $row['email'];
    $password = $row['password'];

    // Insert user data into the certgen_users table
    $insertUserQuery = "INSERT INTO certgen_users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertUserQuery);
    $stmt->bind_param('sss', $name, $email, $password);
    $insertResult = $stmt->execute();

    if ($insertResult) {
      // Account created successfully, delete the token from signup_tokens table
      $deleteTokenQuery = "DELETE FROM signup_tokens WHERE token = ?";
      $stmt = $conn->prepare($deleteTokenQuery);
      $stmt->bind_param('s', $token);
      $stmt->execute();

      // Redirect to a success page or display a success message
      $_SESSION['status'] = "Account created successfully!";
      header('Location: ../pages/signin.php');
      exit();
    } else {
      // Account creation failed
      $_SESSION['status'] = "Error creating account. Please try again!";
      header('Location: ../pages/signup.php');
      exit();
    }
  } else {
    // Invalid or expired token
    $_SESSION['status'] = "Invalid or expired token!";
    header('Location: ../pages/signup.php');
    exit();
  }
} else {
  // Token not provided in the URL
  $_SESSION['status'] = "Invalid token!";
  header('Location: ../pages/signup.php');
  exit();
}
?>

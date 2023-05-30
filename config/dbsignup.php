<?php
// signup.php

// Include the database configuration
require_once 'dbconfig.php';

// Start the session
session_start();

// Check if the table exists, if not, create it
$createTableQuery = "CREATE TABLE IF NOT EXISTS certgen_users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role TINYINT(1) NOT NULL DEFAULT 0
)";
$conn->query($createTableQuery);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the submitted data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Hash the password
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Check if the user already exists
  $query = "SELECT * FROM certgen_users WHERE email = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result && $result->num_rows > 0) {
    // User already registered
    $_SESSION['status'] = "Email already used! Please Sign In";
    header('Location: ../pages/signin.php');
    exit();
  } else {
    // Insert the user into the database
    $insertQuery = "INSERT INTO certgen_users (name, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $role = 0; // Default role for normal users
    $stmt->bind_param('sssi', $name, $email, $hashedPassword, $role);
    $insertResult = $stmt->execute();

    if ($insertResult) {
      // Registration successful
      $_SESSION['status'] = "Sign Up successfully! Please Login";
      header('Location: ../pages/signin.php');
      exit();
    } else {
      // Registration failed
      $_SESSION['status'] = "Error! Please sign up again!";
      header('Location: ../pages/signun.php');
      exit();
    }
  }
}
?>

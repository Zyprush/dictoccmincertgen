<?php
// signup.php

// Include the database configuration
require_once 'dbconfig.php';

// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the submitted data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Hash the password
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Check if the user already exists
  $query = "SELECT * FROM certgen_users WHERE email = '$email'";
  $result = $db->query($query);

  if ($result && $result->num_rows > 0) {
        // User already registered
        $_SESSION['status'] = "Email already used! Please Sign In";
        header('Location: ../pages/signin.php');
        exit();
  } else {
    // Insert the user into the database
    $insertQuery = "INSERT INTO certgen_users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";
    $insertResult = $db->query($insertQuery);

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

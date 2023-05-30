<?php
// Start the session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  $_SESSION['status'] = "Login to access this page";
  header('Location: signin.php');
  exit();
}

// The user is logged in
$userId = $_SESSION['id'];
$name = $_SESSION['name'];
$role = $_SESSION['role'];

// You can perform additional actions here, such as fetching user information from the database or authorizing access to specific resources.

// Example usage: Display a welcome message
//echo "Welcome, $name!";

// Example usage: Access user-specific data from the database
// $query = "SELECT * FROM users WHERE id = '$userId'";
// $result = $db->query($query);
// $user = $result->fetch_assoc();
// echo "Email: " . $user['email'];

// Example usage: Log out functionality
// You can include a logout button or link that directs to a logout script to destroy the session and log the user out.
// <a href="logout.php">Logout</a>
?>

<?php
// Start the session
session_start();

// Destroy the session variables
unset($_SESSION['logged_in']);
unset($_SESSION['id']);
unset($_SESSION['username']);

// Redirect to the signin page
$_SESSION['status'] = "Logged out successfully!";
header('Location: ../pages/signin.php');
exit();
?>

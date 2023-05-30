<?php
require_once 'dbconfig.php';
session_start();

// Create the 'whitelisted' table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS whitelisted (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL UNIQUE
    )";
if ($conn->query($sql) !== TRUE) {
    die('Error creating table: ' . $conn->error);
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the email from the POST data
    $email = $_POST['email'];

    // Check if the email already exists in the 'whitelisted' table
    $checkQuery = "SELECT * FROM whitelisted WHERE email = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param('s', $email);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        // Email already exists in the 'whitelisted' table
        $_SESSION['status'] = "Email is already whitelisted.";
        header('location: ../pages/dashboard.php');
        exit;
    }

    // Prepare the SQL statement to insert the email
    $insertQuery = "INSERT INTO whitelisted (email) VALUES (?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param('s', $email);

    // Execute the statement
    if ($insertStmt->execute()) {
        // Email added successfully
        $_SESSION['status'] = "Email added to whitelist.";
    } else {
        // Failed to add email
        $_SESSION['status'] = "Failed to add email to whitelist.";
    }

    // Close the statements
    $insertStmt->close();
    $checkStmt->close();

    header('location: ../pages/dashboard.php');
} else {
    // Invalid request method
    http_response_code(405); // Set the appropriate HTTP response code for an invalid request method
    echo 'Invalid request method';
}

// Close the database connection
$conn->close();
?>

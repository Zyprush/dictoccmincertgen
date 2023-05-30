<?php
require_once 'dbconfig.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the edited name and email from the POST data
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Prepare the SQL statement to update the user details
    $sql = "UPDATE certgen_users SET name = ? WHERE email = ?";

    // Prepare and bind the parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $name, $email);

    // Execute the statement
    if ($stmt->execute()) {
        // Update successful
        $response = array(
            'success' => true,
            'message' => 'User details updated successfully',
        );
    } else {
        // Update failed
        $response = array(
            'success' => false,
            'message' => 'Failed to update user details',
        );
    }

    // Close the statement
    $stmt->close();

    // Send the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Invalid request method
    http_response_code(405); // Set the appropriate HTTP response code for an invalid request method
    echo 'Invalid request method';
}

// Close the database connection
$conn->close();

header('location: ../pages/admin-list.php');
?>

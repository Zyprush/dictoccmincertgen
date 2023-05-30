<?php
include('dbconfig.php'); // Include the database configuration file

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user email from the POST data
    $userEmail = $_POST['userEmail'];

    // Prepare the SQL statement to delete the user
    $sql = "DELETE FROM certgen_users WHERE email = ?";

    // Prepare and bind the parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $userEmail);

    // Execute the statement
    if ($stmt->execute()) {
        // Deletion successful
        $response = array(
            'success' => true,
            'message' => 'User deleted successfully',
        );
    } else {
        // Deletion failed
        $response = array(
            'success' => false,
            'message' => 'Failed to delete user',
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
?>

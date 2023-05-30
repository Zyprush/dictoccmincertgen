<?php
include('dbconfig.php'); // Include the database configuration file

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user ID from the POST data
    $userID = $_POST['userID'];

    // Prepare the SQL statement to delete the user
    $sql = "DELETE FROM certgen_users WHERE user_id = ?";

    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $userID);
    $stmt->execute();

    // Check if the deletion was successful
    $success = ($stmt->affected_rows > 0);

    // Close the statement
    $stmt->close();

    // Prepare the response data
    $response = array(
        'success' => $success,
    );

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

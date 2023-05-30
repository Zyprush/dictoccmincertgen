<?php
    include('dbconfig.php');
    
    // Check if the userEmail parameter exists
    if (isset($_POST['userEmail'])) {
        $userEmail = $_POST['userEmail'];

        // Update the user's role to 1 based on the email
        $query = "UPDATE certgen_users SET role = 1 WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $userEmail);
        
        if ($stmt->execute()) {
            // Promote operation successful
            $response = array('success' => true);
        } else {
            // Failed to promote user
            $response = array('success' => false);
        }

        $stmt->close();
    } else {
        // Invalid request
        $response = array('success' => false);
    }

    // Send the JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
?>

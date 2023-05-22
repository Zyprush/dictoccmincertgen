<?php
include('authentication.php');
// Retrieve the user ID from the session
$uid = $_SESSION['veryfied_user_id'];

try {
    // Get the user by UID
    $user = $auth->getUser($uid);

    // Get the user's email
    $displayName = $user->displayName;

    // Return the display name as a JSON response
    echo json_encode(['displayName' => $displayName]);
} catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
    // Return an error message as a JSON response
    echo json_encode(['error' => 'User not found']);
}
?>

<?php
require_once('dbconfig.php');
session_start();

// Retrieve the fullname and password from the query parameters
$fullname = $_GET['fullname'];
$password = $_GET['password'];

if (isset($_GET['code'])) {
    $verificationCodeId = $_GET['code'];

    // Retrieve the verification code from the admin table
    $stmt = $conn->prepare("SELECT * FROM certgen_users WHERE verification_code = ?");
    $stmt->bind_param("s", $verificationCodeId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $email = $row['email'];

        // Mark the verification code as verified in the admin table
        $stmt = $conn->prepare("UPDATE certgen_users SET verified = true WHERE verification_code = ?");
        $stmt->bind_param("s", $verificationCodeId);
        $stmt->execute();

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Create the user in the auth database
        $stmt = $conn->prepare("INSERT INTO certgen_users (email, password, name) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $hashedPassword, $fullname);
        $stmt->execute();

        if ($stmt->affected_rows === 1) {
            // User created successfully
            $stmt = $conn->prepare("DELETE FROM certgen_users WHERE verification_code = ?");
            $stmt->bind_param("s", $verificationCodeId);
            $stmt->execute();

            $_SESSION['status'] = "Sign up successful!";
            header('location: ../pages/signin.php');
            exit();
        } else {
            $_SESSION['status'] = "Sign up was not successful!";
            header('location: ../pages/signup.php');
            exit();
        }
    } else {
        $_SESSION['status'] = "Invalid verification code!";
        header('location: ../pages/signup.php');
        exit();
    }
} else {
    $_SESSION['status'] = "Verification code not provided!";
    header('location: ../pages/signup.php');
    exit();
}
?>

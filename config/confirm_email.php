<?php
require_once('dbcon.php');
session_start();
// Retrieve the fullname and password from the query parameters
$fullname = $_GET['fullname'];
$password = $_GET['password'];


if (isset($_GET['code'])) {
    $verificationCodeId = $_GET['code'];

    // Retrieve the verification code from the Firebase Realtime Database
    $verificationCodesRef = $database->getReference('verification_codes');
    $verificationCodeSnapshot = $verificationCodesRef->getChild($verificationCodeId)->getValue();

    if ($verificationCodeSnapshot && $verificationCodeSnapshot['verified'] === false) {
        $email = $verificationCodeSnapshot['email'];

        // Mark the verification code as verified in the database
        $verificationCodesRef->getChild($verificationCodeId)->update([
            'verified' => true
        ]);

        // Create the user in the auth database
        $userProperties = [
            'email' => $email,
            'emailVerified' => true,
            'password' => $password,
            'displayName' => $fullname,
        ];

        try {
            $createdUser = $auth->createUser($userProperties);

            if ($createdUser) {
                $verificationCodesRef->getChild($verificationCodeId)->remove();
                $_SESSION['status'] = "Sign up successful!";
                header('location: ../pages/signin.php');
                exit();
            } else {
                $_SESSION['status'] = "Sign up was not successful!";
                header('location: ../pages/signup.php');
                exit();
            }
        } catch (Exception $e) {
            $_SESSION['status'] = "Failed to create user: " . $e->getMessage();
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

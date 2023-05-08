<?php
session_start();

unset($_SESSION['veryfied_user_id']);
unset($_SESSION['idTokenString']);

if(isset($_SESSION['expiry_status'])){
    $_SESSION['status'] = "Session Expired!";
} else {
    $_SESSION['status'] = "Logged out successfully!";
}
header('location: ../pages/signin.php');
exit();

?>
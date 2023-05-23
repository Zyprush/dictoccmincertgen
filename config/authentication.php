<?php
session_start();
include('dbcon.php');

use Kreait\Firebase\Exception\Auth\InvalidArgumentException;

if(isset($_SESSION['veryfied_user_id'])){

    $uid = $_SESSION['veryfied_user_id'];
    $idTokenString = $_SESSION['idTokenString'];

    try {
        $verifiedIdToken = $auth->verifyIdToken($idTokenString);
    } catch (InvalidArgumentException $e) {
        $_SESSION['expiry_status'] = "Token expired! Please Sign In again!";
        header('Location: logout.php');
        exit();
    }

} else {
    $_SESSION['status'] = "Login to access this page";
    header('Location: signin.php');
    exit();
}
?>

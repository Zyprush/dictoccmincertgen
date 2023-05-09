<?php
session_start();
include('dbcon.php');

if(isset($_SESSION['veryfied_user_id'])){

    $uid = $_SESSION['veryfied_user_id'];
    $idTokenString = $_SESSION['idTokenString'];

    try {
        $verifiedIdToken = $auth->verifyIdToken($idTokenString);
    } catch (FailedToVerifyToken $e) {
        //echo 'The token is invalid: '.$e->getMessage();
        $_SESSION['expiry_status'] = "Token expired/Invalid! Sign In again!";
        header('location: logout.php');
        exit();
    }

}else{
    $_SESSION['status'] = "Login to access this page";
    header('location: signin.php');
    exit();
}

?>
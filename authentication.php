<?php
session_start();
include('dbcon.php');

if(isset($_SESSION['veryfied_user_id'])){

    $uid = $_SESSION['veryfied_user_id'];
    $idtoken = $_SESSION['idTokenString'];

    $idTokenString = '...';

    try {
        $verifiedIdToken = $auth->verifyIdToken($idTokenString);
    } catch (FailedToVerifyToken $e) {
        echo 'The token is invalid: '.$e->getMessage();
    }

}else{
    $_SESSION['status'] = "Login to access this page";
    header('location: signin.php');
    exit();
}

?>
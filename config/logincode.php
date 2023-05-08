<?php
session_start();
include('dbcon.php');

if(isset($_POST['signin_btn'])){

    $email = $_POST['email'];
    $clearTextPassword = $_POST['password'];

    try {
        $user = $auth->getUserByEmail("$email");

        try{
            $signInResult = $auth->signInWithEmailAndPassword($email, $clearTextPassword);
            $idTokenString = $signInResult->idToken();

            try {
                $verifiedIdToken = $auth->verifyIdToken($idTokenString);
                $uid = $verifiedIdToken->claims()->get('sub');

                $_SESSION['veryfied_user_id'] = $uid;
                $_SESSION['idTokenString'] = $idTokenString;

                $_SESSION['status'] = "Signed Up!";
                header('location: ../pages/dashboard.php');
                exit();
            } catch (FailedToVerifyToken $e) {
                echo 'The token is invalid: '.$e->getMessage();
            }

        } catch (Exception $e){
            $_SESSION['status'] = "Incorrect password!";
            header('location: ../pages/signin.php');
            exit();
        }
        
    } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {    
        $_SESSION['status'] = "Invalid Email!.";
        header('location: ../pages/signin.php');
        exit();
    }

} else {
    $_SESSION['status'] = "Error! Try Again.";
    header('location: ../pages/signin.php');
    exit();
}


?>
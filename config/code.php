<?php
session_start();
include ('dbcon.php');

if(isset($_POST['signup_btn'])){
    $fullname = $_POST['fname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userProperties = [
        'email' => $email,
        'emailVerified' => false,
        'password' => $password,
        'displayName' => $fullname,
    ];
    
    $createdUser = $auth->createUser($userProperties);

    if($createdUser){
        $_SESSION['status'] = "Sign up successfully!";
        header('location: ../pages/signin.php');
        exit();
    } else {
        $_SESSION['status'] = "Sign up is not successfully!";
        header('location: ../pages/signup.php');
        exit();
    }
}

if(isset($_POST['delete_btn'])){
    $del_id = $_POST['delete_btn'];

    // Remove participants node
    $participant_ref = 'participants/'.$del_id;
    $database->getReference($participant_ref)->remove();

    // Remove assessments node
    $assessment_ref = 'assessments/'.$del_id;
    $database->getReference($assessment_ref)->remove();

    // Remove webinar node
    $webinar_ref = 'webinars/'.$del_id;
    $delete_webinar_result = $database->getReference($webinar_ref)->remove();

    if($delete_webinar_result) {
        $_SESSION['status'] = "Webinar Successfully Deleted!";
        header('location: ../pages/webinarlist.php');
    } else {
        $_SESSION['status'] = "Webinar is NOT Deleted!";
        header('location: ../pages/webinarlist.php');
    }
}


if(isset($_POST['save_webinar']))
{
    $webinar_id = $_POST['webinar_id'];
    $webinar_title = $_POST['webinar_title'];
    $webinar_date = $_POST['webinar_date'];
    $webinar_link = $_POST['webinar_link'];
    $registration_link = $_POST['registration_link'];
    $assessment_link = $_POST['assessment_link'];
    $status = $_POST['status'];
    
    $postData = [
        'webinar_title' => $webinar_title,
        'webinar_date' => $webinar_date,
        'webinar_link' => $webinar_link,
        'registration_link' => $registration_link,
        'assessment_link' => $assessment_link,
        'status' => $status
    ];

    $ref_table = "webinars/".$webinar_id;
    $postRef_result = $database->getReference($ref_table)->set($postData);

    if($postRef_result) {
        $_SESSION['status'] = "Webinar Successfully Added!";
        // redirect to registration page with webinar_id parameter
        header('location: ../pages/dashboard.php');
    } else {
        $_SESSION['status'] = "Webinar is NOT Added!";
        header('location: ../pages/dashboard.php');
    }
}


?>
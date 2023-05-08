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
        header('location: ../pages/signup.php');
        exit();
    } else {
        $_SESSION['status'] = "Sign up is not successfully!";
        header('location: ../pages/signup.php');
        exit();
    }
}

if(isset($_POST['delete_btn'])){
    $del_id = $_POST['delete_btn'];

    $ref_table = 'webinars/'.$del_id;
    $deletequery_result = $database->getReference($ref_table)->remove();

    if($deletequery_result) {
        $_SESSION['status'] = "Webinar Successfully Deleted!";
        header('location: ../pages/webinarlist.php');
    } else {
        $_SESSION['status'] = "Webinar is NOT Deleted!";
        header('location: ../pages/webinarlist.php');
    }
}

if(isset($_POST['update_webinar'])){

    $key = $_POST['key'];
    $webinar_title = $_POST['webinar_title'];
    $webinar_date = $_POST['webinar_date'];
    $webinar_link = $_POST['webinar_link'];

    $updateData = [
        'webinar_title' => $webinar_title,
        'webinar_date' => $webinar_date,
        'webinar_link' => $webinar_link,
    ];
    $ref_table = 'webinars/'.$key;
    $updatequery_result = $database->getReference($ref_table)->update($updateData);

    if($updatequery_result) {
        $_SESSION['status'] = "Webinar Successfully Updated!";
        header('location: ../pages/webinarlist.php');
    } else {
        $_SESSION['status'] = "Webinar is NOT updated!";
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
    
    //$webinar_id = $_POST['webinar_id'];
    
    $postData = [
        'webinar_id' => $webinar_id,
        'webinar_title' => $webinar_title,
        'webinar_date' => $webinar_date,
        'webinar_link' => $webinar_link,
        'registration_link' => $registration_link,
        'assessment_link' => $assessment_link
    ];

    $ref_table = "webinars";
    $postRef_result = $database->getReference($ref_table)->push($postData);

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
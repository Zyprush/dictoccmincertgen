<?php
session_start();
include ('dbcon.php');

if(isset($_POST['save_webinar']))
{
    $webinar_title = $_POST['webinar_title'];
    $webinar_date = $_POST['webinar_date'];
    $webinar_link = $_POST['webinar_link'];

    $postData = [
        'webinar_title' => $webinar_title,
        'webinar_date' => $webinar_date,
        'webinar_link' => $webinar_link,
    ];

    $ref_table = "webinars";
    $postRef_result = $database->getReference($ref_table)->push($postData);

    if($postRef_result) {
        $_SESSION['status'] = "Webinar Successfully Added!";
        header('location: dashboard.php');
    } else {
        $_SESSION['status'] = "Webinar is NOT Added!";
        header('location: dashboard.php');
    }
}

?>
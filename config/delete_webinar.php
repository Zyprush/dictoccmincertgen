<?php
session_start();
require_once 'dbconfig.php';

if(isset($_POST['id'])) {
    $webinarID = $_POST['id'];

    // Remove participants data from the database
    $deleteParticipantsQuery = "DELETE FROM participants WHERE webinar_id = '$webinarID'";
    $deleteParticipantsResult = $db->query($deleteParticipantsQuery);

    // Remove assessments data from the database
    $deleteAssessmentsQuery = "DELETE FROM assessments WHERE webinar_id = '$webinarID'";
    $deleteAssessmentsResult = $db->query($deleteAssessmentsQuery);

    // Remove webinar data from the database
    $deleteWebinarQuery = "DELETE FROM webinars WHERE webinar_id = '$webinarID'";
    $deleteWebinarResult = $db->query($deleteWebinarQuery);

    if($deleteWebinarResult) {
        $_SESSION['status'] = 'Webinar deleted successfully';
    } else {
        $_SESSION['status'] = 'Error deleting webinar';
    }
}

header('Location: ../pages/webinarlist.php');
exit;
?>

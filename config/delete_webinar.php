<?php
session_start();
include ('dbcon.php');

if(isset($_POST['id'])) {
    $webinarID = $_POST['id'];

    // Remove participants node
    $participant_ref = 'participants/'.$webinarID;
    $database->getReference($participant_ref)->remove();

    // Remove assessments node
    $assessment_ref = 'assessments/'.$webinarID;
    $database->getReference($assessment_ref)->remove();

    // Remove webinar node
    $webinar_ref = 'webinars/'.$webinarID;
    $delete_webinar_result = $database->getReference($webinar_ref)->remove();

    if($delete_webinar_result) {
        $_SESSION['status'] = 'Webinar deleted successfully';
    } else {
        $_SESSION['status'] = 'Error deleting webinar';
    }
}

header('Location: pages/webinarlist.php');
exit;
?>

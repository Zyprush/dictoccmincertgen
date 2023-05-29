<?php
session_start();
require_once 'dbconfig.php';

if (isset($_POST['id'])) {
    $webinarID = $_POST['id'];

    // Check if 'participants' table exists
    $checkParticipantsTableQuery = "SHOW TABLES LIKE 'participants'";
    $checkParticipantsTableResult = $conn->query($checkParticipantsTableQuery);
    $participantsTableExists = $checkParticipantsTableResult->num_rows > 0;

    // Check if 'assessments' table exists
    $checkAssessmentsTableQuery = "SHOW TABLES LIKE 'assessments'";
    $checkAssessmentsTableResult = $conn->query($checkAssessmentsTableQuery);
    $assessmentsTableExists = $checkAssessmentsTableResult->num_rows > 0;

    if ($participantsTableExists) {
        // Remove participants data from the database
        $deleteParticipantsQuery = "DELETE FROM participants WHERE webinar_id = '$webinarID'";
        $deleteParticipantsResult = $conn->query($deleteParticipantsQuery);
    }

    if ($assessmentsTableExists) {
        // Remove assessments data from the database
        $deleteAssessmentsQuery = "DELETE FROM assessments WHERE webinar_id = '$webinarID'";
        $deleteAssessmentsResult = $conn->query($deleteAssessmentsQuery);
    }

    // Remove webinar data from the database
    $deleteWebinarQuery = "DELETE FROM webinars WHERE webinar_id = '$webinarID'";
    $deleteWebinarResult = $conn->query($deleteWebinarQuery);

    if ($deleteWebinarResult) {
        $_SESSION['status'] = 'Webinar deleted successfully';
    } else {
        $_SESSION['status'] = 'Error deleting webinar: ' . $conn->error;
    }
}

$conn->close();

header('Location: ../pages/webinarlist.php');
exit;
?>

<?php
require_once('dbconfig.php');

$webinar_id = $_GET['id'];
$fetchdataQuery = "SELECT certificate_name, certificate_email FROM assessments WHERE webinar_id = '$webinar_id'";
$result = $conn->query($fetchdataQuery);

$attendees = array();

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $attendee = array(
            'certificate_name' => $row['certificate_name'],
            'certificate_email' => $row['certificate_email']
        );
        array_push($attendees, $attendee);
    }
}

echo json_encode($attendees);
?>

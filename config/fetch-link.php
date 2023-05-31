<?php
include('dbconfig.php');

if (isset($_GET['id'])) {
    $webinarID = $_GET['id'];

    // Prepare the query to fetch links
    $query = "SELECT webinar_link, registration_link, assessment_link FROM webinars WHERE webinar_id = '$webinarID'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Create an array to hold the links
        $links = array(
            'webinar_link' => $row['webinar_link'],
            'registration_link' => $row['registration_link'],
            'assessment_link' => $row['assessment_link']
        );

        // Convert the array to JSON and echo the response
        echo json_encode($links);
    } else {
        echo "No links found";
    }
} else {
    echo "Invalid ID";
}
?>

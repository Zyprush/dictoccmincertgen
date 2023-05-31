<?php
// fetch-webinar-details.php

// Include the necessary files and initialize the database connection
require_once '../config/dbconfig.php';

// Check if the webinar ID is provided
if (isset($_GET['id'])) {
    $webinarID = $_GET['id'];

    // Prepare the query to fetch the webinar details
    $query = "SELECT webinar_title, webinar_date, webinar_link FROM webinars WHERE webinar_id = '$webinarID'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        // Fetch the webinar details as an associative array
        $webinar = $result->fetch_assoc();

        // Return the webinar details as a JSON response
        echo json_encode($webinar);
    } else {
        // Handle the case when no webinar is found
        $response = array('error' => 'No webinar found');
        echo json_encode($response);
    }
} else {
    // Handle the case when no webinar ID is provided
    $response = array('error' => 'Webinar ID is missing');
    echo json_encode($response);
}

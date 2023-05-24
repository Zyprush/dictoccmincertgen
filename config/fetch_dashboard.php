<?php
// Include the database configuration
include('dbconfig.php');

// Create an empty array to store the data
$data = array();

// Perform the MySQL query to fetch the webinars
$query = "SELECT * FROM webinars";
$result = $conn->query($query);

// Check if the query was successful
if ($result) {
    // Loop through the rows of the result set
    while ($row = $result->fetch_assoc()) {
        $webinar_id = $row['webinar_id'];

        // Participant counting
        $participants_count = 0;
        $participants_query = "SELECT COUNT(*) AS count FROM participants WHERE webinar_id = '$webinar_id'";
        $participants_result = $conn->query($participants_query);

        if ($participants_result) {
            $participants_row = $participants_result->fetch_assoc();
            $participants_count = $participants_row['count'];
        }

        // Assessment counting
        $assessments_count = 0;
        $assessments_query = "SELECT COUNT(*) AS count FROM assessments WHERE webinar_id = '$webinar_id'";
        $assessments_result = $conn->query($assessments_query);

        if ($assessments_result) {
            $assessments_row = $assessments_result->fetch_assoc();
            $assessments_count = $assessments_row['count'];
        }

        $data[] = array(
            "webinar_id" => $webinar_id,
            "webinar_title" => $row['webinar_title'],
            "webinar_date" => $row['webinar_date'],
            "participants_count" => $participants_count,
            "assessments_count" => $assessments_count,
            "status" => $row['status']
        );
    }

    // Free the result set
    $result->free();
}

// Close the database connection
$conn->close();

$result = array(
    'data' => $data
);

// Encode the result as JSON and output it
echo json_encode($result);
?>

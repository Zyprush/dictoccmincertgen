<?php
require_once 'dbconfig.php';

// Check if the participants table exists
$participants_table_exists = $conn->query("SHOW TABLES LIKE 'participants'")->num_rows > 0;

// Check if the assessments table exists
$assessments_table_exists = $conn->query("SHOW TABLES LIKE 'assessments'")->num_rows > 0;

// Fetch data from the "webinars" table
$query = "SELECT webinar_id, webinar_title, webinar_date, status FROM webinars";
$result = $conn->query($query);

// Check if there are any records
if ($result->num_rows > 0) {
    // Fetch data and store it in an array
    $webinars = array();
    while ($row = $result->fetch_assoc()) {
        $webinar_id = $row['webinar_id'];

        // Participant counting
        $participants_count = 0;
        if ($participants_table_exists) {
            $participants_query = "SELECT COUNT(*) AS participants_count FROM participants WHERE webinar_id = '$webinar_id'";
            $participants_result = $conn->query($participants_query);

            if ($participants_result && $participants_result->num_rows > 0) {
                $participants_row = $participants_result->fetch_assoc();
                $participants_count = $participants_row['participants_count'];
            }
        }

        // Assessment counting
        $assessments_count = 0;
        if ($assessments_table_exists) {
            $assessments_query = "SELECT COUNT(*) AS assessments_count FROM assessments WHERE webinar_id = '$webinar_id'";
            $assessments_result = $conn->query($assessments_query);

            if ($assessments_result && $assessments_result->num_rows > 0) {
                $assessments_row = $assessments_result->fetch_assoc();
                $assessments_count = $assessments_row['assessments_count'];
            }
        }

        // Add the participants_count and assessments_count to the row
        $row['participants_count'] = $participants_count;
        $row['assessments_count'] = $assessments_count;

        // Add the row to the webinars array
        $webinars[] = $row;
    }
}

// Close the database connection
$conn->close();

// Encode the data in JSON format
$response = array('data' => $webinars);

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>

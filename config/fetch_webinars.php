<?php
require_once 'dbconfig.php';

// Fetch data from the "webinars" table
$query = "SELECT webinar_id, webinar_title, webinar_date, status FROM webinars";
$result = $conn->query($query);

// Check if there are any records
if ($result->num_rows > 0) {
  // Fetch data and store it in an array
  $webinars = array();
  while ($row = $result->fetch_assoc()) {
    // Count the number of assessments for the current webinar_id
    $assessmentCount = 0; // Default value if assessments table or data doesn't exist

    // Check if the assessments table exists
    $tableQuery = "SHOW TABLES LIKE 'assessments'";
    $tableResult = $conn->query($tableQuery);

    if ($tableResult->num_rows > 0) {
      // Assessments table exists, fetch the assessment count
      $assessmentQuery = "SELECT COUNT(*) AS assessment_count FROM assessments WHERE webinar_id = '{$row['webinar_id']}'";
      $assessmentResult = $conn->query($assessmentQuery);

      if ($assessmentResult->num_rows > 0) {
        // Assessments data exists, fetch the assessment count
        $assessmentCount = $assessmentResult->fetch_assoc()['assessment_count'];
      }
    }

    // Add the assessment count to the webinar data
    $row['assessment_count'] = $assessmentCount;
    $webinars[] = $row;
  }
} else {
  $webinars = array();
}

// Encode the data in JSON format
$data = json_encode($webinars);

// Return the JSON response
header('Content-Type: application/json');
echo $data;
?>

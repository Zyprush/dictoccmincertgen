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

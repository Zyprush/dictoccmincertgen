<?php
// Include the db connection file
require_once 'dbconfig.php';

// Fetch data from the assessments table
$query = "SELECT question1, question2, question3 FROM assessments";
$result = mysqli_query($conn, $query);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $average = ($row['question1'] + $row['question2'] + $row['question3']) / 3;
    $data[] = $average;
}

// Calculate the overall average relevance
$overallAverage = array_sum($data) / count($data);

// Prepare the response data
$response = array(
    'averages' => $data,
    'overallAverage' => $overallAverage
);

// Return the response as JSON
echo json_encode($response);

// Close the database connection
mysqli_close($conn);
?>

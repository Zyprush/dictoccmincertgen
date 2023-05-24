<?php

include('dbconfig.php');

$ref_table = 'participants';
$query = "SELECT * FROM $ref_table";
$result = $conn->query($query);

$data = array();

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data[] = array(
      'webinar_id' => $row['webinar_id'],
      'name' => $row['name'],
      'email' => $row['email'],
      'student_id' => $row['student_id'],
      'school' => $row['school'],
      'organization' => $row['organization'],
      'program' => $row['program'],
      'position' => $row['position']
    );
  }
}

echo json_encode(array('data' => $data));

$conn->close();

?>

<?php

include('dbconfig.php');

$ref_table = 'assessments';
$query = "SELECT * FROM $ref_table";
$result = $conn->query($query);

$data = array();

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data[] = array(
      'webinar_id' => $row['webinar_id'],
      'certificate_name' => $row['certificate_name'],
      'certificate_email' => $row['certificate_email']
    );
  }
}

echo json_encode(array('data' => $data));

$conn->close();

?>

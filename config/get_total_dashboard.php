<?php

include('dbconfig.php');

$type = $_GET['type'];

if ($type == 'webinar') {
  $query = "SELECT COUNT(*) AS total_count FROM webinars";
  $result = $conn->query($query);

  if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_count = $row['total_count'];
    echo $total_count;
  } else {
    echo 0;
  }
} else if ($type == 'participant') {
  $query = "SELECT COUNT(*) AS total_count FROM assessments";
  $result = $conn->query($query);

  if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_count = $row['total_count'];
    echo $total_count;
  } else {
    echo 0;
  }
} else if ($type == 'pending') {
  $query = "SELECT COUNT(*) AS pending_count FROM webinars WHERE status = 0";
  $result = $conn->query($query);

  if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $pending_count = $row['pending_count'];
    echo $pending_count;
  } else {
    echo 0;
  }
}

$conn->close();

?>

<?php   
require_once 'dbconfig.php';

session_start();

// Check if the webinars table exists, if not, create it
$checkTableQuery = "SHOW TABLES LIKE 'webinars'";
$result = $conn->query($checkTableQuery);

if ($result->num_rows == 0) {
  // Table does not exist, create it
  $createTableQuery = "CREATE TABLE webinars (
    webinar_id VARCHAR(255) PRIMARY KEY,
    webinar_title VARCHAR(255) NOT NULL,
    webinar_date DATE NOT NULL,
    webinar_link VARCHAR(255) NOT NULL,
    registration_link VARCHAR(255) NOT NULL,
    assessment_link VARCHAR(255) NOT NULL,
    status VARCHAR(255) NOT NULL
  )";
  
  $createTableResult = $conn->query($createTableQuery);

  if ($createTableResult) {
    // Table created successfully
    echo "Webinars table created successfully!";
  } else {
    // Failed to create table
    echo "Error creating webinars table: " . $conn->error;
  }
}

if (isset($_POST['save_webinar'])) {
  $webinar_id = $_POST['webinar_id'];
  $webinar_title = $_POST['webinar_title'];
  $webinar_date = $_POST['webinar_date'];
  $webinar_link = $_POST['webinar_link'];
  $registration_link = $_POST['registration_link'];
  $assessment_link = $_POST['assessment_link'];
  $status = $_POST['status'];

  $insertQuery = "INSERT INTO webinars (webinar_id, webinar_title, webinar_date, webinar_link, registration_link, assessment_link, status)
                  VALUES ('$webinar_id', '$webinar_title', '$webinar_date', '$webinar_link', '$registration_link', '$assessment_link', '$status')";

  $result = $conn->query($insertQuery);

  if ($result) {
    // Webinar successfully added
    $_SESSION['status'] = "Webinar Successfully Added!";
    header('Location: ../pages/webinarlist.php');
    exit();
  } else {
    // Failed to add webinar
    $_SESSION['status'] = "Webinar is NOT Added!";
    header('Location: ../pages/dashboard.php');
    exit();
  }
}
?>

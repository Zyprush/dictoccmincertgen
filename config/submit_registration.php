<?php
session_start();
include('dbconfig.php');

if (isset($_POST['register_btn'])) {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $studentId = $_POST['student_id'];
    $school = $_POST['school'];
    $organization = $_POST['organization'];
    $program = $_POST['program'];
    $position = $_POST['position'];
    $webinarId = $_POST['webinar_id'];

    // Create "participants" table if it doesn't exist
    $createTableQuery = "CREATE TABLE IF NOT EXISTS participants (
        id INT AUTO_INCREMENT PRIMARY KEY,
        webinar_id VARCHAR(255),
        name VARCHAR(255),
        email VARCHAR(255),
        student_id VARCHAR(255),
        school VARCHAR(255),
        organization VARCHAR(255),
        program VARCHAR(255),
        position VARCHAR(255)
    )";
    $conn->query($createTableQuery);

    // Insert the registration data into the "participants" table
    $insertQuery = "INSERT INTO participants (webinar_id, name, email, student_id, school, organization, program, position)
                    VALUES ('$webinarId', '$name', '$email', '$studentId', '$school', '$organization', '$program', '$position')";
    $conn->query($insertQuery);

    // Redirect to registration success page
    header('Location: ../pages/registration_success.php');
    exit();
}
?>

<?php
session_start();
include ('dbcon.php');

if(isset($_POST['register_btn'])){

    // Define Firebase database references
    $participantsRef = $database->getReference('participants');
        
    // Retrieve webinar_id from query string
    $webinarId = $_POST['webinar_id'];

    // Create a new database reference for the specific webinar node
    $webinarRef = $participantsRef->getChild($webinarId);

    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $studentId = $_POST['student_id'];
    $school = $_POST['school'];
    $organization = $_POST['organization'];
    $program = $_POST['program'];
    $position = $_POST['position'];

    // Generate unique identifier for new registration data
    $registrationId = uniqid();

    // Create a new database reference for the registration data under the webinar node
    $registrationRef = $webinarRef->getChild($registrationId);

    // Set the value of the new database reference to the registration data
    $registrationRef->set([
        'name' => $name,
        'email' => $email,
        'student_id' => $studentId,
        'school' => $school,
        'organization' => $organization,
        'program' => $program,
        'position' => $position
    ]);
    
    // Redirect to registration success page
    header('Location: ../pages/registration_success.php');
    exit();
}
?>

<?php
session_start();
include ('dbcon.php');

if(isset($_POST['assessment_btn'])){

    // Define Firebase database references
    $assessmentsRef = $database->getReference('assessments');
        
    // Retrieve webinar_id from query string
    $webinarId = $_POST['webinar_id'];

    // Create a new database reference for the specific webinar node
    $webinarRef = $assessmentsRef->getChild($webinarId);

    // Get form data
    $email = $_POST['email'];
    $agreement = $_POST['agreement'];
    $l_name = $_POST['l_name'];
    $f_name = $_POST['f_name'];
    $m_name = $_POST['m_name'];
    $e_name = $_POST['e_name'];

    $province = $_POST['province'];
    $region = $_POST['region'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $citizenship = $_POST['citizenship'];
    $certificate_name = $_POST['certificate_name'];
    $certificate_email = $_POST['certificate_email'];


    // Generate unique identifier for new assessment data
    $assessmentId = uniqid();

    // Create a new database reference for the registration data under the webinar node
    $assessmentsRef = $webinarRef->getChild($assessmentId);

    // Set the value of the new database reference to the registration data
    $assessmentsRef->set([
        
        'email' => $email,
        'agreement' => $agreement,
        'l_name' => $l_name,
        'f_name' => $f_name,
        'm_name' => $m_name,
        'e_name' => $e_name,

        'province' => $province,
        'region' => $region,
        'age' => $age,
        'gender' => $gender,
        'citizenship' => $citizenship,
        'certificate_name' => $certificate_name,
        'certificate_email' => $certificate_email,
        
    ]);
    
    // Redirect to registration success page
    header('Location: ../pages/assessment_success.php');
    exit();
}
?>

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

    //RELEVANCE OF THE TRAINING
    $question1 = $_POST['question1'];
    $question2 = $_POST['question2'];
    $question3 = $_POST['question3'];

    //INFORMATION / SKILLS ACQUIRED
    $question4 = $_POST['question4'];
    $question5 = $_POST['question5'];
    $question6 = $_POST['question6'];
    $question7 = $_POST['question7'];

    //INSTRUCTIONAL DESIGN
    $question8 = $_POST['question8'];
    $question9 = $_POST['question9'];
    $question10 = $_POST['question10'];
    $question11 = $_POST['question11'];
    $question12 = $_POST['question12'];
    $question13 = $_POST['question13'];

    //CLASS INTERACTION
    $question14 = $_POST['question14'];
    $question15 = $_POST['question15'];
    $question16 = $_POST['question16'];

    //SENSITIVITY AND ASSISTANCE PROVIDED BY THE TRAINING STAFF
    $question17 = $_POST['question17'];

    //IN GENERAL, HOW WOULD YOU RATE THIS COURSE / TRAINING / SEMINAR
    $question18 = $_POST['question18'];

    //What did you find most useful his course / training / seminar
    $most_useful = $_POST['most_useful'];

    //What did you find least useful in this course / training / seminar
    $least_useful = $_POST['least_useful'];
    
    //On which topics, if any, would you rather have spent more time
    $spent_more = $_POST['spent_more'];

    //On which topics, if any, would you rather have spent less time
    $spent_less = $_POST['spent_less'];

    //What advice can you give to improve the future conduct of this course / training / seminar
    $improve_conduct = $_POST['improve_conduct'];

    //Could you recommend this course / training / seminar to your colleagues
    $recommend = $_POST['recommend'];

    //Please list three (3) things that you intend to do as a result of your participation in this course / training / seminar
    $result_participation = $_POST['result_participation'];

    //Comments and / or Suggestions
    $comments = $_POST['comments'];

    //MASTERY OF THE SUBJECT MATTER
    $question19 = $_POST['question19'];
    $question20 = $_POST['question20'];
    $question21 = $_POST['question21'];
    $question22 = $_POST['question22'];

    //INSTRUCTIONAL METHODOLOGY
    $question23 = $_POST['question23'];
    $question24 = $_POST['question24'];
    $question25 = $_POST['question25'];
    $question26 = $_POST['question26'];
    $question27 = $_POST['question27'];

    //COMMUNICATIONS SKILLS
    $question28 = $_POST['question28'];
    $question29 = $_POST['question29'];

    //CLASS / CLASSROOM MANAGEMENT
    $question30 = $_POST['question30'];
    $question31 = $_POST['question31'];
    $question32 = $_POST['question32'];
    $question33 = $_POST['question33'];

    //PERSONAL QUALITIES
    $question34 = $_POST['question34'];
    $question35 = $_POST['question35'];
    $question36 = $_POST['question36'];
    $question37 = $_POST['question37'];

    //OTHER COMMENTS
    $other_comment = $_POST['other_comment'];



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
        'question1' => $question1,
        'question2' => $question2,
        'question3' => $question3,
        'question4' => $question4,
        'question5' => $question5,
        'question6' => $question6,
        'question7' => $question7,
        'question8' => $question8,
        'question9' => $question9,
        'question10' => $question10,
        'question11' => $question11,
        'question12' => $question12,
        'question13' => $question13,
        'question14' => $question14,
        'question15' => $question15,
        'question16' => $question16,
        'question17' => $question17,
        'question18' => $question18,
        'most_useful' => $most_useful,
        'least_useful' => $least_useful,
        'spent_more' => $spent_more,
        'spent_less' => $spent_less,
        'improve_conduct' => $improve_conduct,
        'recommend' => $recommend,
        'result_participation' => $result_participation,
        'comments' => $comments,
        'question19' => $question19,
        'question20' => $question20,
        'question20_1' => $question20_1,
        'question21' => $question21,
        'question22' => $question22,
        'question23' => $question23,
        'question24' => $question24,
        'question25' => $question25,
        'question26' => $question26,
        'question27' => $question27,
        'question28' => $question28,
        'question29' => $question29,
        'question26_1' => $question26_1,
        'question27_1' => $question27_1,
        'question28_1' => $question28_1,
        'question29_1' => $question29_1,
        'question30' => $question30,
        'question31' => $question31,
        'question32' => $question32,
        'question33' => $question33,
        'question34' => $question34,
        'question35' => $question35,
        'question36' => $question36,
        'question37' => $question37,
        'other_comment' => $other_comment,
        

    ]);
    
    // Redirect to registration success page
    header('Location: ../pages/assessment_success.php');
    exit();
}
?>

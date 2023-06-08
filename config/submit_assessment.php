<?php
session_start();
require_once('dbconfig.php');

// Check if "assessments" table exists, and create it if necessary
$tableExists = $conn->query("SHOW TABLES LIKE 'assessments'");
if ($tableExists->num_rows == 0) {
    $createTableQuery = "CREATE TABLE assessments (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        webinar_id VARCHAR(255),
        email VARCHAR(255),
        agreement VARCHAR(255),
        l_name VARCHAR(255),
        f_name VARCHAR(255),
        m_name VARCHAR(255),
        e_name VARCHAR(255),
        province VARCHAR(255),
        region VARCHAR(255),
        age VARCHAR(255),
        gender VARCHAR(255),
        citizenship VARCHAR(255),
        certificate_name VARCHAR(255),
        certificate_email VARCHAR(255),
        question1 VARCHAR(255),
        question2 VARCHAR(255),
        question3 VARCHAR(255),
        question4 VARCHAR(255),
        question5 VARCHAR(255),
        question6 VARCHAR(255),
        question7 VARCHAR(255),
        question8 VARCHAR(255),
        question9 VARCHAR(255),
        question10 VARCHAR(255),
        question11 VARCHAR(255),
        question12 VARCHAR(255),
        question13 VARCHAR(255),
        question14 VARCHAR(255),
        question15 VARCHAR(255),
        question16 VARCHAR(255),
        question17 VARCHAR(255),
        question18 VARCHAR(255),
        most_useful VARCHAR(255),
        least_useful VARCHAR(255),
        spent_more VARCHAR(255),
        spent_less VARCHAR(255),
        improve_conduct VARCHAR(255),
        recommend VARCHAR(255),
        result_participation VARCHAR(255),
        comments VARCHAR(255),
        question19 VARCHAR(255),
        question20 VARCHAR(255),
        question21 VARCHAR(255),
        question22 VARCHAR(255),
        question23 VARCHAR(255),
        question24 VARCHAR(255),
        question25 VARCHAR(255),
        question26 VARCHAR(255),
        question27 VARCHAR(255),
        question28 VARCHAR(255),
        question29 VARCHAR(255),
        question30 VARCHAR(255),
        question31 VARCHAR(255),
        question32 VARCHAR(255),
        question33 VARCHAR(255),
        question34 VARCHAR(255),
        question35 VARCHAR(255),
        question36 VARCHAR(255),
        question37 VARCHAR(255),
        other_comment VARCHAR(255)
    )";
    $conn->query($createTableQuery);
}

if(isset($_POST['assessment_btn'])){
        
    // Retrieve webinar_id from query string
    $webinarId = $_POST['webinar_id'];

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

    // Prepare the insert statement
    $query = "INSERT INTO assessments (
        webinar_id, 
        email, agreement, 
        l_name, 
        f_name, 
        m_name, 
        e_name, 
        province, 
        region, 
        age, 
        gender, 
        citizenship, 
        certificate_name, 
        certificate_email, 
        question1, 
        question2, 
        question3, 
        question4,
        question5,
        question6,
        question7,
        question8,
        question9,
        question10,
        question11,
        question12,
        question13,
        question14,
        question15,
        question16,
        question17,
        question18,
        question19,
        question20,
        question21,
        question22,
        question23,
        question24,
        question25,
        question26,
        question27,
        question28,
        question29,
        question30,
        question31,
        question32,
        question33,
        question34,
        question35,
        question36,
        question37,
        most_useful,
        least_useful,
        spent_more,
        spent_less,
        improve_conduct,
        recommend,
        result_participation,
        other_comment,
        comments
        ) 
              VALUES ('$webinarId', 
              '$email', 
              '$agreement', 
              '$l_name', 
              '$f_name', 
              '$m_name', 
              '$e_name', 
              '$province', 
              '$region', 
              '$age', 
              '$gender', 
              '$citizenship', 
              '$certificate_name', 
              '$certificate_email', 
              '$question1', 
              '$question2', 
              '$question3',
              '$question4',
              '$question5',
              '$question6',
              '$question7',
              '$question8',
              '$question9',
              '$question10',
              '$question11',
              '$question12',
              '$question13',
              '$question14',
              '$question15',
              '$question16',
              '$question17',
              '$question18',
              '$question19',
              '$question20',
              '$question21',
              '$question22',
              '$question23',
              '$question24',
              '$question25',
              '$question26',
              '$question27',
              '$question28',
              '$question29',
              '$question30',
              '$question31',
              '$question32',
              '$question33',
              '$question34',
              '$question35',
              '$question36',
              '$question37',
              '$most_useful',
              '$least_useful',
              '$spent_more',
              '$spent_less',
              '$improve_conduct',
              '$recommend',
              '$result_participation',
              '$comments',
              '$other_comment')";

    if ($conn->query($query) === TRUE) {
        // Redirect to success page
        header('Location: ../pages/assessment_success.php');
        exit();
    } else {
        // Handle insert error
        echo "Error: " . $query . "<br>" . $db->error;
    }
}
?>

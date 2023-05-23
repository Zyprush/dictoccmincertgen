<?php
include('dbcon.php');


$webinar_id = $_GET['id'];
$ref_table_assessments = 'assessments/' . $webinar_id;
$fetchdata = $database->getReference($ref_table_assessments)->getValue();

$relevance_scores = array(); // Array to store scores for "Relevance of training" category
$information_scores = array(); // Array to store scores for "Information" category
$instructional_design_scores = array(); // Array to store scores for "Instructional Design" category
$class_interaction_scores = array(); // Array to store scores for "Class Interaction" category
$sensitivity_assistance_scores = array(); // Array to store scores for "Sensitivity and Assistance Provided by the Training Staff" category
$general_rating_scores = array(); // Array to store scores for "General, How Would You Rate This Course / Training / Seminar" category

$trainer_mastery_scores = array(); // Array to store scores for "Mastery of the Subject Matter" category
$trainer_instructional_methodology_scores = array(); // Array to store scores for "Instructional Methodology" category
$trainer_communication_skills_scores = array(); // Array to store scores for "Communication Skills" category
$trainer_classroom_management_scores = array(); // Array to store scores for "Class/Classroom Management" category
$trainer_personal_qualities_scores = array(); // Array to store scores for "Personal Qualities" category

if (empty($fetchdata)) {
    echo "NO DATA BEING FETCH";
} else {
    foreach ($fetchdata as $folder) {
        // Check if the folder has the relevant fields
        if (isset($folder['question1'], $folder['question2'], $folder['question3'])) {
            $relevance_scores[] = ($folder['question1'] + $folder['question2'] + $folder['question3']) / 3;
        }

        if (isset($folder['question4'], $folder['question5'], $folder['question6'], $folder['question7'])) {
            $information_scores[] = ($folder['question4'] + $folder['question5'] + $folder['question6'] + $folder['question7']) / 4;
        }
        
        if (isset($folder['question8'], $folder['question9'], $folder['question10'], $folder['question11'], $folder['question12'], $folder['question13'])) {
            $instructional_design_scores[] = ($folder['question8'] + $folder['question9'] + $folder['question10'] + $folder['question11'] + $folder['question12'] + $folder['question13']) / 6;
        }
        
        if (isset($folder['question14'], $folder['question15'], $folder['question16'])) {
            $class_interaction_scores[] = ($folder['question14'] + $folder['question15'] + $folder['question16']) / 3;
        }
        
        if (isset($folder['question17'])) {
            $sensitivity_assistance_scores[] = $folder['question17'];
        }
        
        if (isset($folder['question18'])) {
            $general_rating_scores[] = $folder['question18'];
        }

        if (isset($folder['question19'], $folder['question20'], $folder['question21'], $folder['question22'])) {
            $trainer_mastery_scores[] = ($folder['question19'] + $folder['question20'] + $folder['question21'] + $folder['question22']) / 4;
        }

        if (isset($folder['question23'], $folder['question24'], $folder['question25'], $folder['question26'], $folder['question27'])) {
            $trainer_instructional_methodology_scores[] = ($folder['question23'] + $folder['question24'] + $folder['question25'] + $folder['question26'] + $folder['question27']) / 5;
        }
    
        if (isset($folder['question28'], $folder['question29'])) {
            $trainer_communication_skills_scores[] = ($folder['question28'] + $folder['question29']) / 2;
        }
    
        if (isset($folder['question30'], $folder['question31'], $folder['question32'], $folder['question33'])) {
            $trainer_classroom_management_scores[] = ($folder['question30'] + $folder['question31'] + $folder['question32'] + $folder['question33']) / 4;
        }
    
        if (isset($folder['question34'], $folder['question35'], $folder['question36'], $folder['question37'])) {
            $trainer_personal_qualities_scores[] = ($folder['question34'] + $folder['question35'] + $folder['question36'] + $folder['question37']) / 4;
        }
    }

    // Function to get the label for the rating score
    function getRatingLabel($score) {
        switch ($score) {
            case 5:
                return 'Excellent';
            case 4:
                return 'Very Satisfactory';
            case 3:
                return 'Satisfactory';
            case 2:
                return 'Fair';
            case 1:
                return 'Poor';
            default:
                return '';
        }
    }

    // Function to get the color class based on the rating score
    function getRatingColorClass($score) {
        switch ($score) {
            case 5:
                return 'green';
            case 4:
                return 'yellowgreen';
            case 3:
                return 'yellow';
            case 2:
                return 'orange';
            case 1:
                return 'red';
            default:
                return '';
        }
    }

    // Calculate the general average for "Relevance of training" category
    $relevance_average = count($relevance_scores) > 0 ? array_sum($relevance_scores) / count($relevance_scores) : 0;
    $relevance_label = getRatingLabel($relevance_average);
    $relevance_color_class = getRatingColorClass($relevance_average);

    // Calculate the general average for "Information" category
    $information_average = count($information_scores) > 0 ? array_sum($information_scores) / count($information_scores) : 0;
    $information_label = getRatingLabel($information_average);
    $information_color_class = getRatingColorClass($information_average);

    // Calculate the general average for "Instructional Design" category
    $instructional_design_average = count($instructional_design_scores) > 0 ? array_sum($instructional_design_scores) / count($instructional_design_scores) : 0;
    $instructional_design_label = getRatingLabel($instructional_design_average);
    $instructional_design_color_class = getRatingColorClass($instructional_design_average);

    // Calculate the general average for "Class Interaction" category
    $class_interaction_average = count($class_interaction_scores) > 0 ? array_sum($class_interaction_scores) / count($class_interaction_scores) : 0;
    $class_interaction_label = getRatingLabel($class_interaction_average);
    $class_interaction_color_class = getRatingColorClass($class_interaction_average);

    // Calculate the general average for "Sensitivity and Assistance Provided by the Training Staff" category
    $sensitivity_assistance_average = count($sensitivity_assistance_scores) > 0 ? array_sum($sensitivity_assistance_scores) / count($sensitivity_assistance_scores) : 0;
    $sensitivity_assistance_label = getRatingLabel($sensitivity_assistance_average);
    $sensitivity_assistance_color_class = getRatingColorClass($sensitivity_assistance_average);

    // Calculate the general average for "General, How Would You Rate This Course / Training / Seminar" category
    $general_rating_average = count($general_rating_scores) > 0 ? array_sum($general_rating_scores) / count($general_rating_scores) : 0;
    $general_rating_label = getRatingLabel($general_rating_average);
    $general_rating_color_class = getRatingColorClass($general_rating_average);



    // Calculate the general average for "Mastery of the Subject Matter" category
    $trainer_mastery_average = count($trainer_mastery_scores) > 0 ? array_sum($trainer_mastery_scores) / count($trainer_mastery_scores) : 0;
    $trainer_mastery_label = getRatingLabel($trainer_mastery_average);
    $trainer_mastery_color_class = getRatingColorClass($trainer_mastery_average);

    // Calculate the general average for "Instructional Methodology" category
    $trainer_instructional_methodology_average = count($trainer_instructional_methodology_scores) > 0 ? array_sum($trainer_instructional_methodology_scores) / count($trainer_instructional_methodology_scores) : 0;
    $trainer_instructional_methodology_label = getRatingLabel($trainer_instructional_methodology_average);
    $trainer_instructional_methodology_color_class = getRatingColorClass($trainer_instructional_methodology_average);

    // Calculate the general average for "Communication Skills" category
    $trainer_communication_skills_average = count($trainer_communication_skills_scores) > 0 ? array_sum($trainer_communication_skills_scores) / count($trainer_communication_skills_scores) : 0;
    $trainer_communication_skills_label = getRatingLabel($trainer_communication_skills_average);
    $trainer_communication_skills_color_class = getRatingColorClass($trainer_communication_skills_average);

    // Calculate the general average for "Class/Classroom Management" category
    $trainer_classroom_management_average = count($trainer_classroom_management_scores) > 0 ? array_sum($trainer_classroom_management_scores) / count($trainer_classroom_management_scores) : 0;
    $trainer_classroom_management_label = getRatingLabel($trainer_classroom_management_average);
    $trainer_classroom_management_color_class = getRatingColorClass($trainer_classroom_management_average);

    // Calculate the general average for "Personal Qualities" category
    $trainer_personal_qualities_average = count($trainer_personal_qualities_scores) > 0 ? array_sum($trainer_personal_qualities_scores) / count($trainer_personal_qualities_scores) : 0;
    $trainer_personal_qualities_label = getRatingLabel($trainer_personal_qualities_average);
    $trainer_personal_qualities_color_class = getRatingColorClass($trainer_personal_qualities_average);
}
?>
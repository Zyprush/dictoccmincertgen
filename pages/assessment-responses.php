<?php
require_once '../config/dbconfig.php';

$webinar_id = $_GET['id'];
$query = "SELECT * FROM assessments WHERE webinar_id = '$webinar_id'";
$result = mysqli_query($conn, $query);

$assessment_data = array(); // Array to store assessment data for each response

if (mysqli_num_rows($result) === 0) {
    echo "No assessments found.";
} else {
    while ($folder = mysqli_fetch_assoc($result)) {
        $assessment = array();

        // Check if the folder has the relevant fields
        if (isset($folder['question1'], $folder['question2'], $folder['question3'])) {
            $assessment['relevance'][] = ($folder['question1'] + $folder['question2'] + $folder['question3']) / 3;
        }

        if (isset($folder['question4'], $folder['question5'], $folder['question6'], $folder['question7'])) {
            $assessment['information'][] = ($folder['question4'] + $folder['question5'] + $folder['question6'] + $folder['question7']) / 4;
        }
        if (isset($folder['question8'], $folder['question9'], $folder['question10'], $folder['question11'], $folder['question12'], $folder['question13'])) {
            $assessment['instructional_design'] = ($folder['question8'] + $folder['question9'] + $folder['question10'] + $folder['question11'] + $folder['question12'] + $folder['question13']) / 6;
        }
        
        if (isset($folder['question14'], $folder['question15'], $folder['question16'])) {
            $assessment['class_interaction'] = ($folder['question14'] + $folder['question15'] + $folder['question16']) / 3;
        }
        
        if (isset($folder['question17'])) {
            $assessment['sensitivity_assistance'] = $folder['question17'];
        }
        
        if (isset($folder['question18'])) {
            $assessment['general_rating'] = $folder['question18'];
        }

        if (isset($folder['question19'], $folder['question20'], $folder['question21'], $folder['question22'])) {
            $assessment['trainer_mastery'] = ($folder['question19'] + $folder['question20'] + $folder['question21'] + $folder['question22']) / 4;
        }

        if (isset($folder['question23'], $folder['question24'], $folder['question25'], $folder['question26'], $folder['question27'])) {
            $assessment['trainer_instructional_methodology'] = ($folder['question23'] + $folder['question24'] + $folder['question25'] + $folder['question26'] + $folder['question27']) / 5;
        }
    
        if (isset($folder['question28'], $folder['question29'])) {
            $assessment['trainer_communication_skills'] = ($folder['question28'] + $folder['question29']) / 2;
        }
    
        if (isset($folder['question30'], $folder['question31'], $folder['question32'], $folder['question33'])) {
            $assessment['trainer_classroom_management'] = ($folder['question30'] + $folder['question31'] + $folder['question32'] + $folder['question33']) / 4;
        }
        

        $assessment_data[] = $assessment;
    }

    // Calculate average scores for each category
    foreach ($assessment_data as $assessment) {
        foreach ($assessment as $category => $scores) {
            if (!isset($category_averages[$category])) {
                $category_averages[$category] = array();
            }

            if (is_array($scores)) {
                $category_averages[$category] = array_merge($category_averages[$category], $scores);
            } else {
                $category_averages[$category][] = $scores;
            }
        }
    }

    // Calculate average score for each category
    foreach ($category_averages as $category => $scores) {
        $category_averages[$category] = array_sum($scores) / count($scores);
    }

    // Retrieve webinar details
    $webinar_query = "SELECT * FROM webinars WHERE webinar_id = '$webinar_id'";
    $webinar_result = mysqli_query($conn, $webinar_query);

    if (mysqli_num_rows($webinar_result) > 0) {
        $webinar = mysqli_fetch_assoc($webinar_result);
        $webinar_name = $webinar['webinar_title'];
        $webinar_date = $webinar['webinar_date'];
    } else {
        $webinar_name = "Webinar not found";
        $webinar_date = "";
    }

    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Webinar Assessment Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Webinar Assessment Report</h1>
    <h2><?php echo $webinar_name; ?></h2>
    <h3>Date: <?php echo $webinar_date; ?></h3>

    <?php if (isset($category_averages)): ?>
        <?php foreach ($category_averages as $category => $average): ?>
            <h4><?php echo ucfirst(str_replace('_', ' ', $category)); ?></h4>
            <canvas id="<?php echo $category; ?>Chart"></canvas>
            <script>
                var <?php echo $category; ?>Data = <?php echo json_encode([$category => $average]); ?>;
                var <?php echo $category; ?>Labels = Object.keys(<?php echo $category; ?>Data);
                var <?php echo $category; ?>Scores = Object.values(<?php echo $category; ?>Data);

                var <?php echo $category; ?>Chart = new Chart(document.getElementById('<?php echo $category; ?>Chart'), {
                    type: 'pie',
                    data: {
                        labels: <?php echo $category; ?>Labels,
                        datasets: [{
                            data: <?php echo $category; ?>Scores,
                            backgroundColor: chartColors
                        }]
                    }
                });
            </script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>

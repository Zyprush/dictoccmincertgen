<?php
include("../includes/header.php");
include('../config/dbconfig.php');
include('../config/comments_function.php');

$webinar_id = $_GET['id'];

if (isset($_GET['id'])) {
    $webinar_id = $_GET['id'];

    // Fetch data from the assessments table for the specified webinar_id
    $query = "SELECT * FROM assessments WHERE webinar_id = '$webinar_id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        // Handle the case when the query fails
        $response = array(
            'error' => 'Failed to fetch assessment data'
        );
        echo json_encode($response);
        exit; // Stop the script execution
    }

    // Initialize arrays to store individual averages for the first container
    $relevance_averages = array();
    $information_skills_averages = array();
    $instructional_design_averages = array();
    $class_interaction_averages = array();
    $sensitivity_assistance_averages = array();
    $general_rating_averages = array();

    // Initialize arrays to store individual averages for the second container
    $mastery_averages = array();
    $methodology_averages = array();
    $communication_averages = array();
    $management_averages = array();
    $qualities_averages = array();

    // Fetch all the assessment data and calculate averages for each individual for the first container
    while ($assessment = mysqli_fetch_assoc($result)) {
        $relevance_average = ($assessment['question1'] + $assessment['question2'] + $assessment['question3']) / 3;
        $relevance_averages[] = $relevance_average;

        $information_skills_average = ($assessment['question4'] + $assessment['question5'] + $assessment['question6'] + $assessment['question7']) / 4;
        $information_skills_averages[] = $information_skills_average;

        $instructional_design_average = ($assessment['question8'] + $assessment['question9'] + $assessment['question10'] + $assessment['question11'] + $assessment['question12'] + $assessment['question13']) / 6;
        $instructional_design_averages[] = $instructional_design_average;

        $class_interaction_average = ($assessment['question14'] + $assessment['question15'] + $assessment['question16']) / 3;
        $class_interaction_averages[] = $class_interaction_average;

        $sensitivity_assistance_average = $assessment['question17'];
        $sensitivity_assistance_averages[] = $sensitivity_assistance_average;

        $general_rating_average = $assessment['question18'];
        $general_rating_averages[] = $general_rating_average;
    }

    // Fetch all the assessment data and calculate averages for each individual for the second container
    mysqli_data_seek($result, 0); // Reset the result pointer to the beginning

    while ($assessment = mysqli_fetch_assoc($result)) {
        $mastery_average = ($assessment['question19'] + $assessment['question20'] + $assessment['question21'] + $assessment['question22']) / 4;
        $mastery_averages[] = $mastery_average;

        $methodology_average = ($assessment['question23'] + $assessment['question24'] + $assessment['question25'] + $assessment['question26'] + $assessment['question27']) / 5;
        $methodology_averages[] = $methodology_average;

        $communication_average = ($assessment['question28'] + $assessment['question29']) / 2;
        $communication_averages[] = $communication_average;

        $management_average = ($assessment['question30'] + $assessment['question31'] + $assessment['question32'] + $assessment['question33']) / 4;
        $management_averages[] = $management_average;

        $qualities_average = ($assessment['question34'] + $assessment['question35'] + $assessment['question36'] + $assessment['question37']) / 4;
        $qualities_averages[] = $qualities_average;
    }
}
?>


<div class="container">
    <div class="card">
        <div class="card-header">
            <h5>Course Evaluation
                <a class="btn btn-primary btn-sm float-right mr-2" href="cvs-files.php?id=<?= $webinar_id ?>">
                    <i class="bi bi-box-arrow-down"></i>
                </a>
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-title">I. Relevance of the Training</h6>
                            <?php
                            $relevance_counts = array_count_values($relevance_averages);
                            krsort($relevance_counts);
                            ?>
                            <?php for ($i = 5; $i >= 1; $i--) : ?>
                                <?php
                                $count = isset($relevance_counts[$i]) ? $relevance_counts[$i] : 0;
                                $percentage = round(($count / count($relevance_averages)) * 100);
                                ?>

                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $percentage; ?>%;" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                                <p class="card-text">
                                    <?php echo $i; ?> - <?php echo $percentage; ?>%
                                </p>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-title">II. Information / Skills Acquired</h6>
                            <?php
                            $information_skills_counts = array_count_values($information_skills_averages);
                            krsort($information_skills_counts);
                            ?>
                            <?php for ($i = 5; $i >= 1; $i--) : ?>
                                <p class="card-text">
                                    <?php
                                    $count = isset($information_skills_counts[$i]) ? $information_skills_counts[$i] : 0;
                                    $percentage = round(($count / count($information_skills_averages)) * 100);
                                    ?>

                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $percentage; ?>%;" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                
                                    <?php echo $i; ?> - <?php echo $percentage; ?>%
                                </p>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-title">III. Instructional Design</h6>
                            <?php
                            $instructional_design_counts = array_count_values($instructional_design_averages);
                            krsort($instructional_design_counts);
                            ?>
                            <?php for ($i = 5; $i >= 1; $i--) : ?>
                                <p class="card-text">
                                    <?php
                                    $count = isset($instructional_design_counts[$i]) ? $instructional_design_counts[$i] : 0;
                                    $percentage = round(($count / count($instructional_design_averages)) * 100);
                                    ?>

                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $percentage; ?>%;" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                    <?php echo $i; ?> - <?php echo $percentage; ?>%
                                </p>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-title">IV. Class Interaction</h6>
                            <?php
                            $class_interaction_counts = array_count_values($class_interaction_averages);
                            krsort($class_interaction_counts);
                            ?>
                            <?php for ($i = 5; $i >= 1; $i--) : ?>
                                <p class="card-text">
                                    <?php
                                    $count = isset($class_interaction_counts[$i]) ? $class_interaction_counts[$i] : 0;
                                    $percentage = round(($count / count($class_interaction_averages)) * 100);
                                    ?>

                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $percentage; ?>%;" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                    <?php echo $i; ?> - <?php echo $percentage; ?>%
                                </p>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-title">V. Sensitivity and Assistance Provided by the Training Staff</h6>
                            <?php
                            $sensitivity_assistance_counts = array_count_values($sensitivity_assistance_averages);
                            krsort($sensitivity_assistance_counts);
                            ?>
                            <?php for ($i = 5; $i >= 1; $i--) : ?>
                                <p class="card-text">
                                    <?php
                                    $count = isset($sensitivity_assistance_counts[$i]) ? $sensitivity_assistance_counts[$i] : 0;
                                    $percentage = round(($count / count($sensitivity_assistance_averages)) * 100);
                                    ?>

                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $percentage; ?>%;" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                    <?php echo $i; ?> - <?php echo $percentage; ?>%
                                </p>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-title">VI. General Rating</h6>
                            <?php
                            $general_rating_counts = array_count_values($general_rating_averages);
                            krsort($general_rating_counts);
                            ?>
                            <?php for ($i = 5; $i >= 1; $i--) : ?>
                                <p class="card-text">
                                    <?php
                                    $count = isset($general_rating_counts[$i]) ? $general_rating_counts[$i] : 0;
                                    $percentage = round(($count / count($general_rating_averages)) * 100);
                                    ?>

                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $percentage; ?>%;" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                    <?php echo $i; ?> - <?php echo $percentage; ?>%
                                </p>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h5>Training Evaluation
                <a class="btn btn-primary btn-sm float-right mr-2" href="cvs-files.php?id=<?= $webinar_id ?>">
                    <i class="bi bi-box-arrow-down"></i>
                </a>
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-title">I. Mastery of the Subject Matter</h6>
                            <?php
                            $mastery_counts = array_count_values($mastery_averages);
                            krsort($mastery_counts);
                            ?>
                            <?php for ($i = 5; $i >= 1; $i--) : ?>
                                <p class="card-text">
                                    <?php
                                    $count = isset($mastery_counts[$i]) ? $mastery_counts[$i] : 0;
                                    $percentage = round(($count / count($mastery_averages)) * 100);
                                    ?>

                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $percentage; ?>%;" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                    <?php echo $i; ?> - <?php echo $percentage; ?>%
                                </p>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-title">II. Instructional Methodology</h6>
                            <?php
                            $methodology_counts = array_count_values($methodology_averages);
                            krsort($methodology_counts);
                            ?>
                            <?php for ($i = 5; $i >= 1; $i--) : ?>
                                <p class="card-text">
                                    <?php
                                    $count = isset($methodology_counts[$i]) ? $methodology_counts[$i] : 0;
                                    $percentage = round(($count / count($methodology_averages)) * 100);
                                    ?>

                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $percentage; ?>%;" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                    <?php echo $i; ?> - <?php echo $percentage; ?>%
                                </p>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-title">III. Communication Skills</h6>
                            <?php
                            $communication_counts = array_count_values($communication_averages);
                            krsort($communication_counts);
                            ?>
                            <?php for ($i = 5; $i >= 1; $i--) : ?>
                                <p class="card-text">
                                    <?php
                                    $count = isset($communication_counts[$i]) ? $communication_counts[$i] : 0;
                                    $percentage = round(($count / count($communication_averages)) * 100);
                                    ?>

                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $percentage; ?>%;" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                    <?php echo $i; ?> - <?php echo $percentage; ?>%
                                </p>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-title">IV. Class / Classroom Management</h6>
                            <?php
                            $management_counts = array_count_values($management_averages);
                            krsort($management_counts);
                            ?>
                            <?php for ($i = 5; $i >= 1; $i--) : ?>
                                <p class="card-text">
                                    <?php
                                    $count = isset($management_counts[$i]) ? $management_counts[$i] : 0;
                                    $percentage = round(($count / count($management_averages)) * 100);
                                    ?>

                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $percentage; ?>%;" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                    <?php echo $i; ?> - <?php echo $percentage; ?>%
                                </p>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-title">V. Personal Qualities</h6>
                            <?php
                            $qualities_counts = array_count_values($qualities_averages);
                            krsort($qualities_counts);
                            ?>
                            <?php for ($i = 5; $i >= 1; $i--) : ?>
                                <p class="card-text">
                                    <?php
                                    $count = isset($qualities_counts[$i]) ? $qualities_counts[$i] : 0;
                                    $percentage = round(($count / count($qualities_averages)) * 100);
                                    ?>

                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $percentage; ?>%;" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    
                                    <?php echo $i; ?> - <?php echo $percentage; ?>%
                                </p>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3 pb-5">
    <div class="card">
            <div class="card-header">
                    <h5> Comments 
                        <a class="btn btn-primary btn-sm float-right mr-2" href="cvs-files.php?id=<?= $webinar_id ?>">
                            <i class="bi bi-box-arrow-down"></i>
                        </a>
                    </h5>
                </div>
                <div class="card-body" style="height: 815px; overflow-y: auto;">
                    <!-- Display the table with the category averages -->
                    <?php
                    $carouselItems = array(); // Array to store carousel items

                    foreach ($result as $assessment) :
                    $certificate_name = $assessment['certificate_name'];

                    ob_start(); // Start output buffering

                    foreach ($questions as $key => $question) :
                        if (isset($assessment[$key])) :
                            ?>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <p class="card-text">
                                <strong>Q:</strong> <?php echo $question; ?><br>
                                <strong>A:</strong> <?php echo $assessment[$key]; ?><br>
                            <?php echo "- " . $certificate_name; ?>
                            </p>
                        </div>
                    </div>
                            <?php
                                endif;
                            endforeach;

                        $carouselItems[] = ob_get_clean(); // Save the buffered output as a carousel item
                        endforeach;
                        ?>

                    <?php foreach ($carouselItems as $item) : ?>
                    <div class="comment-container">
                        <?php echo $item; ?>
                    </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php include ('../includes/footer.php'); ?>
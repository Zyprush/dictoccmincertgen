<?php
include("../includes/header.php");
include('../config/comments_function.php');

$webinar_id = $_GET['id'];
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
<link rel="stylesheet" href="../assets/css/chart.css">
<div class="swiper-container">
    <div class="swiper-wrapper">
        <!-- Slide 1: GENERAL COURSE EVALUATION -->
        <div class="swiper-slide">

            <div class="container mt-3 px-5">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header custom-card-header">
                                <h2 class="text-center chart-heading mt-2"> <strong> Course Evaluation </strong> 
                                <a class="btn btn-primary btn-sm float-right mr-2" href="cvs-files.php?id=<?= $webinar_id ?>">
                                    <i class="bi bi-box-arrow-down"></i>
                                </a>
                            </h2>
                                
                            </div>
                            <div class="card-body">   
                                <div class="row px-3">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="chart-card">
                                            <h2 class="chart-heading">RELEVANCE OF <br> THE TRAINING</h2>
                                            <canvas id="relevantChart" class="my-chart"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="chart-card">
                                            <h2 class="chart-heading">INFORMATION / SKILLS ACQUIRED</h2>
                                            <canvas id="informationChart" class="my-chart"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="chart-card">
                                            <h2 class="chart-heading">INSTRUCTIONAL <br> DESIGN</h2>
                                            <canvas id="instructionalDesignChart" class="my-chart"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="chart-card">
                                            <h2 class="chart-heading">CLASS <br> INTERACTION</h2>
                                            <canvas id="classInteractionChart" class="my-chart"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="chart-card">
                                            <h2 class="chart-heading">SENSITIVITY AND <br> ASSISTANCE</h2>
                                            <canvas id="staffSensitivityChart" class="my-chart"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="chart-card">
                                            <h2 class="chart-heading">COURSE <br> GENERAL EVALUATION</h2>
                                            <canvas id="overallRatingChart" class="my-chart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2: GENERAL TRAINER EVALUATION -->
        <div class="swiper-slide">

            <div class="container mt-3 px-5">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header custom-card-header">
                                <h2 class="text-center chart-heading mt-2"> <strong> RESOURCE PERSON / TRAINER EVALUATION </strong> 
                                <a class="btn btn-primary btn-sm float-right mr-2" href="cvs-files.php?id=<?= $webinar_id ?>">
                                    <i class="bi bi-box-arrow-down"></i>
                                </a>
                                </h2>
                            </div>
                            <div class="card-body">
                                <div class="row px-3">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="chart-card">
                                            <h2 class="chart-heading">MASTERY OF THE SUBJECT MATTER</h2>
                                            <canvas id="subjectMatterChart" class="my-chart"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="chart-card">
                                            <h2 class="chart-heading">INSTRUCTIONAL METHODOLOGY</h2>
                                            <canvas id="methodologyChart" class="my-chart"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="chart-card">
                                            <h2 class="chart-heading">COMMUNICATIONS SKILLS</h2>
                                            <canvas id="communicationSkillsChart" class="my-chart"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="chart-card">
                                            <h2 class="chart-heading">CLASS / CLASSROOM MANAGEMENT</h2>
                                            <canvas id="classroomManagementChart" class="my-chart"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="chart-card">
                                            <h2 class="chart-heading">PERSONAL <br> QUALITIES</h2>
                                            <canvas id="personalQualitiesChart" class="my-chart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Slide 3: GENERAL TRAINER EVALUATION -->
        <div class="swiper-slide">

            <div class="container mt-3 px-5">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header custom-card-header">
                                <h2 class="text-center chart-heading mt-2"> <strong> COMMENTS </strong> 
                                <a class="btn btn-primary btn-sm float-right mr-2" href="cvs-files.php?id=<?= $webinar_id ?>">
                                    <i class="bi bi-box-arrow-down"></i>
                                </a>
                                </h2>
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
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Navigation arrows -->
<div class="swiper-button-next" hidden></div>
<div class="swiper-button-prev" hidden></div>

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../assets/js/chart.js"></script>

<script>
    var swiper = new Swiper('.swiper-container', {
        direction: 'horizontal',
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>

<?php include('../includes/footer.php'); ?>
</body>

</html>

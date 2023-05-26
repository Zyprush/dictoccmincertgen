<?php
include('../config/authentication.php');
include('../includes/header.php');
include('../config/general_response_function.php');
include('../config/comments_function.php');
?> 
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"
/>

<div class="swiper-container">
    <div class="swiper-wrapper">
        <!-- Slide 1: GENERAL COURSE EVALUATION -->
        <div class="swiper-slide">
            <div class="container container-no-padding">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h3>GENERAL COURSE EVALUATION</h3>
                        <ul class="list-inline">
                            <li class="list-inline-item"><span class="color-box green"></span> - Excellent</li>
                            <li class="list-inline-item"><span class="color-box yellowgreen"></span> - Very Satisfactory</li>
                            <li class="list-inline-item"><span class="color-box yellow"></span> - Satisfactory</li>
                            <li class="list-inline-item"><span class="color-box orange"></span> - Fair</li>
                            <li class="list-inline-item"><span class="color-box red"></span> - Poor</li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <!-- Display the table with the category averages -->
                        <div class="container-fluid d-flex justify-content-center">
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <div class="evaluation-circle shadow <?php echo $relevance_color_class; ?>">
                                        <h4><i class="fas fa-lightbulb"></i></h4>
                                        <p>Relevance of Training</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="evaluation-circle shadow <?php echo $information_color_class; ?>">
                                        <h4><i class="fas fa-info-circle"></i></h4>
                                        <p>Information / Skills acquired</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="evaluation-circle shadow <?php echo $instructional_design_color_class; ?>">
                                        <h4><i class="fas fa-book"></i></h4>
                                        <p>Instructional Design</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="evaluation-circle shadow <?php echo $class_interaction_color_class; ?>">
                                        <h4><i class="fas fa-users"></i></h4>
                                        <p>Class Interaction</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="evaluation-circle shadow <?php echo $sensitivity_assistance_color_class; ?>">
                                        <h4><i class="fas fa-hands-helping"></i></h4>
                                        <p>Sensitivity and Assistance</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="evaluation-circle shadow <?php echo $general_rating_color_class; ?>">
                                        <h4><i class="fas fa-star"></i></h4>
                                        <p>General Rating</p>
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
            <div class="container container-no-padding">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>GENERAL TRAINER EVALUATION</h3>
                        <ul class="list-inline">
                            <li class="list-inline-item"><span class="color-box green"></span> - Excellent</li>
                            <li class="list-inline-item"><span class="color-box yellowgreen"></span> - Very Satisfactory</li>
                            <li class="list-inline-item"><span class="color-box yellow"></span> - Satisfactory</li>
                            <li class="list-inline-item"><span class="color-box orange"></span> - Fair</li>
                            <li class="list-inline-item"><span class="color-box red"></span> - Poor</li>
                        </ul>
                    </div>
                    <div class="card-body shadow">
                        <!-- Display the table with the category averages -->
                    <div class="container-fluid d-flex justify-content-center">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="evaluation-circle shadow <?php echo $trainer_mastery_color_class; ?>">
                                    <h4><i class="fas fa-graduation-cap"></i></h4> <!-- Change the icon class here -->
                                    <p>Mastery of the Subject Matter</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="evaluation-circle shadow <?php echo $trainer_instructional_methodology_color_class; ?>">
                                    <h4><i class="fas fa-chalkboard-teacher"></i></h4> <!-- Change the icon class here -->
                                    <p>Instructional Methodology</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="evaluation-circle shadow <?php echo $trainer_communication_skills_color_class; ?>">
                                    <h4><i class="fas fa-comments"></i></h4> <!-- Change the icon class here -->
                                    <p>Communication Skills</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="evaluation-circle shadow <?php echo $trainer_classroom_management_color_class; ?>">
                                    <h4><i class="fas fa-users"></i></h4> <!-- Change the icon class here -->
                                    <p>Class/Classroom Management</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="evaluation-circle shadow <?php echo $trainer_personal_qualities_color_class; ?>">
                                    <h4><i class="fas fa-heart"></i></h4> <!-- Change the icon class here -->
                                    <p>Personal Qualities</p>
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
            <div class="container container-no-padding">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>GENERAL COMMENTS</h3>
                    </div>
                    <div class="card-body shadow" style="height: 713px; overflow-y: auto;">
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

<!-- Navigation arrows -->
<div class="swiper-button-next" hidden></div>
<div class="swiper-button-prev" hidden></div>

<link rel="stylesheet" href="../assets/css/assessment_response.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

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

<?php
include('../includes/footer.php');
?>
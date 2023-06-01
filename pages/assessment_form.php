<?php
        require_once('../includes/components.php');
        include('../includes/header-2.0.php');

        if (!isset($_GET['webinar_id'])) {
            // Redirect the user to the webinar list page
            header('location: 404.php');
            exit();
        }

        // Get the webinar_id parameter from the query string
        $webinar_id = $_GET['webinar_id'];
    ?>
    <style>
  /* Custom styles for radio button */
  .form-check-input[type="radio"] {
    width: 20px;
    height: 20px;
  }
</style>

    <div class="container" style="max-width: 900px; margin-top:10px; margin-bottom: 10px;">
        <div class="card" style="background-color: #8191A6;">

            <div class="card-header bg-white">
                <div class="row align-items-center">
                    <div class="col">
                        <img src="../assets/img/Picture1.jpg" alt="logo" class="img-fluid" style="max-width: 100%; height: auto;">
                    </div>
                </div>
            </div>


            <div class="card-body">
                <form method="POST" action="../config/submit_assessment.php">

                    <!-- Add a hidden input field for webinar_id -->
                    <input type="hidden" name="webinar_id" value="<?php echo $webinar_id; ?>">

                    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
                        <!-- Indicators -->
                        <ol class="carousel-indicators" hidden>
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <li data-target="#myCarousel" data-slide-to="3"></li>
                            <li data-target="#myCarousel" data-slide-to="4"></li>
                        </ol>

                        <!-- Slides -->
                        <div class="carousel-inner p-0">
                            <div class="carousel-item active" id="slide1">

                                <div class="container">
                                    <div class="form-group p-3 mb-5 bg-white rounded border">
                                        <h1>Evaluation Form</h1>
                                        <p>
                                        Thank you for attending our webinar /course / training.  For you to be able to receive your e-certificate you must complete this Evaluation Form.  If there are any other completion requirements make sure you have also submitted them. You will receive an email with the link where you can download your e-certificates. <br> <br>
                                        For Premium and Free webinars: Your certificates may be downloaded from a link provided by an email from <a href="mailto:ilcdb_training4@dict.gov.ph">ilcdb_training4@dict.gov.ph</a> or <a href="mailto:ilcdb.registrar@dict.gov.ph">ilcdb.registrar@dict.gov.ph</a> 4-6 weeks after the webinar. <br> <br>
                                        For EDP Eligibility courses: Your certificates should be claimed personally at the Registrar's Office.  Please email the Registrar to know it the certificates are available at <a href="ilcdb.registrar@dict.gov.ph">ilcdb.registrar@dict.gov.ph</a> . If the Registrar's Office confirmed that your certificates are available, CLAIMING days for your certificates are TUESDAYS AND THURSDAY 9:00 AM until 12:00 NN ONLY.
                                        </p>
                                    </div>
                                </div>

                                <div class="container">
                                    <div class="form-group p-3 mb-5 bg-white rounded border">
                                        <h3>Important:</h3><br>
                                        <p>
                                            Per Section 2(Declaration of Policy) of the Data Privacy Act of 2012, it is the policy of the State to protect the fundamental human right of privacy, of communication while ensuring free flow of information to promote innovation and growth. The State recognizes the vital role of information and communications technology in nation-building and its inherent obligation to ensure that personal information in information and communications systems in the government and in the private sector are secured and protected. <br> <br>
                                            As such, information collected from this form shall be held in strict confidence and shall only be used solely for records keeping purposes. <br> <br>
                                            Falsification of any of the given information will automatically bar applicant from any ILCDB Course. <br> <br>
                                            Participants should attend 100% of the session to receive a certificate.
                                        </p>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="agreement" style="width: 1.25em; height: 1.25em;" required>
                                            <label class="form-check-label" for="defaultCheck1" style="margin-left: 10px;">
                                                I agree
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="container">
                                    <div class="form-group">
                                        <label for="email" class="text-white">
                                            <i class="fas fa-envelope text-white"></i> Email:
                                        </label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>

                                    <button class="btn btn-primary nextBtn">Next</button>
                                    
                                </div>

                            </div>

                            <div class="carousel-item" id="slide2">

                                <div class="container">
                                    <div class="form-group p-3 mb-5 bg-white rounded border">
                                        <h3>
                                            <?php
                                                include("../config/dbconfig.php");
                                                // Get the webinar_id from the GET request or any other source
                                                $webinar_id = $_GET['webinar_id'];

                                                // SQL query to retrieve the title from the "webinars" table
                                                $sql = "SELECT webinar_title FROM webinars WHERE webinar_id = '$webinar_id'";

                                                // Execute the query
                                                $result = mysqli_query($conn, $sql);

                                                // Check if the query was successful
                                                if ($result) {
                                                    // Fetch the title from the result
                                                    $row = mysqli_fetch_assoc($result);
                                                    $title = $row['webinar_title'];

                                                    // Display the title
                                                    echo $title;
                                                } else {
                                                    // Handle any errors that occurred during the query execution
                                                    echo "Error: " . mysqli_error($conn);
                                                }

                                                // Close the database connection
                                                mysqli_close($conn);
                                            ?>

                                        </h3>

                                        <p>
                                            ICT LITERACY AND COMPETENCY DEVELOPMENT BUREAU (ILCDBu) <br><br>
                                            Thank you for your participation in this training / webinar / course on <?php echo $title; ?>.  We would appreciate your feedback and welcome any additional comments that you may have. Your response will be used to enhance our training / webinar / course and ensure that we meet your future needs. Please provide your response to the questions listed below by clicking your choice from the options provided. We value your responses to this evaluation questions.
                                        </p>
                                    </div>

                                    <button class="btn btn-primary backBtn">Back</button>
                                    <button class="btn btn-primary nextBtn">Next</button>

                                </div>

                            </div>

                            <div class="carousel-item" id="slide3">
                                
                                <?php inputElement("l_name", "l_name", "Last Name");?>

                                <?php inputElement("f_name", "f_name", "First Name");?>
                                
                                <?php inputElementnot("m_name", "m_name", "Middle Name");?>
                                
                                <?php inputElementnot("e_name", "e_name", "Extension Name (JR, SR, I, II etc..):");?>

                                <?php inputElement("province", "province", "Province");?>

                                <div class="form-group">
                                    <label for="region">Region:</label>
                                    <select class="form-control" id="region" name="region" required>
                                        <option value="" selected disabled>Select region</option>
                                        <option value="REGION 1 - ILOCOS REGION">REGION 1 - ILOCOS REGION</option>
                                        <option value="REGION 2 - CAGAYAN VALLEY">REGION 2 - CAGAYAN VALLEY</option>
                                        <option value="REGION 3 - CENTRAL LUZON">REGION 3 - CENTRAL LUZON</option>
                                        <option value="REGION 4A - CALABARZON">REGION 4A - CALABARZON</option>
                                        <option value="REGION 4B - MIMAROPA">REGION 4B - MIMAROPA</option>
                                        <option value="REGION 5 - BICOL REGION">REGION 5 - BICOL REGION</option>
                                        <option value="REGION 6 - CENTRAL VISAYAS">REGION 6 - CENTRAL VISAYAS</option>
                                        <option value="REGION 7 - WESTERN VISAYAS">REGION 7 - WESTERN VISAYAS</option>
                                        <option value="REGION 8 - EASTERN VISAYAS">REGION 8 - EASTERN VISAYAS</option>
                                        <option value="REGION 9 - ZAMBOANGA PENINSULA">REGION 9 - ZAMBOANGA PENINSULA</option>
                                        <option value="REGION 10 - NORTHERN MINDANAO">REGION 10 - NORTHERN MINDANAO</option>
                                        <option value="REGION 11 - DAVAO REGION">REGION 11 - DAVAO REGION</option>
                                        <option value="REGION 12 - SOCCSKSARGEN">REGION 12 - SOCCSKSARGEN</option>
                                        <option value="REGION 13 - NATIONAL CAPITAL REGION">REGION 13 - NATIONAL CAPITAL REGION</option>
                                        <option value="REGION 14 - CORDILLERA ADMINISTRATIVE REGION">REGION 14 - CORDILLERA ADMINISTRATIVE REGION</option>
                                        <option value="REGION 15 - AUTONOMOUS REGION OF MUSLIM MINDANAO">REGION 15 - AUTONOMOUS REGION OF MUSLIM MINDANAO</option>
                                        <option value="REGION 16 - CARAGA">REGION 16 - CARAGA</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="age">Age:</label>
                                    <select class="form-control" id="age" name="age" required>
                                        <option value="" selected disabled>Select age range</option>
                                        <option value="20 - 30">20 - 30</option>
                                        <option value="31 - 40">31 - 40</option>
                                        <option value="41 - 50">41 - 50</option>
                                        <option value="51 - 60">51 - 60</option>
                                        <option value="ABOVE 60">ABOVE 60</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="gender">Gender:</label>
                                    <select class="form-control" id="gender" name="gender" required>
                                        <option value="" selected disabled>Select Gender</option>
                                        <option value="MALE">MALE</option>
                                        <option value="FEMALE">FEMALE</option>
                                        <option value="PREFER NOT TO ANSWER">PREFER NOT TO ANSWER</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="citizenship">Citizenship:</label>
                                    <input type="text" class="form-control" id="citizenship" name="citizenship" required>
                                </div>

                                <div class="form-group">
                                    <label for="certficate_name">
                                        Name you want to put on your e-Certificate. <br>
                                        ==================================== <br>
                                        (FIRST NAME   MIDDLE INITIAL    LAST NAME) <br>
                                        example:    JUAN P. DELA CRUZ
                                    </label>
                                    <input type="text" class="form-control" id="certificate_name" name="certificate_name" required>
                                </div>

                                <div class="form-group">
                                    <label for="certificate_email">
                                        Valid Email address for receiving your e-Certificate (preferably google email address)<br>
                                        <b> SIGURADUHIN TAMA AT KUMPLETO </b>
                                    </label>
                                    <input type="text" class="form-control" id="certificate_email" name="certificate_email" required>
                                </div>
                                
                                <button class="btn btn-primary backBtn">Back</button>
                                <button class="btn btn-primary nextBtn">Next</button>

                            </div>

                            <div class="carousel-item" id="slide4">
                            
                                <div class="container">
                                    <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                                        <h3>COURSE EVALUATION</h3>
                                        <p>
                                            Instruction: Please rate each item below based on a 5-1 scale (5 being the highest and 1 the lowest): <br>
                                            5 - Excellent <br>
                                            4 - Very Satisfactory <br>
                                            3 - Satisfactory <br>
                                            2 - Fair <br>
                                            1 - Poor / Needs Improvement 
                                        </p>
                                    </div>
                                </div>

                                <div class="container">
                                    <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                                        <h3>I. RELEVANCE OF THE TRAINING</h3>
                                        <p>1. Relevance to your current work</p>
                                        <?php formCheck("question1", "question1-1", "1");?>
                                        
                                        <?php formCheck("question1", "question1-2", "2");?>

                                        <?php formCheck("question1", "question1-3", "3");?>

                                        <?php formCheck("question1", "question1-4", "4");?>

                                        <?php formCheck("question1", "question1-5", "5");?>

                                        <p>2. Relevance to your future / desired work</p>
                                        <?php formCheck("question2", "question2-1", "1");?>
                                        
                                        <?php formCheck("question2", "question2-2", "2");?>

                                        <?php formCheck("question2", "question2-3", "3");?>

                                        <?php formCheck("question2", "question2-4", "4");?>

                                        <?php formCheck("question2", "question2-5", "5");?>

                                        <p>3. Relevance to your institution's / agency's needs</p>
                                        <?php formCheck("question3", "question3-1", "1");?>
                                        
                                        <?php formCheck("question3", "question3-2", "2");?>

                                        <?php formCheck("question3", "question3-3", "3");?>

                                        <?php formCheck("question3", "question3-4", "4");?>

                                        <?php formCheck("question3", "question3-5", "5");?>

                                    </div>
                                </div>

                                <div class="container">
                                    <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                                        <h3>II. INFORMATION / SKILLS ACQUIRED</h3>
                                        <p>1. Amount of information covered in the course / training / seminar</p>
                                        <?php formCheck("question4", "question4-1", "1");?>
                                        
                                        <?php formCheck("question4", "question4-2", "2");?>

                                        <?php formCheck("question4", "question4-3", "3");?>

                                        <?php formCheck("question4", "question4-4", "4");?>

                                        <?php formCheck("question4", "question4-5", "5");?>

                                        <p>2. Extent to which you gained ideas useful to you work</p>
                                        <?php formCheck("question5", "question5-1", "1");?>
                                        
                                        <?php formCheck("question5", "question5-2", "2");?>

                                        <?php formCheck("question5", "question5-3", "3");?>

                                        <?php formCheck("question5", "question5-4", "4");?>

                                        <?php formCheck("question5", "question5-5", "5");?>

                                        <p>3. Extent to which you have acquired new skills</p>
                                        <?php formCheck("question6", "question6-1", "1");?>
                                        
                                        <?php formCheck("question6", "question6-2", "2");?>

                                        <?php formCheck("question6", "question6-3", "3");?>

                                        <?php formCheck("question6", "question6-4", "4");?>

                                        <?php formCheck("question6", "question6-5", "5");?>

                                        <p>4. Extent that this course / training / seminar achieved its objectives</p>
                                        <?php formCheck("question7", "question7-1", "1");?>
                                        
                                        <?php formCheck("question7", "question7-2", "2");?>

                                        <?php formCheck("question7", "question7-3", "3");?>

                                        <?php formCheck("question7", "question7-4", "4");?>

                                        <?php formCheck("question7", "question7-5", "5");?>
                                    </div>
                                </div>

                                <div class="container">
                                    <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                                        <h3>III. INSTRUCTIONAL DESIGN</h3>
                                        <p>1. Effectiveness of the course / training / seminar in maintaining your interest from start to finish</p>
                                        <?php formCheck("question8", "question8-1", "1");?>
                                        
                                        <?php formCheck("question8", "question8-2", "2");?>

                                        <?php formCheck("question8", "question8-3", "3");?>

                                        <?php formCheck("question8", "question8-4", "4");?>

                                        <?php formCheck("question8", "question8-5", "5");?>

                                        <p>2. Effectiveness of the visual aids in reinforcing the lessons</p>
                                        <?php formCheck("question9", "question9-1", "1");?>
                                        
                                        <?php formCheck("question9", "question9-2", "2");?>

                                        <?php formCheck("question9", "question9-3", "3");?>

                                        <?php formCheck("question9", "question9-4", "4");?>

                                        <?php formCheck("question9", "question9-5", "5");?>

                                        <p>3. Adequacy of time allotted to each topics</p>
                                        <?php formCheck("question10", "question10-1", "1");?>
                                        
                                        <?php formCheck("question10", "question10-2", "2");?>

                                        <?php formCheck("question10", "question10-3", "3");?>

                                        <?php formCheck("question10", "question10-4", "4");?>

                                        <?php formCheck("question10", "question10-5", "5");?>

                                        <p>4. Logic in the progression or sequence of topics</p>
                                        <?php formCheck("question11", "question11-1", "1");?>
                                        
                                        <?php formCheck("question11", "question11-2", "2");?>

                                        <?php formCheck("question11", "question11-3", "3");?>

                                        <?php formCheck("question11", "question11-4", "4");?>

                                        <?php formCheck("question11", "question11-5", "5");?>

                                        <p>5. Time allotted for discussions and Q and A</p>
                                        <?php formCheck("question12", "question12-1", "1");?>
                                        
                                        <?php formCheck("question12", "question12-2", "2");?>

                                        <?php formCheck("question12", "question12-3", "3");?>

                                        <?php formCheck("question12", "question12-4", "4");?>

                                        <?php formCheck("question12", "question12-5", "5");?>

                                        <p>6. Variety of the training methods used (lectures, exercises, discussion, examination / assessment)</p>
                                        <?php formCheck("question13", "question13-1", "1");?>
                                        
                                        <?php formCheck("question13", "question13-2", "2");?>

                                        <?php formCheck("question13", "question13-3", "3");?>

                                        <?php formCheck("question13", "question13-4", "4");?>

                                        <?php formCheck("question13", "question13-5", "5");?>

                                    </div>
                                </div>

                                <div class="container">
                                    <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                                        <h3>IV. CLASS INTERACTION</h3>
                                        <p>1. Effectiveness of the resource person / instructor in training you to use and appreciate application / subject</p>
                                        <?php formCheck("question14", "question14-1", "1");?>
                                        
                                        <?php formCheck("question14", "question14-2", "2");?>

                                        <?php formCheck("question14", "question14-3", "3");?>

                                        <?php formCheck("question14", "question14-4", "4");?>

                                        <?php formCheck("question14", "question14-5", "5");?>

                                        <p>2. Responsiveness of the resource person / instructor in answering participant/s questions / queries</p>
                                        <?php formCheck("question15", "question15-1", "1");?>
                                        
                                        <?php formCheck("question15", "question15-2", "2");?>

                                        <?php formCheck("question15", "question15-3", "3");?>

                                        <?php formCheck("question15", "question15-4", "4");?>

                                        <?php formCheck("question15", "question15-5", "5");?>

                                        <p>3. Interaction between participants and resource person / instructor</p>
                                        <?php formCheck("question16", "question16-1", "1");?>
                                        
                                        <?php formCheck("question16", "question16-2", "2");?>

                                        <?php formCheck("question16", "question16-3", "3");?>

                                        <?php formCheck("question16", "question16-4", "4");?>

                                        <?php formCheck("question16", "question16-5", "5");?>
                                        
                                    </div>
                                </div>

                                <div class="container">
                                    <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                                        <h3>V. SENSITIVITY AND ASSISTANCE PROVIDED BY THE TRAINING STAFF</h3>
                                        <p class="form-check form-check-inline">Poor</p>
                                        <?php formCheck("question17", "question17-1", "1");?>
                                        
                                        <?php formCheck("question17", "question17-2", "2");?>

                                        <?php formCheck("question17", "question17-3", "3");?>

                                        <?php formCheck("question17", "question17-4", "4");?>

                                        <?php formCheck("question17", "question17-5", "5");?>
                                        <p class="form-check form-check-inline">Excellent</p>

                                    </div>
                                </div>

                                <div class="container">
                                    <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                                        <h3>VI. IN GENERAL, HOW WOULD YOU RATE THIS COURSE / TRAINING / SEMINAR</h3>
                                        <p class="form-check form-check-inline">Poor</p>
                                        <?php formCheck("question18", "question18-1", "1");?>
                                        
                                        <?php formCheck("question18", "question18-2", "2");?>

                                        <?php formCheck("question18", "question18-3", "3");?>

                                        <?php formCheck("question18", "question18-4", "4");?>

                                        <?php formCheck("question18", "question18-5", "5");?>
                                        <p class="form-check form-check-inline">Excellent</p>

                                    </div>
                                </div>

                                <div class="container">
                                    <div class="form-group p-3 mb-5">
                                    <?php inputElementStyle("most_useful", "most_useful", "1. What did you find most useful his course / training / seminar?");?>
                                
                                    <?php inputElementStyle("least_useful", "least_useful", "2. What did you find least useful in this course / training / seminar?");?>
                                
                                    <?php inputElementStyle("spent_more", "spent_more", "3. On which topics, if any, would you rather have spent more time?");?>
                                
                                    <?php inputElementStyle("spent_less", "spent_less", "4. On which topics, if any, would you rather have spent less time?");?>
                                
                                    <?php inputElementStyle("improve_conduct", "improve_conduct", "5. What advice can you give to improve the future conduct of this course / training / seminar?");?>
                                
                                    <?php inputElementStyle("recommend", "recommend", "6. Could you recommend this course / training / seminar to your colleagues?");?>
                                
                                    <?php inputElementStyle("result_participation", "result_participation", "7. Please list three (3) things that you intend to do as a result of your participation in this course / training / seminar.");?>
                                
                                    <?php inputElementStyle("comments", "comments", "8. Comments and / or Suggestions.");?>

                                    <button class="btn btn-primary backBtn">Back</button>
                                    <button class="btn btn-primary nextBtn">Next</button>
                                </div>

                            </div>

                            <div class="carousel-item" id="slide5">
                                
                                <div class="container">
                                    <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                                        <h3>RESOURCE PERSON / TRAINER EVALUATION</h3>
                                        <p>
                                            Instruction: Please rate each item below based on a 5-1 scale (5 being the highest and 1 the lowest) 
                                        </p>
                                    </div>
                                </div>

                                <div class="container">
                                    <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                                        <h3>I. MASTERY OF THE SUBJECT MATTER</h3>
                                        <p>1. Knowledge about the subject matter</p>
                                        <?php formCheck("question19", "question19-1", "1");?>
                                        
                                        <?php formCheck("question19", "question19-2", "2");?>

                                        <?php formCheck("question19", "question19-3", "3");?>

                                        <?php formCheck("question19", "question19-4", "4");?>

                                        <?php formCheck("question19", "question19-5", "5");?>

                                        <p>2. Presents topics in a well-organized manner</p>
                                        <?php formCheck("question20", "question20-1", "1");?>
                                        
                                        <?php formCheck("question20", "question20-2", "2");?>

                                        <?php formCheck("question20", "question20-3", "3");?>

                                        <?php formCheck("question20", "question20-4", "4");?>

                                        <?php formCheck("question20", "question20-5", "5");?>

                                        <p>3. Injects current developments relevant to the course / training</p>
                                        <?php formCheck("question21", "question21-1", "1");?>
                                        
                                        <?php formCheck("question21", "question21-2", "2");?>

                                        <?php formCheck("question21", "question21-3", "3");?>

                                        <?php formCheck("question21", "question21-4", "4");?>

                                        <?php formCheck("question21", "question21-5", "5");?>

                                        <p>4. Uses notes wisely</p>
                                        <?php formCheck("question22", "question22-1", "1");?>
                                        
                                        <?php formCheck("question22", "question22-2", "2");?>

                                        <?php formCheck("question22", "question22-3", "3");?>

                                        <?php formCheck("question22", "question22-4", "4");?>

                                        <?php formCheck("question22", "question22-5", "5");?>
                                    
                                    </div>
                                </div>

                                <div class="container">
                                    <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                                        <h3>II. INSTRUCTIONAL METHODOLOGY</h3>
                                        <p>1. Able to explain theories and concepts clearly</p>
                                        <?php formCheck("question23", "question23-1", "1");?>
                                        
                                        <?php formCheck("question23", "question23-2", "2");?>

                                        <?php formCheck("question23", "question23-3", "3");?>

                                        <?php formCheck("question23", "question23-4", "4");?>

                                        <?php formCheck("question23", "question23-5", "5");?>

                                        <p>2. Gives adequate exercises / assignments</p>
                                        <?php formCheck("question24", "question24-1", "1");?>
                                        
                                        <?php formCheck("question24", "question24-2", "2");?>

                                        <?php formCheck("question24", "question24-3", "3");?>

                                        <?php formCheck("question24", "question24-4", "4");?>

                                        <?php formCheck("question24", "question24-5", "5");?>

                                        <p>3. Utilizes instructional materials effectively</p>
                                        <?php formCheck("question25", "question25-1", "1");?>
                                        
                                        <?php formCheck("question25", "question25-2", "2");?>

                                        <?php formCheck("question25", "question25-3", "3");?>

                                        <?php formCheck("question25", "question25-4", "4");?>

                                        <?php formCheck("question25", "question25-5", "5");?>

                                        <p>4. Encourages participants to raise questions</p>
                                        <?php formCheck("question26", "question26-1", "1");?>
                                        
                                        <?php formCheck("question26", "question26-2", "2");?>

                                        <?php formCheck("question26", "question26-3", "3");?>

                                        <?php formCheck("question26", "question26-4", "4");?>

                                        <?php formCheck("question26", "question26-5", "5");?>

                                        <p>5. Makes use of time efficiently</p>
                                        <?php formCheck("question27", "question27-1", "1");?>
                                        
                                        <?php formCheck("question27", "question27-2", "2");?>

                                        <?php formCheck("question27", "question27-3", "3");?>

                                        <?php formCheck("question27", "question27-4", "4");?>

                                        <?php formCheck("question27", "question27-5", "5");?>
                                
                                    </div>
                                </div>

                                <div class="container">
                                    <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                                        <h3>III. COMMUNICATIONS SKILLS</h3>
                                        <p>1. Projects a clear and audible voice</p>
                                        <?php formCheck("question28", "question28-1", "1");?>
                                        
                                        <?php formCheck("question28", "question28-2", "2");?>

                                        <?php formCheck("question28", "question28-3", "3");?>

                                        <?php formCheck("question28", "question28-4", "4");?>

                                        <?php formCheck("question28", "question28-5", "5");?>

                                        <p>2. Expresses his / her ideas clearly, fluently, and spontaneously</p>
                                        <?php formCheck("question29", "question29-1", "1");?>
                                        
                                        <?php formCheck("question29", "question29-2", "2");?>

                                        <?php formCheck("question29", "question29-3", "3");?>

                                        <?php formCheck("question29", "question29-4", "4");?>

                                        <?php formCheck("question29", "question29-5", "5");?>
                                        
                                    </div>
                                </div>

                                <div class="container">
                                    <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                                        <h3>IV. CLASS / CLASSROOM MANAGEMENT</h3>
                                        <p>1. Able to inspire and maintain the participant’s interest</p>
                                        <?php formCheck("question30", "question30-1", "1");?>
                                        
                                        <?php formCheck("question30", "question30-2", "2");?>

                                        <?php formCheck("question30", "question30-3", "3");?>

                                        <?php formCheck("question30", "question30-4", "4");?>

                                        <?php formCheck("question30", "question30-5", "5");?>

                                        <p>2. Willingness to help in the participant’s course / training related problems</p>
                                        <?php formCheck("question31", "question31-1", "1");?>
                                        
                                        <?php formCheck("question31", "question31-2", "2");?>

                                        <?php formCheck("question31", "question31-3", "3");?>

                                        <?php formCheck("question31", "question31-4", "4");?>

                                        <?php formCheck("question31", "question31-5", "5");?>

                                        <p>3. Open to criticism and gives / accepts alternative</p>
                                        <?php formCheck("question32", "question32-1", "1");?>
                                        
                                        <?php formCheck("question32", "question32-2", "2");?>

                                        <?php formCheck("question32", "question32-3", "3");?>

                                        <?php formCheck("question32", "question32-4", "4");?>

                                        <?php formCheck("question32", "question32-5", "5");?>

                                        <p>4. Able to maintain class / classroom discipline and control</p>
                                        <?php formCheck("question33", "question33-1", "1");?>
                                        
                                        <?php formCheck("question33", "question33-2", "2");?>

                                        <?php formCheck("question33", "question33-3", "3");?>

                                        <?php formCheck("question33", "question33-4", "4");?>

                                        <?php formCheck("question33", "question33-5", "5");?>
                                        
                                    </div>
                                </div>

                                <div class="container">
                                    <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                                        <h3>V. PERSONAL QUALITIES</h3>
                                        <p>1. Follows the time duration (class hours)</p>
                                        <?php formCheck("question34", "question34-1", "1");?>
                                        
                                        <?php formCheck("question34", "question34-2", "2");?>

                                        <?php formCheck("question34", "question34-3", "3");?>

                                        <?php formCheck("question34", "question34-4", "4");?>

                                        <?php formCheck("question34", "question34-5", "5");?>

                                        <p>2. Dresses neatly and appropriately</p>
                                        <?php formCheck("question35", "question35-1", "1");?>
                                        
                                        <?php formCheck("question35", "question35-2", "2");?>

                                        <?php formCheck("question35", "question35-3", "3");?>

                                        <?php formCheck("question35", "question35-4", "4");?>

                                        <?php formCheck("question35", "question35-5", "5");?>

                                        <p>3. Courteous in answering the participant’s questions / queries</p>
                                        <?php formCheck("question36", "question36-1", "1");?>
                                        
                                        <?php formCheck("question36", "question36-2", "2");?>

                                        <?php formCheck("question36", "question36-3", "3");?>

                                        <?php formCheck("question36", "question36-4", "4");?>

                                        <?php formCheck("question36", "question36-5", "5");?>

                                        <p>4. Projects image of authority</p>
                                        <?php formCheck("question37", "question37-1", "1");?>
                                        
                                        <?php formCheck("question37", "question37-2", "2");?>

                                        <?php formCheck("question37", "question37-3", "3");?>

                                        <?php formCheck("question37", "question37-4", "4");?>

                                        <?php formCheck("question37", "question37-5", "5");?>

                                    </div>
                                </div>

                                <?php inputElementStyle("other_comment", "other_comment", "OTHER COMMENTS");?>

                                <div class="container">
                                    <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                                        <h6>THANK YOU !</h6>
                                        <p>
                                        Thank you for your feedback. What you shared with us valuable and will help us improve our service. See you on our next training. Have a nice day! 
                                        </p>
                                    </div>
                                </div>
                                
                                <button class="btn btn-primary backBtn">Back</button>
                                <button type="submit" class="btn btn-primary" id="submitBtn" name="assessment_btn" style="color: white;"><i class="fas fa-paper-plane" hidden></i> Submit </button>

                            </div>

                        </div>
                        
                    </div>
                </form>
            </div>

        </div>
    </div>

<script>

$(document).ready(function() {
    // Initialize the carousel
    $('#myCarousel').carousel();

    // Handle next button click
    $('.nextBtn').click(function() {
        var currentSlideId = $('.carousel-item.active').attr('id');
  
  if (currentSlideId === 'slide1') {
    // Slide 1 input validation
    if ($("#email").val() === "" || !$("#defaultCheck1").is(":checked")) {
      return;
    }
  } else if (currentSlideId === 'slide3') {
    // Slide 2 input validation
    if ($("#l_name").val() === "" || $("#f_name").val() === "" || $("#province").val() === "" || $("#region option:selected").val() === "" || $("#age option:selected").val() === "" || $("#gender option:selected").val() === "" || $("#citizenship").val() === "" || $("#certificate_name").val() === "" || $("#certificate_email").val() === "") {
      return;
    }
  } else if (currentSlideId === 'slide4') {
    // Slide 3 input validation
    var questions = ["question1", "question2", "question3", "question4", "question5", "question6", "question7", "question8", "question9", "question10", "question11", "question12", "question13", "question14", "question15", "question16", "question17", "question18"];

    for (var i = 0; i < questions.length; i++) {
      if ($('input[name="' + questions[i] + '"]:checked').length === 0) {
        return;
      }
    }
    if ($("#most_useful").val() === "" || $("#least_useful").val() === "" || $("#spent_more").val() === "" || $("#spent_less").val() === "" || $("#improve_conduct").val() === "" || $("#recommend").val() === "" || $("#result_participation").val() === "" || $("#comments").val() === "") {
      return;
    }
  }

  $('#myCarousel').carousel('next');
    });

    // Handle back button click
    $('.backBtn').click(function() {
      // Move to the previous slide
      $('#myCarousel').carousel('prev');
    });
  });

</script>

</body>
</html>

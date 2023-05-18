<?php
        include('../includes/header-2.0.php');

        if (!isset($_GET['webinar_id'])) {
            // Redirect the user to the webinar list page
            header('location: 404.php');
            exit();
        }

        // Get the webinar_id parameter from the query string
        $webinar_id = $_GET['webinar_id'];
    ?>

    <div class="container" style="max-width: 900px; margin-top:10px; margin-bottom: 10px;">
        <div class="card" style="background-color: #8191A6;">

        <div class="card-header" style="background-color: white;">
          <div class="row align-items-center">
            <div class="col-auto">
              <img src="../assets/img/logo.png" alt="logo" style="width: 200px; height: 200px;">
            </div>
            <div class="col">
              <h3 class="mb-0" style="color: #3E5F8C;">REPUBLIC OF THE PHILIPPINES</h3>
              <hr class="my-2" style="border-color: #3E5F8C; border-width: 2px;">
              <h3 class="mb-0" style="color: #3E5F8C;">DEPARTMENT OF INFORMATION AND COMMUNICATIONS TECHNOLOGY</h3>
            </div>
          </div>
        </div>

            <div class="card-body">
                <form method="POST" action="../config/submit_assessment.php">
                    <!-- Add a hidden input field for webinar_id -->
                    <input type="hidden" name="webinar_id" value="<?php echo $webinar_id; ?>">

                  <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
                    <ol class="carousel-indicators">
                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                      <li data-target="#myCarousel" data-slide-to="1"></li>
                      <li data-target="#myCarousel" data-slide-to="2"></li>
                      <li data-target="#myCarousel" data-slide-to="3"></li> 
                      <li data-target="#myCarousel" data-slide-to="4"></li>
                    </ol>
                    
                    <div class="carousel-inner">
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
                        </div>

                        <button id="nextBtn1" class="btn" style="background-color: #3E5F8C; color: white;">Next</button>

                      </div>


                      <div class="carousel-item" id="slide2">
                        <div class="container">
                          <div class="form-group p-3 mb-5 bg-white rounded border">
                            <h3>
                              <?php
                                include ('../config/dbcon.php');
                                $webinar_id = $_GET['webinar_id'];
                                $ref_title = 'webinars/'.$webinar_id.'/webinar_title';
                                $title = $database->getReference($ref_title)->getValue();
                                echo $title;
                              ?>
                            </h3>
                            <p>
                            ICT LITERACY AND COMPETENCY DEVELOPMENT BUREAU (ILCDBu) <br><br>
                            Thank you for your participation in this training / webinar / course on <?php echo $title?>.  We would appreciate your feedback and welcome any additional comments that you may have. Your response will be used to enhance our training / webinar / course and ensure that we meet your future needs. Please provide your response to the questions listed below by clicking your choice from the options provided. We value your responses to this evaluation questions.
                            </p>
                          </div>
                        </div>
                        <button id="backBtn2" class="btn" style="background-color: #3E5F8C; color: white;">Back</button>
                        <button id="nextBtn2" class="btn" style="background-color: #3E5F8C; color: white;">Next</button>
                      </div>

                      <div class="carousel-item" id="slide3">
                        <div class="form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" id="l_name" name="l_name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" id="f_name" name="f_name" required>
                        </div>

                        <div class="form-group">
                            <label for="middle_name">Middle Name:</label>
                            <input type="text" class="form-control" id="m_name" name="m_name">
                        </div>

                        <div class="form-group">
                            <label for="extension_name">Extension Name (JR, SR, I, II etc..):</label>
                            <input type="text" class="form-control" id="e_name" name="e_name">
                        </div>

                        <div class="form-group">
                          <label for="province">Province:</label>
                          <input type="text" class="form-control" id="province" name="province" required>
                        </div>

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
                          <label for="gender">gender:</label>
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
                        <button id="backBtn3" class="btn" style="background-color: #3E5F8C; color: white;">Back</button>
                        <button id="nextBtn3" class="btn" style="background-color: #3E5F8C; color: white;">Next</button>
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
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question1" id="question1-1" value="1" required>
                              <label class="form-check-label" for="question1-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question1" id="question1-2" value="2">
                              <label class="form-check-label" for="question1-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question1" id="question1-3" value="3">
                              <label class="form-check-label" for="question1-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question1" id="question1-4" value="4">
                              <label class="form-check-label" for="question1-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question1" id="question1-5" value="5">
                              <label class="form-check-label" for="question1-5">5</label>
                            </div>

                            <p>2. Relevance to your future / desired work</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question2" id="question2-1" value="1" required>
                              <label class="form-check-label" for="question2-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question2" id="question2-2" value="2">
                              <label class="form-check-label" for="question2-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question2" id="question2-3" value="3">
                              <label class="form-check-label" for="question2-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question2" id="question2-4" value="4">
                              <label class="form-check-label" for="question2-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question2" id="question2-5" value="5">
                              <label class="form-check-label" for="question2-5">5</label>
                            </div>

                            <p>3. Relevance to your institution's / agency's needs</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question3" id="question3-1" value="1" required>
                              <label class="form-check-label" for="question3-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question3" id="question3-2" value="2">
                              <label class="form-check-label" for="question3-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question3" id="question3-3" value="3">
                              <label class="form-check-label" for="question3-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question3" id="question3-4" value="4">
                              <label class="form-check-label" for="question3-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question3" id="question3-5" value="5">
                              <label class="form-check-label" for="question3-5">5</label>
                            </div>
                          </div>
                        </div>

                        <div class="container">
                          <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                            <h3>II. INFORMATION / SKILLS ACQUIRED</h3>
                            <p>1. Amount of information covered in the course / training / seminar</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question4" id="question4-1" value="1" required>
                              <label class="form-check-label" for="question4-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question4" id="question4-2" value="2">
                              <label class="form-check-label" for="question4-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question4" id="question4-3" value="3">
                              <label class="form-check-label" for="question4-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question4" id="question4-4" value="4">
                              <label class="form-check-label" for="question4-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question4" id="question4-5" value="5">
                              <label class="form-check-label" for="question4-5">5</label>
                            </div>

                            <p>2. Extent to which you gained ideas useful to you work</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question5" id="question5-1" value="1" required>
                              <label class="form-check-label" for="question5-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question5" id="question5-2" value="2">
                              <label class="form-check-label" for="question5-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question5" id="question5-3" value="3">
                              <label class="form-check-label" for="question5-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question5" id="question5-4" value="4">
                              <label class="form-check-label" for="question5-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question5" id="question5-5" value="5">
                              <label class="form-check-label" for="question5-5">5</label>
                            </div>

                            <p>3. Extent to which you have acquired new skills</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question6" id="question6-1" value="1" required>
                              <label class="form-check-label" for="question6-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question6" id="question6-2" value="2">
                              <label class="form-check-label" for="question6-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question6" id="question6-3" value="3">
                              <label class="form-check-label" for="question6-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question6" id="question6-4" value="4">
                              <label class="form-check-label" for="question6-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question6" id="question6-5" value="5">
                              <label class="form-check-label" for="question6-5">5</label>
                            </div>

                            <p>4. Extent that this course / training / seminar achieved its objectives</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question7" id="question7-1" value="1" required>
                              <label class="form-check-label" for="question7-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question7" id="question7-2" value="2">
                              <label class="form-check-label" for="question7-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question7" id="question7-3" value="3">
                              <label class="form-check-label" for="question7-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question7" id="question7-4" value="4">
                              <label class="form-check-label" for="question7-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question7" id="question7-5" value="5">
                              <label class="form-check-label" for="question7-5">5</label>
                            </div>
                          </div>
                        </div>

                        <div class="container">
                          <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                            <h3>III. INSTRUCTIONAL DESIGN</h3>
                            <p>1. Effectiveness of the course / training / seminar in maintaining your interest from start to finish</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question8" id="question8-1" value="1" required>
                              <label class="form-check-label" for="question8-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question8" id="question8-2" value="2">
                              <label class="form-check-label" for="question8-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question8" id="question8-3" value="3">
                              <label class="form-check-label" for="question8-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question8" id="question8-4" value="4">
                              <label class="form-check-label" for="question8-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question8" id="question8-5" value="5">
                              <label class="form-check-label" for="question8-5">5</label>
                            </div>

                            <p>2. Effectiveness of the visual aids in reinforcing the lessons</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question9" id="question9-1" value="1" required>
                              <label class="form-check-label" for="question9-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question9" id="question9-2" value="2">
                              <label class="form-check-label" for="question9-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question9" id="question9-3" value="3">
                              <label class="form-check-label" for="question9-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question9" id="question9-4" value="4">
                              <label class="form-check-label" for="question9-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question9" id="question9-5" value="5">
                              <label class="form-check-label" for="question9-5">5</label>
                            </div>

                            <p>3. Adequacy of time allotted to each topics</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question10" id="question10-1" value="1" required>
                              <label class="form-check-label" for="question10-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question10" id="question10-2" value="2">
                              <label class="form-check-label" for="question10-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question10" id="question10-3" value="3">
                              <label class="form-check-label" for="question10-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question10" id="question10-4" value="4">
                              <label class="form-check-label" for="question10-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question10" id="question10-5" value="5">
                              <label class="form-check-label" for="question10-5">5</label>
                            </div>

                            <p>4. Logic in the progression or sequence of topics</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question11" id="question11-1" value="1" required>
                              <label class="form-check-label" for="question11-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question11" id="question11-2" value="2">
                              <label class="form-check-label" for="question11-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question11" id="question11-3" value="3">
                              <label class="form-check-label" for="question11-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question11" id="question11-4" value="4">
                              <label class="form-check-label" for="question11-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question11" id="question11-5" value="5">
                              <label class="form-check-label" for="question11-5">5</label>
                            </div>

                            <p>5. Time allotted for discussions and Q and A</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question12" id="question12-1" value="1" required>
                              <label class="form-check-label" for="question12-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question12" id="question12-2" value="2">
                              <label class="form-check-label" for="question12-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question12" id="question12-3" value="3">
                              <label class="form-check-label" for="question12-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question12" id="question12-4" value="4">
                              <label class="form-check-label" for="question12-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question12" id="question12-5" value="5">
                              <label class="form-check-label" for="question12-5">5</label>
                            </div>

                            <p>6. Variety of the training methods used (lectures, exercises, discussion, examination / assessment)</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question13" id="question13-1" value="1" required>
                              <label class="form-check-label" for="question13-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question13" id="question13-2" value="2">
                              <label class="form-check-label" for="question13-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question13" id="question13-3" value="3">
                              <label class="form-check-label" for="question13-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question13" id="question13-4" value="4">
                              <label class="form-check-label" for="question13-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question13" id="question13-5" value="5">
                              <label class="form-check-label" for="question13-5">5</label>
                            </div>
                          </div>
                        </div>

                        <div class="container">
                          <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                            <h3>IV. CLASS INTERACTION</h3>
                            <p>1. Effectiveness of the resource person / instructor in training you to use and appreciate application / subject</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question14" id="question14-1" value="1" required>
                              <label class="form-check-label" for="question14-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question14" id="question14-2" value="2">
                              <label class="form-check-label" for="question14-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question14" id="question14-3" value="3">
                              <label class="form-check-label" for="question14-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question14" id="question14-4" value="4">
                              <label class="form-check-label" for="question14-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question14" id="question14-5" value="5">
                              <label class="form-check-label" for="question14-5">5</label>
                            </div>

                            <p>2. Responsiveness of the resource person / instructor in answering participant/s questions / queries</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question15" id="question15-1" value="1" required>
                              <label class="form-check-label" for="question15-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question15" id="question15-2" value="2">
                              <label class="form-check-label" for="question15-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question15" id="question15-3" value="3">
                              <label class="form-check-label" for="question15-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question15" id="question15-4" value="4">
                              <label class="form-check-label" for="question15-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question15" id="question15-5" value="5">
                              <label class="form-check-label" for="question15-5">5</label>
                            </div>

                            <p>3. Interaction between participants and resource person / instructor</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question16" id="question16-1" value="1" required>
                              <label class="form-check-label" for="question16-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question16" id="question16-2" value="2">
                              <label class="form-check-label" for="question16-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question16" id="question16-3" value="3">
                              <label class="form-check-label" for="question16-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question16" id="question16-4" value="4">
                              <label class="form-check-label" for="question16-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question16" id="question16-5" value="5">
                              <label class="form-check-label" for="question16-5">5</label>
                            </div>
                          </div>
                        </div>

                        <div class="container">
                          <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                            <h3>V. SENSITIVITY AND ASSISTANCE PROVIDED BY THE TRAINING STAFF</h3>
                            <p class="form-check form-check-inline">Poor</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question17" id="question17-1" value="1" required>
                              <label class="form-check-label" for="question17-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question17" id="question17-2" value="2">
                              <label class="form-check-label" for="question17-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question17" id="question17-3" value="3">
                              <label class="form-check-label" for="question17-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question17" id="question17-4" value="4">
                              <label class="form-check-label" for="question17-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question17" id="question17-5" value="5">
                              <label class="form-check-label" for="question17-5">5</label>
                            </div>
                            <p class="form-check form-check-inline">Excellent</p>
                          </div>
                        </div>

                        <div class="container">
                          <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                            <h3>VI. IN GENERAL, HOW WOULD YOU RATE THIS COURSE / TRAINING / SEMINAR</h3>
                            <p class="form-check form-check-inline">Poor</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question18" id="question18-1" value="1" required>
                              <label class="form-check-label" for="question18-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question18" id="question18-2" value="2">
                              <label class="form-check-label" for="question18-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question18" id="question18-3" value="3">
                              <label class="form-check-label" for="question18-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question18" id="question18-4" value="4">
                              <label class="form-check-label" for="question18-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question18" id="question18-5" value="5">
                              <label class="form-check-label" for="question18-5">5</label>
                            </div>
                            <p class="form-check form-check-inline">Excellent</p>
                          </div>
                        </div>

                        <div class="container">
                          <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                            <div class="form-group">
                                <label for="most_useful">1. What did you find most useful his course / training / seminar?</label>
                                <input type="text" class="form-control" id="most_useful" name="most_useful" placeholder="Your Answer" required style="border: none; border-bottom: 1px solid black;">
                            </div>
                          </div>
                        </div>

                        <div class="container">
                          <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                            <div class="form-group">
                                <label for="least_useful">2. What did you find least useful in this course / training / seminar?</label>
                                <input type="text" class="form-control" id="least_useful" name="least_useful" placeholder="Your Answer" required style="border: none; border-bottom: 1px solid black;">
                            </div>
                          </div>
                        </div>

                        <div class="container">
                          <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                            <div class="form-group">
                                <label for="spent_more">3. On which topics, if any, would you rather have spent more time?</label>
                                <input type="text" class="form-control" id="spent_more" name="spent_more" placeholder="Your Answer" required style="border: none; border-bottom: 1px solid black;">
                            </div>
                          </div>
                        </div>

                        <div class="container">
                          <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                            <div class="form-group">
                                <label for="spent_less">4. On which topics, if any, would you rather have spent less time?</label>
                                <input type="text" class="form-control" id="spent_less" name="spent_less" placeholder="Your Answer" required style="border: none; border-bottom: 1px solid black;">
                            </div>
                          </div>
                        </div>

                        <div class="container">
                          <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                            <div class="form-group">
                                <label for="improve_conduct">5. What advice can you give to improve the future conduct of this course / training / seminar?</label>
                                <input type="text" class="form-control" id="improve_conduct" name="improve_conduct" placeholder="Your Answer" required style="border: none; border-bottom: 1px solid black;">
                            </div>
                          </div>
                        </div>

                        <div class="container">
                          <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                            <div class="form-group">
                                <label for="recommend">6. Could you recommend this course / training / seminar to your colleagues?</label>
                                <input type="text" class="form-control" id="recommend" name="recommend" placeholder="Your Answer" required style="border: none; border-bottom: 1px solid black;">
                            </div>
                          </div>
                        </div>

                        <div class="container">
                          <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                            <div class="form-group">
                                <label for="result_participation">7. Please list three (3) things that you intend to do as a result of your participation in this course / training / seminar</label>
                                <input type="text" class="form-control" id="result_participation" name="result_participation" placeholder="Your Answer" required style="border: none; border-bottom: 1px solid black;">
                            </div>
                          </div>
                        </div>

                        <div class="container">
                          <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                            <div class="form-group">
                                <label for="comments">8. Comments and / or Suggestions.</label>
                                <input type="text" class="form-control" id="comments" name="comments" placeholder="Your Answer" required style="border: none; border-bottom: 1px solid black;">
                            </div>
                          </div>
                        </div>
                        <button id="backBtn4" class="btn" style="background-color: #3E5F8C; color: white;">Back</button>
                        <button id="nextBtn4" class="btn" style="background-color: #3E5F8C; color: white;">Next</button>
                      </div>

                      <div class="carousel-item" id="slide5">
                        <div class="container">
                          <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                            <h3>RESOURCE PERSON / TRAINER EVALUATION - [Name of Resource Person]</h3>
                            <p>
                            Instruction: Please rate each item below based on a 5-1 scale (5 being the highest and 1 the lowest) 
                            </p>
                          </div>
                        </div>

                        <div class="container">
                          <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                            <h3>I. MASTERY OF THE SUBJECT MATTER</h3>
                            <p>1. Knowledge about the subject matter</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question19" id="question19-1" value="1" required>
                              <label class="form-check-label" for="question19-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question19" id="question19-2" value="2">
                              <label class="form-check-label" for="question19-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question19" id="question19-3" value="3">
                              <label class="form-check-label" for="question19-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question19" id="question19-4" value="4">
                              <label class="form-check-label" for="question19-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question19" id="question19-5" value="5">
                              <label class="form-check-label" for="question19-5">5</label>
                            </div>

                            <p>2. Presents topics in a well-organized manner</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question20" id="question20-1" value="1" required>
                              <label class="form-check-label" for="question20-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question20" id="question20-2" value="2">
                              <label class="form-check-label" for="question20-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question20" id="question20-3" value="3">
                              <label class="form-check-label" for="question20-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question20" id="question20-4" value="4">
                              <label class="form-check-label" for="question20-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question20" id="question20-5" value="5">
                              <label class="form-check-label" for="question20-5">5</label>
                            </div>

                            <p>3. Injects current developments relevant to the course / training</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question21" id="question21-1" value="1" required>
                              <label class="form-check-label" for="question21-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question21" id="question21-2" value="2">
                              <label class="form-check-label" for="question21-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question21" id="question21-3" value="3">
                              <label class="form-check-label" for="question21-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question21" id="question21-4" value="4">
                              <label class="form-check-label" for="question21-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question21" id="question21-5" value="5">
                              <label class="form-check-label" for="question21-5">5</label>
                            </div>

                            <p>4. Uses notes wisely</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question22" id="question22-1" value="1" required>
                              <label class="form-check-label" for="question22-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question22" id="question22-2" value="2">
                              <label class="form-check-label" for="question22-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question22" id="question22-3" value="3">
                              <label class="form-check-label" for="question22-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question22" id="question22-4" value="4">
                              <label class="form-check-label" for="question22-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question22" id="question22-5" value="5">
                              <label class="form-check-label" for="question22-5">5</label>
                            </div>
                          </div>
                        </div>

                        <div class="container">
                          <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                            <h3>II. INSTRUCTIONAL METHODOLOGY</h3>
                            <p>1. Able to explain theories and concepts clearly</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question23" id="question23-1" value="1" required>
                              <label class="form-check-label" for="question23-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question23"_1 id="question23-2" value="2">
                              <label class="form-check-label" for="question23-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question23" id="question23-3" value="3">
                              <label class="form-check-label" for="question23-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question23" id="question23-4" value="4">
                              <label class="form-check-label" for="question23-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question23" id="question23-5" value="5">
                              <label class="form-check-label" for="question23-5">5</label>
                            </div>

                            <p>2. Gives adequate exercises / assignments</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question24" id="question24-1" value="1" required>
                              <label class="form-check-label" for="question24-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question24" id="question24-2" value="2">
                              <label class="form-check-label" for="question24-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question24" id="question24-3" value="3">
                              <label class="form-check-label" for="question24-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question24" id="question24-4" value="4">
                              <label class="form-check-label" for="question24-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question24" id="question24-5" value="5">
                              <label class="form-check-label" for="question24-5">5</label>
                            </div>

                            <p>3. Utilizes instructional materials effectively</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question25" id="question25-1" value="1" required>
                              <label class="form-check-label" for="question25-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question25" id="question25-2" value="2">
                              <label class="form-check-label" for="question25-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question25" id="question25-3" value="3">
                              <label class="form-check-label" for="question25-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question25" id="question25-4" value="4">
                              <label class="form-check-label" for="question25-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question25" id="question25-5" value="5">
                              <label class="form-check-label" for="question25-5">5</label>
                            </div>

                            <p>4. Encourages participants to raise questions</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question26" id="question26-1" value="1" required>
                              <label class="form-check-label" for="question26-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question26" id="question26-2" value="2">
                              <label class="form-check-label" for="question26-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question26" id="question26-3" value="3">
                              <label class="form-check-label" for="question26-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question26" id="question26-4" value="4">
                              <label class="form-check-label" for="question26-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question26" id="question26-5" value="5">
                              <label class="form-check-label" for="question26-5">5</label>
                            </div>

                            <p>5. Makes use of time efficiently</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question27" id="question27-1" value="1" required>
                              <label class="form-check-label" for="question27-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question27" id="question27-2" value="2">
                              <label class="form-check-label" for="question27-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question27" id="question27-3" value="3">
                              <label class="form-check-label" for="question27-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question27" id="question27-4" value="4">
                              <label class="form-check-label" for="question27-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question27" id="question27-5" value="5">
                              <label class="form-check-label" for="question27-5">5</label>
                            </div>
                          </div>
                        </div>

                        <div class="container">
                          <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                            <h3>III. COMMUNICATIONS SKILLS</h3>
                            <p>1. Projects a clear and audible voice</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question28" id="question28-1" value="1" required>
                              <label class="form-check-label" for="question28-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question28" id="question28-2" value="2">
                              <label class="form-check-label" for="question28-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question28" id="question28-3" value="3">
                              <label class="form-check-label" for="question28-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question28" id="question28-4" value="4">
                              <label class="form-check-label" for="question28-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question28" id="question28-5" value="5">
                              <label class="form-check-label" for="question28-5">5</label>
                            </div>

                            <p>2. Expresses his / her ideas clearly, fluently, and spontaneously</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question29" id="question29-1" value="1" required>
                              <label class="form-check-label" for="question29-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question29" id="question29-2" value="2">
                              <label class="form-check-label" for="question29-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question29" id="question29-3" value="3">
                              <label class="form-check-label" for="question29-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question29" id="question29-4" value="4">
                              <label class="form-check-label" for="question29-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question29" id="question29-5" value="5">
                              <label class="form-check-label" for="question29-5">5</label>
                            </div>
                          </div>
                        </div>

                        <div class="container">
                          <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                            <h3>IV. CLASS / CLASSROOM MANAGEMENT</h3>
                            <p>1. Able to inspire and maintain the participant’s interest</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question30" id="question30-1" value="1" required>
                              <label class="form-check-label" for="question30-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question30" id="question30-2" value="2">
                              <label class="form-check-label" for="question30-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question30" id="question30-3" value="3">
                              <label class="form-check-label" for="question30-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question30" id="question30-4" value="4">
                              <label class="form-check-label" for="question30-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question30" id="question30-5" value="5">
                              <label class="form-check-label" for="question30-5">5</label>
                            </div>

                            <p>2. Willingness to help in the participant’s course / training related problems</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question31" id="question31-1" value="1" required>
                              <label class="form-check-label" for="question31-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question31" id="question31-2" value="2">
                              <label class="form-check-label" for="question31-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question31" id="question31-3" value="3">
                              <label class="form-check-label" for="question31-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question31" id="question31-4" value="4">
                              <label class="form-check-label" for="question31-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question31" id="question31-5" value="5">
                              <label class="form-check-label" for="question31-5">5</label>
                            </div>

                            <p>3. Open to criticism and gives / accepts alternative</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question32" id="question32-1" value="1" required>
                              <label class="form-check-label" for="question32-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question32" id="question32-2" value="2">
                              <label class="form-check-label" for="question32-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question32" id="question32-3" value="3">
                              <label class="form-check-label" for="question32-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question32" id="question32-4" value="4">
                              <label class="form-check-label" for="question32-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question32" id="question32-5" value="5">
                              <label class="form-check-label" for="question32-5">5</label>
                            </div>

                            <p>4. Able to maintain class / classroom discipline and control</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question33" id="question33-1" value="1" required>
                              <label class="form-check-label" for="question33-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question33" id="question33-2" value="2">
                              <label class="form-check-label" for="question33-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question33" id="question33-3" value="3">
                              <label class="form-check-label" for="question33-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question33" id="question33-4" value="4">
                              <label class="form-check-label" for="question33-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question33" id="question33-5" value="5">
                              <label class="form-check-label" for="question33-5">5</label>
                            </div>
                          </div>
                        </div>

                        <div class="container">
                          <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                            <h3>V. PERSONAL QUALITIES</h3>
                            <p>1. Follows the time duration (class hours)</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question34" id="question34-1" value="1" required>
                              <label class="form-check-label" for="question34-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question34" id="question34-2" value="2">
                              <label class="form-check-label" for="question34-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question34" id="question3\4-3" value="3">
                              <label class="form-check-label" for="question34-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question34" id="question34-4" value="4">
                              <label class="form-check-label" for="question34-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question34" id="question34-5" value="5">
                              <label class="form-check-label" for="question34-5">5</label>
                            </div>

                            <p>2. Dresses neatly and appropriately</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question35" id="question35-1" value="1" required>
                              <label class="form-check-label" for="question35-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question35" id="question35-2" value="2">
                              <label class="form-check-label" for="question35-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question35" id="question35-3" value="3">
                              <label class="form-check-label" for="question35-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question35" id="question35-4" value="4">
                              <label class="form-check-label" for="question35-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question35" id="question35-5" value="5">
                              <label class="form-check-label" for="question35-5">5</label>
                            </div>

                            <p>3. Courteous in answering the participant’s questions / queries</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question36" id="question36-1" value="1" required>
                              <label class="form-check-label" for="question36-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question36" id="question36-2" value="2">
                              <label class="form-check-label" for="question36-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question36" id="question36-3" value="3">
                              <label class="form-check-label" for="question36-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question36" id="question36-4" value="4">
                              <label class="form-check-label" for="question36-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question36" id="question36-5" value="5">
                              <label class="form-check-label" for="question36-5">5</label>
                            </div>

                            <p>4. Projects image of authority</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question37" id="question37-1" value="1" required>
                              <label class="form-check-label" for="question37-1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question37" id="question37-2" value="2">
                              <label class="form-check-label" for="question37-2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question37" id="question37-3" value="3">
                              <label class="form-check-label" for="question37-3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question37" id="question37-4" value="4">
                              <label class="form-check-label" for="question37-4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question37" id="question37-5" value="5">
                              <label class="form-check-label" for="question37-5">5</label>
                            </div>
                          </div>
                        </div>

                        <div class="container">
                          <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                            <div class="form-group">
                                <label for="other_comment">OTHER COMMENTS</label>
                                <input type="text" class="form-control" id="other_comment" name="other_comment" placeholder="Your Answer" required style="border: none; border-bottom: 1px solid black;">
                            </div>
                          </div>
                        </div>

                        <div class="container">
                          <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                            <h6>THANK YOU !</h6>
                            <p>
                            Thank you for your feedback. What you shared with us valuable and will help us improve our service. See you on our next training. Have a nice day! 
                            </p>
                          </div>
                        </div>
                        <button id="backBtn5" class="btn" style="background-color: #3E5F8C; color: white;">Back</button>
                        <button type="submitBtn" class="btn" id="submitBtn" name="assessment_btn" style="background-color: #3E5F8C; color: white;"><i class="fas fa-paper-plane" hidden></i> Submit </button>
                      </div>    

                      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      
                </form>
            </div>
        </div>
    </div>

    <?php
        include('../includes/footer.php');
    ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-MDEwMzUzMzU0NzJhYjgxZjVjNTU5OTcyMzJjMzA5ODdjNmE2MjAxZmRjZWUxNjZm" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
  // Hide the "Back" button and the "Submit" button initially
  $("#backBtn").hide();
  $("#submitBtn").hide();
  
  // Show the "Next" button on the first slide
  $("#nextBtn1").show();
  
  // Handle the "Next" button on the first slide
  $("#nextBtn1").click(function() {

    //Check if the input is empty
    if($("#email").val() == ""){
      return;
    }
    if(!$("#defaultCheck1").is(":checked")){
      return;
    }

    // Hide the first slide
    $(".active").hide().removeClass("active");
    
    // Show the next slide
    $(".carousel-item").eq(1).show().addClass("active");
    
    // Show the "Next" and "Back" buttons on the second slide
    $("#nextBtn2").show();
    $("#backBtn2").show();
  });
  
  $("#nextBtn2").click(function() {
    // Hide the current slide
    $(".active").hide().removeClass("active");
    
    // Show the next slide
    $(".carousel-item").eq(2).show().addClass("active");
    
    // Show the "Next" and "Back" buttons on the fourth slide
    $("#backBtn3").show();
  });
  
  // Handle the "Next" button on the third slide
  $("#nextBtn3").click(function() {

    //Check if the input is empty
    if(($("#l_name").val() == "") || ($("#f_name").val() == "") || ($("#province").val() == "") || ($("#region option:selected").val() == "") || ($("#age option:selected").val() == "") || ($("#gender option:selected").val() == "") || ($("#citizenship").val() == "") || ($("#certificate_name").val() == "")  || ($("#certificate_email").val() == "")){
      return;
    }

    // Hide the current slide
    $(".active").hide().removeClass("active");

    // Show the next slide
    $(".carousel-item").eq(3).show().addClass("active");
    
    // Show the "Next" and "Back" buttons on the fourth slide
    $("#backBtn4").show();
    
  });

  $("#nextBtn4").click(function() {

    //Check if the input is empty
    var questions = [ "question1", "question2", "question3", "question4", "question5", "question6", "question7", "question8", "question9", "question10", "question11", "question12", "question13", "question14", "question15", "question16", "question17", "question18"];

    for (var i = 0; i < questions.length; i++) {
      if ($('input[name="'+questions[i]+'"]:checked').length === 0) {
        return;
      }
    }

    if (($("#most_useful").val() == "") || ($("#least_useful").val() == "") || ($("#spent_more").val() == "") || ($("#spent_less").val() == "") || ($("#improve_conduct").val() == "") || ($("#recommend").val() == "") || ($("#result_participation").val() == "") || ($("#comments").val() == "")){
      return;
    }

    // Hide the current slide
    $(".active").hide().removeClass("active");
    
    // Show the next slide
    $(".carousel-item").eq(4).show().addClass("active");
    
    // Show the "Next" and "Back" buttons on the fourth slide
    $("#submitBtn").show();
    $("#backBtn5").show();
  });
  
    // Handle the "Back" button on the second slide
  $("#backBtn2").click(function() {
    // Hide the current slide
    $(".active").hide().removeClass("active");
    
    // Show the previous slide
    $(".carousel-item").eq(0).show().addClass("active");
    
    // Hide the "Back" button on the first slide
    
    // Show the "Next" button on the first slide
    $("#nextBtn1").show();
  });

  // Handle the "Back" button on the second slide
  $("#backBtn3").click(function() {
    // Hide the current slide
    $(".active").hide().removeClass("active");
    
    // Show the previous slide
    $(".carousel-item").eq(1).show().addClass("active");
    
    // Hide the "Back" button on the first slide
    
    // Show the "Next" button on the first slide
    $("#nextBtn2").show();
  });

  // Handle the "Back" button on the second slide
  $("#backBtn4").click(function() {
    // Hide the current slide
    $(".active").hide().removeClass("active");
    
    // Show the previous slide
    $(".carousel-item").eq(2).show().addClass("active");
    
    // Hide the "Back" button on the first slide
    
    // Show the "Next" button on the first slide
    $("#nextBtn3").show();
  });
  
  // Handle the "Back" button on the second slide
  $("#backBtn5").click(function() {
    // Hide the current slide
    $(".active").hide().removeClass("active");
    
    // Show the previous slide
    $(".carousel-item").eq(3).show().addClass("active");
    
    // Hide the "Back" button on the first slide
    
    // Show the "Next" button on the first slide
    $("#nextBtn4").show();
  });
});

</script>

<?php
        include('../includes/header.php');

        if (!isset($_GET['webinar_id'])) {
            // Redirect the user to the webinar list page
            header('location: 404.php');
            exit();
        }

        // Get the webinar_id parameter from the query string
        $webinar_id = $_GET['webinar_id'];
    ?>

    <div class="container" style="max-width: 900px;">
        <div class="card shadow">
            <div class="card-header">
                <h1 class="my-4">Assessment Form</h1>
            </div>
            <div class="card-body">
                <form method="POST" action="../config/submit_assessment.php">
                    <!-- Add a hidden input field for webinar_id -->
                    <input type="hidden" name="webinar_id" value="<?php echo $webinar_id; ?>">

                    <div class="container">
                      <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                        <h1>IMPORTANT! </h1>
                        <div class="form-group">
                          <label for="email"><i class="fas fa-envelope"></i> Email:</label>
                          <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                      </div>
                    </div>
    
                    <div class="container">
                      <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                        <h1>Evaluation Form</h1>
                        <p>
                          Thank you for attending our webinar /course / training.  For you to be able to receive your e-certificate you must complete this Evaluation Form.  If there are any other completion requirements make sure you have also submitted them. You will receive an email with the link where you can download your e-certificates.
                          For Premium and Free webinars: Your certificates may be downloaded from a link provided by an email from ilcdb_training4@dict.gov.ph or ilcdb.registrar@dict.gov.ph 4-6 weeks after the webinar.
                          For EDP Eligibility courses: Your certificates should be claimed personally at the Registrar's Office.  Please email the Registrar to know it the certificates are available at ilcdb.registrar@dict.gov.ph. If the Registrar's Office confirmed that your certificates are available, CLAIMING days for your certificates are TUESDAYS AND THURSDAY 9:00 AM until 12:00 NN ONLY.
                        </p>
                      </div>
                    </div>

                    <div class="container">
                      <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                        <h3>Important:</h3><br>
                        <p>
                          Per Section 2(Declaration of Policy) of the Data Privacy Act of 2012, it is the policy of the State to protect the fundamental human right of privacy, of communication while ensuring free flow of information to promote innovation and growth. The State recognizes the vital role of information and communications technology in nation-building and its inherent obligation to ensure that personal information in information and communications systems in the government and in the private sector are secured and protected.
                          As such, information collected from this form shall be held in strict confidence and shall only be used solely for records keeping purposes.
                          Falsification of any of the given information will automatically bar applicant from any ILCDB Course.
                          Participants should attend 100% of the session to receive a certificate.
                        </p>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="agreement" required>
                          <label class="form-check-label" for="defaultCheck1">
                            I agree
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="container">
                      <div class="form-group shadow p-3 mb-5 bg-white rounded border">
                        <h3>
                        TITLE OF TRAINING / WEBINAR / COURSE
                        </h3>
                        <p>
                        ICT LITERACY AND COMPETENCY DEVELOPMENT BUREAU (ILCDBu) <br>
                        Thank you for your participation in this training / webinar / course on [title].  We would appreciate your feedback and welcome any additional comments that you may have. Your response will be used to enhance our training / webinar / course and ensure that we meet your future needs. Please provide your response to the questions listed below by clicking your choice from the options provided. We value your responses to this evaluation questions.
                        <br>
                        [Duration]; [Time]
                        </p>
                      </div>
                    </div>

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
                        <input type="text" class="form-control" id="e_name" name="e_name" required>
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
                        <option value="" selected disabled>Select age range</option>
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
                          <input class="form-check-input" type="radio" name="question1" id="question1-1" value="1">
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
                          <input class="form-check-input" type="radio" name="question2" id="question2-1" value="1">
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
                          <input class="form-check-input" type="radio" name="question3" id="question3-1" value="1">
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

                    <button type="submit" class="btn btn-primary" name="assessment_btn"><i class="fas fa-paper-plane"></i> Submit </button>
                </form>
            </div>
        </div>
    </div>

    <?php
        include('../includes/footer.php');
    ?>

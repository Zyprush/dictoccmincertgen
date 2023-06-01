<?php
include('../config/authentication.php');
include('../includes/header.php');

$webinar_id = uniqid();

echo '<script>var webinar_id = "' . $webinar_id . '";</script>';
?>

<div class="container">
  <div class="card border shadow rounded">
    <div class="card-header d-flex justify-content-between align-items-center">
      <div class="col-sm-12 col-md-6 font-weight-bold">
        Webinar Details
      </div>
      <div class="col-sm-12 col-md-6">
        <form action="../config/add-webinar.php" method="POST" onsubmit="return validateForm()">
          
        <div class="float-right">
          <button type="submit" class="btn btn-primary btn-sm" name="save_webinar">
            <i class="bi bi-file-earmark-plus"></i> Create
          </button>
          <button type="button" class="btn btn-danger btn-sm" onclick="window.history.back();">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>
        
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="webinar_title" name="webinar_title" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="date" class="form-label">Date</label>
          <input type="date" class="form-control" id="webinar_date" name="webinar_date" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="link" class="form-label">Meeting Link</label>
          <input type="url" class="form-control" id="webinar_link" name="webinar_link" required>
        </div>
      </div>

      <!-- Add a new form for displaying the generated links -->
      <div class="row">
        <div class="col-md-6 mb-3">
          <div class="mb-3">
            <label for="generated-registration-link" class="form-label">Generated Registration Form Link</label>
            <input type="url" class="form-control" id="generated-registration-link" readonly>
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div class="mb-3">
            <label for="generated-assessment-link" class="form-label">Generated Assessment Form Link</label>
            <input type="url" class="form-control" id="generated-assessment-link" readonly>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6 mb-3">
          <button type="button" id="generate-registration-link-button" class="btn btn-secondary btn-block">
            <i class="fas fa-cog"></i>
            Generate Registration
          </button>
          <div id="registration-link" style="display: none;">
            <input type="hidden" name="registration_link" id="registration_link" value="">
            <p hidden>Registration form link: <a id="registration-link-url" href=""></a></p>
          </div>
        </div>

        <div class="col-sm-6 mb-3">
          <button type="button" id="generate-assessment-link-button" class="btn btn-secondary btn-block">
            <i class="fas fa-cog"></i>
            Generate Assessment
          </button>
          <div id="assessment-link" style="display: none;">
            <input type="hidden" name="assessment_link" id="assessment_link" value="">
            <p hidden>Assessment form link: <a id="assessment-link-url" href=""></a></p>
          </div>
        </div>
      </div>

      <input type="hidden" name="webinar_id" value="<?php echo $webinar_id; ?>">
      <input type="hidden" name="status" id="status" value="0">
      </form>
    </div>
    <div class="card-footer">
      <div class="ml-auto">DICT Certificate Generator. <span>&copy;</span>2023</div>
    </div>
  </div>
</div>


<script>
  // get the button element
  var generateRegistrationLinkButton = document.querySelector('#generate-registration-link-button');
  var generateAssessmentLinkButton = document.querySelector('#generate-assessment-link-button');

  generateRegistrationLinkButton.addEventListener('click', function() {
    // generate the link (replace this with your own code to generate the link)
    var registrationLink = 'registration_form.php?webinar_id=' + webinar_id;

    // update the value of the registration_link input field
    var registrationLinkInput = document.querySelector('#registration_link');
    registrationLinkInput.value = registrationLink;
    // display the link and update the href attribute of the <a> element
    var registrationLinkDiv = document.querySelector('#registration-link');
    var registrationLinkUrl = document.querySelector('#registration-link-url');
    registrationLinkUrl.href = registrationLink;
    registrationLinkUrl.innerHTML = registrationLink;
    registrationLinkDiv.style.display = 'block';

    // display the generated link in the separate form
    var generatedRegistrationLinkInput = document.querySelector('#generated-registration-link');
    generatedRegistrationLinkInput.value = registrationLink;
  });

  generateAssessmentLinkButton.addEventListener('click', function() {
    // generate the link (replace this with your own code to generate the link)
    var assessmentLink = 'assessment_form.php?webinar_id=' + webinar_id;

    // update the value of the assessment_link input field
    var assessmentLinkInput = document.querySelector('#assessment_link');
    assessmentLinkInput.value = assessmentLink;
    // display the link and update the href attribute of the <a> element
    var assessmentLinkDiv = document.querySelector('#assessment-link');
    var assessmentLinkUrl = document.querySelector('#assessment-link-url');
    assessmentLinkUrl.href = assessmentLink;
    assessmentLinkUrl.innerHTML = assessmentLink;
    assessmentLinkDiv.style.display = 'block';

    // display the generated link in the separate form
    var generatedAssessmentLinkInput = document.querySelector('#generated-assessment-link');
    generatedAssessmentLinkInput.value = assessmentLink;
  });

  function validateForm() {
    var registrationLink = document.getElementById('registration_link').value;
    var assessmentLink = document.getElementById('assessment_link').value;

    if (registrationLink === '' || assessmentLink === '') {
      alert('Registration link and assessment link are required!');
      return false; // Prevent form submission
    }

    return true; // Proceed with form submission
  }
</script>

<?php
include('../includes/footer.php');
?>

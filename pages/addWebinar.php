<?php
  include('../config/authentication.php');
  include('../includes/header.php');

  $webinar_id = uniqid();
  echo '<script>var webinar_id = "' . $webinar_id . '";</script>';
?>

<div class="container">
  <div class="card shadow">
    <div class="card-header">
      <h1 class="my-4">Add Webinar Event</h1>
      <h3 class="my-4">Webinar Details</h3>
    </div>
    <div class="card-body">
      <form action="../config/code.php" method="POST">
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="webinar_title" name="webinar_title" required>
        </div>

        <div class="mb-3">
          <label for="date" class="form-label">Date</label>
          <input type="date" class="form-control" id="webinar_date" name="webinar_date" required>
        </div>

        <div class="mb-3">
          <label for="link" class="form-label">Meeting Link</label>
          <input type="url" class="form-control" id="webinar_link" name="webinar_link" required>
        </div>

        <div class="row">
          <div class="col-sm-6 mb-3">
            <button type="button" id="generate-registration-link-button" class="btn btn-secondary btn-block">Generate Registration Form Link</button>
            <div id="registration-link" style="display: none;">
              <input type="hidden" name="registration_link" id="registration_link" value="">
              <p>Registration form link: <a id="registration-link-url" href=""></a></p>
            </div>
          </div>

          <div class="col-sm-6 mb-3">
            <button type="button" id="generate-assessment-link-button" class="btn btn-secondary btn-block">Generate Assessment Form Link</button>
            <div id="assessment-link" style="display: none;">
              <input type="hidden" name="assessment_link" id="assessment_link" value="">
              <p>Assessment form link: <a id="assessment-link-url" href=""></a></p>
            </div>
          </div>
        </div>
        <input type="hidden" name="webinar_id" value="<?php echo $webinar_id; ?>">
        <div class="row">
          <div class="col-sm-6 mb-3">
            <button type="submit" class="btn btn-primary btn-block" name="save_webinar">Submit</button>
          </div>
          <div class="col-sm-6 mb-3">
            <button type="button" class="btn btn-danger btn-block" onclick="window.location.href = 'webinarlist.php'">Cancel</button>
          </div>
        </div>
      </form>
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
  });

</script>

<?php
    include('../includes/footer.php');
?>
 
<?php
  include('../config/authentication.php');
  include('../includes/header.php');
  require('../vendor/autoload.php');

  $webinar_id = $_GET['id'];

  use setasign\Fpdi\Fpdi;

  try {
    // Check if the selected attendees data was passed in the POST request
    if (isset($_POST['attendees'])) {
      // Get the selected attendees' name and email from the $_POST superglobal
      $selectedAttendees = json_decode($_POST['attendees']);

      // Check if selected attendees data is not null
      if ($selectedAttendees != null) {
        
        // Check if the certificates directory exists, if not create it
        $folderPath = '../certificates/' . $webinar_id;
        if (!file_exists($folderPath)) {
          mkdir($folderPath, 0777, true);
        }

        // Get the template file
        $template = '../certificates-temp/certgen-temp.pdf';

        // Create a new FPDI object
        $pdf = new Fpdi();

        foreach ($selectedAttendees as $attendee) {
          // Add a new page
          $pdf->AddPage('L');
          // Set the source file
          $pdf->setSourceFile($template);
          // Import the first page of the template
          $tplIdx = $pdf->importPage(1);
          // Use the imported page as the template
          $pdf->useTemplate($tplIdx);

          // Add the name
          $pdf->SetFont('Arial', 'B', 34);
          $pdf->SetXY(100, 102);
          $pdf->Cell(0, 0, htmlspecialchars($attendee->certificate_name, ENT_QUOTES));

          // Get the modified PDF template as a string
          $output = $pdf->Output('', 'S');

          // Set the filename as the attendee's email address
          $filename = $folderPath . '/' . str_replace(' ', '_', htmlspecialchars($attendee->certificate_email, ENT_QUOTES)) . '.pdf';

          // Output the modified PDF template to the file
          file_put_contents($filename, $output);

          // Reset the FPDI object for the next iteration
          $pdf = new Fpdi();
        }

        $completedCertificates = array();
        foreach ($selectedAttendees as $attendee) {
          $certificate = array(
            'name' => $attendee->certificate_name,
            'email' => $attendee->certificate_email,
            'path' => $folderPath . '/' . str_replace(' ', '_', htmlspecialchars($attendee->certificate_email, ENT_QUOTES)) . '.pdf'
          );
          $completedCertificates[] = $certificate;
        }

      } else {
        echo '<p>No attendees selected.</p>';
      }
    } else {
      throw new Exception('Invalid request.');
    }
  } catch (Exception $e) {
    echo "Error: " . htmlspecialchars($e->getMessage(), ENT_QUOTES);
  }
?>
<link rel="stylesheet" href="../assets/css/loading.css">
<link rel="stylesheet" href="../assets/css/emailsending.css">

<!-- Loading overlay -->
<div id="loading-overlay">
  <div class="d-flex flex-column align-items-center">
    <div class="spinner-border text-primary" role="status"></div>
    <p style="color: white;">Email is sending, please do not close or reload the page.</p>
  </div>
</div>

  
<div style="display: none;" id="email-message">
  <div class="card border shadow custom-card-width">
    <div class="card-header">
      Email Message
      <span class="close-icon">&times;</span>
    </div>
    <div class="card-body">
      <form id="email-form" method="post" action="../config/emailed.php">
        <!-- Add the selected attendees as a hidden field -->
        <input type="hidden" name="selectedAttendees" value='<?php echo json_encode($selectedAttendees); ?>'>

        <!-- Add the completed certificates as a hidden field -->
        <input type="hidden" name="completedCertificates" value='<?php echo json_encode($completedCertificates); ?>'>

        <!-- Add the folder path as a hidden field -->
        <input type="hidden" name="folderPath" value='<?php echo $folderPath; ?>'>

        <!-- Add the folder path as a hidden field -->
        <input type="hidden" name="webinar_id" value='<?php echo $webinar_id; ?>'>

        <div class="form-group">
          <label for="subject">Subject:</label>
          <input type="text" class="form-control" id="subject" name="subject" required>
        </div>
        <div class="form-group">
          <label for="message">Message:</label>
          <textarea class="form-control" id="message" name="message" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-block" id="submit-email">
          Send Email
        </button>
        
      </form>
    </div>
  </div>
</div>

<div class="card-body">
<div class="container">
  <div class="card border shadow">
    <div class="card-header">
      Completed Certificates
      <button class="btn btn-secondary btn-sm float-right" id="email-certificates-btn" disabled>
        Email Certificates
        <i class="fas fa-cog"></i>
      </button>
      <button class="btn btn-secondary btn-sm float-right mr-2" id="select-all-btn" onclick="toggleSelectAll()">
        Select All
      </button>
    </div>
    <div class="card-body">
      <form id="#" method="#" action="#">
        <input type="hidden" id="#" name="#" value="">
      </form>
      <table class="table table-hover" id="certificatesTable">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>View</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach ($completedCertificates as $certificate) { ?>
              <tr>
                <td><?php echo htmlspecialchars($certificate['name'], ENT_QUOTES); ?></td>
                <td><?php echo htmlspecialchars($certificate['email'], ENT_QUOTES); ?></td>
                <td><a href="<?php echo $certificate['path']; ?>" target="_blank">View</a></td>
              </tr>
            <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>

<script src="../assets/js/loading.js"></script>

<?php include('../includes/footer.php'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

<script>
  var selectAll = false;
  var table;

  function toggleSelectAll() {
    selectAll = !selectAll;
    if (selectAll) {
      table.rows().select();
      $('#select-all-btn').text('Deselect All');
    } else {
      table.rows().deselect();
      $('#select-all-btn').text('Select All');
    }
    toggleEmailButton();
  }

  function toggleEmailButton() {
    var selectedRows = table.rows({ selected: true }).count();
    if (selectedRows > 0) {
      $('#email-certificates-btn').prop('disabled', false);
    } else {
      $('#email-certificates-btn').prop('disabled', true);
    }
  }

  $(document).ready(function() {
    table = $('#certificatesTable').DataTable({
      // Set your DataTables options here
      select: true
    });

    table.on('select deselect', function() {
      toggleEmailButton();
    });
  });

  //Email certificates button
  $('#email-certificates-btn').on('click', function() {
      // Display the PDF upload form
      $('#email-message').show();
      document.getElementById('email-message').style.display = 'flex';
    });
  // Hide the upload form
  function hideUploadForm() {
      document.getElementById('email-message').style.display = 'none';
    }

    // Attach event listener to the close icon
    document.querySelector('#email-message .close-icon').addEventListener('click', function (event) {
      event.preventDefault();
      hideUploadForm();
    });
    $('#submit-email').on('click', function() {
      hideUploadForm();
    });
</script>
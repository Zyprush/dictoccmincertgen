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

<!-- Loading overlay -->
<div id="loading-overlay">
  <div class="loading-spinner"></div>
</div>

<div class="card-body">

<div class="container">
  <div class="card border shadow">
    <div class="card-header">
      Email Content
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
        <button type="submit" class="btn btn-primary">Send Email</button>
      </form>
    </div>
  </div>
</div>

</div>

<script src="../assets/js/loading.js"></script>

<?php include('../includes/footer.php'); ?>
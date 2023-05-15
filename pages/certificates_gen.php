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
        $template = '../assets/templates/cert-template.pdf';

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

          // Replace <<Name>> tag with attendee's name
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

        echo '<h1>Certificates generated successfully.</h1>'; 
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

<?php
    include('../includes/footer.php');
?>
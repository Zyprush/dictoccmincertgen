<?php
  include('../config/authentication.php');
  include('../includes/header.php');
  require_once '../PHPPresentation-develop/src/PhpOffice/PhpPresentation/Autoloader.php';
  \PhpOffice\PhpPresentation\Autoloader::register();

  use PhpOffice\PhpPresentation\PhpPresentation;
  use PhpOffice\PhpPresentation\IOFactory;

  try {
    // Check if the selected attendees data was passed in the POST request
    if (isset($_POST['attendees'])) {
      // Get the selected attendees' name and email from the $_POST superglobal
      $selectedAttendees = json_decode($_POST['attendees']);

      // Check if selected attendees data is not null
      if ($selectedAttendees != null) {
        // Check if the certificates directory exists, if not create it
        if (!file_exists('../certificates')) {
          mkdir('../certificates', 0777, true);
        }

        // Get the template file
        $template = '../assets/templates/cert-template.pptx';

        foreach ($selectedAttendees as $attendee) {
          // Load the PowerPoint template
          $pptx = IOFactory::load($template);

          // Find and replace the <<Name>> tag with the attendee's name
          $slides = $pptx->getAllSlides();
          foreach ($slides as $slide) {
            $shapeCollection = $slide->getShapeCollection();
            foreach ($shapeCollection as $shape) {
              if ($shape instanceof \PhpOffice\PhpPresentation\Slide\Shape\RichText) {
                $shape->createTextRun(str_replace('<<Name>>', $attendee->certificate_name, $shape->getText()));
              }
            }
          }

          // Set the filename as the attendee's email address
          $filename = '../certificates/' . str_replace(' ', '_', htmlspecialchars($attendee->certificate_email, ENT_QUOTES)) . '.pdf';

          // Save the modified PowerPoint slide as PDF
          $pdfWriter = IOFactory::createWriter($pptx, 'PDF');
          $pdfWriter->save($filename);

          echo '<p>Certificates generated successfully.</p>'; 
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

  include('../includes/footer.php');
?>

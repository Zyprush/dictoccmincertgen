<?php
  require_once('dbcon.php');

  $webinar_id = $_GET['id'];
  $ref_table_assessments = 'assessments/' . $webinar_id;
  $fetchdata = $database->getReference($ref_table_assessments)->getValue();

  $attendees = array();

  if(is_array($fetchdata) && count($fetchdata) > 0) {
    foreach($fetchdata as $key => $row) {
      $attendee = array(
        'certificate_name' => $row['certificate_name'],
        'certificate_email' => $row['certificate_email']
      );
      array_push($attendees, $attendee);
    }
  }

  echo json_encode($attendees);
?>

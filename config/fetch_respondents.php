<?php

include('../config/dbcon.php');

$ref_table = 'assessments';
$fetchdata = $database->getReference($ref_table)->getValue();

$data = array();

if (!empty($fetchdata)) {
  foreach ($fetchdata as $webinar_id => $webinar) {
    foreach ($webinar as $registration_id => $registration) {
      $data[] = array(
        'webinar_id' => $webinar_id,
        'certificate_name' => $registration['certificate_name'],
        'certificate_email' => $registration['certificate_email']
      );
    }
  }
}

echo json_encode(array('data' => $data));

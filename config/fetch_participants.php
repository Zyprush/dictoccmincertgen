<?php

include('../config/dbcon.php');

$ref_table = 'participants';
$fetchdata = $database->getReference($ref_table)->getValue();

$data = array();

if (!empty($fetchdata)) {
  foreach ($fetchdata as $webinar_id => $webinar) {
    foreach ($webinar as $registration_id => $registration) {
      $data[] = array(
        'webinar_id' => $webinar_id,
        'name' => $registration['name'],
        'email' => $registration['email'],
        'student_id' => $registration['student_id'],
        'school' => $registration['school'],
        'organization' => $registration['organization'],
        'program' => $registration['program'],
        'position' => $registration['position']
      );
    }
  }
}

echo json_encode(array('data' => $data));

<?php

include('dbcon.php');

$type = $_GET['type'];

if ($type == 'webinar') {
  $ref_table = 'webinars';
  $total_count = $database->getReference($ref_table)->getSnapshot()->numChildren();
  echo $total_count;
} else if ($type == 'participant') {
  $ref_table = 'participants';
  $total_count = 0;
  $fetchdata = $database->getReference($ref_table)->getValue();

  if (!empty($fetchdata)) {
    foreach ($fetchdata as $webinar) {
      $total_count += count($webinar);
    }
  } 

  echo $total_count;
} else if ($type == 'pending') {
  $ref_table = 'webinars';
  $pending_count = 0;
  $webinars = $database->getReference($ref_table)->getValue();

  if (!empty($webinars)) {
    foreach ($webinars as $webinar) {
      if ($webinar['status'] == 0) {
        $pending_count++;
      }
    }
  }

  echo $pending_count;
}

?>

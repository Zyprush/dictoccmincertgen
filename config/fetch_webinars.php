<?php

require_once('dbcon.php');

// Get data from the 'webinars' node in Firebase Realtime Database
$ref_table = 'webinars';
$fetchdata = $database->getReference($ref_table)->getValue();

// Create an array to store the webinar data
$data = array();

// Loop through the webinar data and add each record to the array
if(is_array($fetchdata) && count($fetchdata) > 0) {
    foreach($fetchdata as $key => $row) {
        if(isset($row['webinar_id'])) {
            $id = $row['webinar_id'];
        } else {
            $id = $key;
        }
        //participant counting ...
        $participants_count = 0;
        $ref_table_participants = 'assessments/' . $id;
        $participants_data = $database->getReference($ref_table_participants)->getValue();
        if ($participants_data) {
            $participants_count = count($participants_data);
        }

        $data[] = array(
            'id' => $id,
            'title' => $row['webinar_title'],
            'date' => $row['webinar_date'],
            'participants_count' => $participants_count,
            'status' => $row['status']
        );
    }            
}

// Create an array that contains the data array
$result = array(
    'data' => $data
);

// Encode the result in JSON format and return it
echo json_encode($result);

?>

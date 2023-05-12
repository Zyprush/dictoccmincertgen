<?php
include ('dbcon.php');
$ref_table = 'webinars';
$webinars = $database->getReference($ref_table)->getValue();
$data = array();
if ($webinars) {
    foreach ($webinars as $webinar_id => $webinar_data) {
        //participant counting ...
        $participants_count = 0;
        $ref_table_participants = 'participants/' . $webinar_id;
        $participants_data = $database->getReference($ref_table_participants)->getValue();

        if ($participants_data) {
            $participants_count = count($participants_data);
        }

        //assessment counting ...
        $assessments_count = 0;
        $ref_table_assessments = 'assessments/' . $webinar_id;
        $assessments_data = $database->getReference($ref_table_assessments)->getValue();

        if ($assessments_data) {
            $assessments_count = count($assessments_data);
        }

        $data[] = array(
            "webinar_id" => $webinar_id,
            "webinar_title" => $webinar_data['webinar_title'],
            "webinar_date" => $webinar_data['webinar_date'],
            "participants_count" => $participants_count,
            "assessments_count" => $assessments_count,
            "status" => $webinar_data['status']
        );
    }
}

$result = array(
    'data' => $data
);

echo json_encode($result);
?>

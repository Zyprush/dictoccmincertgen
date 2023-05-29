<?php
include('dbconfig.php');

$webinar_id = $_GET['id'];
$sql = "SELECT * FROM assessments Where webinar_id = '$webinar_id'";
$result = $conn->query($sql);

$questions = array(
    'most_useful' => "What did you find most useful in this course / training / seminar?",
    'least_useful' => "What did you find least useful in this course / training / seminar?",
    'spent_more' => "On which topics, if any, would you rather have spent more time?",
    'spent_less' => "On which topics, if any, would you rather have spent less time?",
    'improve_conduct' => "What advice can you give to improve the future conduct of this course / training / seminar?",
    'recommend' => "Could you recommend this course / training / seminar to your colleagues?",
    'result_participation' => "Please list three (3) things that you intend to do as a result of your participation in this course / training / seminar.",
    'comments' => "Comments and/or Suggestions.",
    'other_comment' => "Other Comments"
);
?>

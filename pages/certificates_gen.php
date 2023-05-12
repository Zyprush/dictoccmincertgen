<?php
    include('../config/authentication.php');
    include('../includes/header.php');
    // Get the webinar ID and selected attendees' name and email from the URL parameters
    $webinar_id = $_GET['id'];
    $selectedAttendees = json_decode($_GET['attendees']);
?>

<div>
    <ul>
        <?php foreach ($selectedAttendees as $attendee) { ?>
            <li><?php echo $attendee->name . ' - ' . $attendee->email; ?></li>
        <?php } ?>
    </ul>
</div>
        
<?php
  include('../includes/footer.php');
?>
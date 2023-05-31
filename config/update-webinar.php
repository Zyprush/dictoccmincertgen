<?php
    include('dbconfig.php');
    session_start();

    if(isset($_POST['update_webinar'])) {
        $webinarID = $_POST['key'];
        $webinar_title = $_POST['webinar_title'];
        $webinar_date = $_POST['webinar_date'];
        $webinar_link = $_POST['webinar_link'];

        // Prepare the update query
        $query = "UPDATE webinars SET webinar_title = ?, webinar_date = ?, webinar_link = ? WHERE webinar_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $webinar_title, $webinar_date, $webinar_link, $webinarID);

        if($stmt->execute()) {
            $_SESSION['status'] = "Webinar Successfully Updated!";
            header('Location: ../pages/webinarlist.php');
            exit();
        } else {
            $_SESSION['status'] = "Webinar is NOT updated!";
            header('Location: ../pages/webinarlist.php');
            exit();
        }
    }
?>

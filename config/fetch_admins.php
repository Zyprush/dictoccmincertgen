<?php
    require_once 'dbconfig.php';

    $query = "SELECT * FROM certgen_users";
    $result = mysqli_query($conn, $query);

    $admins = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $admins[] = $row;
    }

    echo json_encode($admins);
?>

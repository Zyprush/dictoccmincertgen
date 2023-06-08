<?php
require_once "../config/dbconfig.php";

// Get the ID parameter from the URL
if (isset($_GET['id'])) {
    $webinar_id = $_GET['id'];

    // Fetch data from the assessments table for the specified webinar_id
    $query = "SELECT * FROM assessments WHERE webinar_id = '$webinar_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Set the headers to indicate that a CSV file is being downloaded
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $webinar_id . '.csv"');

        // Create a file pointer
        $output = fopen('php://output', 'w');

        // Write the column headers to the CSV file
        $headers = array_keys(mysqli_fetch_assoc($result));
        fputcsv($output, $headers);

        // Reset the data pointer back to the start of the result set
        mysqli_data_seek($result, 0);

        // Write the assessment data to the CSV file
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($output, $row);
        }

        // Close the file pointer
        fclose($output);
    } else {
        echo "No assessment data found for the provided ID.";
    }
} else {
    echo "No ID parameter provided.";
}

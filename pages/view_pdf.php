<?php
// Check if the file ID is provided as a query parameter
if (isset($_GET['id'])) {
    $file_id = $_GET['id'];

    // Retrieve the file data from the 'pdfile' table
    include ('../config/dbconfig.php');
    $query = "SELECT * FROM pdfile WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $file_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $file_name = $row['name'];
        $file_data = $row['data'];

        // Set the appropriate headers for PDF file display
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $file_name . '"');
        header('Content-Length: ' . strlen($file_data));

        // Output the PDF file data
        echo $file_data;
    } else {
        echo 'File not found.';
    }

    // Close the statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo 'Invalid request.';
}
?>

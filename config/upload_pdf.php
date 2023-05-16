<?php
// Check if a file was uploaded without errors
if (isset($_FILES['pdfFile']) && $_FILES['pdfFile']['error'] === UPLOAD_ERR_OK) {
    $tempFile = $_FILES['pdfFile']['tmp_name'];
    $targetDirectory = '../certificates-temp/'; // Relative path to "certificates-temp" folder
    $targetFile = $targetDirectory . 'certgen-temp.pdf';

    // Create the target directory if it doesn't exist
    if (!is_dir($targetDirectory)) {
        mkdir($targetDirectory, 0755, true);
    }

    // Move the uploaded file to the target directory with the desired name
    if (move_uploaded_file($tempFile, $targetFile)) {
        echo 'success'; // Return a success message if the file was successfully uploaded
        exit();
    }
}

// If the file upload failed or there was an error, return an error message
echo 'error';
?>

<!DOCTYPE html>
<html>
<head>
    <title>PDF Upload</title>
</head>
<body>
    <h1>Upload a PDF</h1>

    <?php
    // Check if the form was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include ('../config/dbconfig.php');

        // Create the 'pdfile' table if it doesn't exist
        $createTableQuery = "CREATE TABLE IF NOT EXISTS pdfile (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(255),
            size INT,
            data LONGBLOB
        )";
        mysqli_query($conn, $createTableQuery);

        // Check if a file was uploaded
        if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
            // Get file details
            $file_name = $_FILES['pdf']['name'];
            $file_size = $_FILES['pdf']['size'];
            $file_tmp = $_FILES['pdf']['tmp_name'];

            // Read the file data into memory
            $file_data = file_get_contents($file_tmp);

            // Prepare and execute the SQL statement
            $stmt = mysqli_prepare($conn, 'INSERT INTO pdfile (name, size, data) VALUES (?, ?, ?)');
            mysqli_stmt_bind_param($stmt, 'sis', $file_name, $file_size, $file_data);
            mysqli_stmt_execute($stmt);

            // Check if the insertion was successful
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo 'File uploaded and saved successfully.';
            } else {
                echo 'Error: Failed to save file.';
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="pdf" accept=".pdf">
        <input type="submit" value="Upload">
    </form>

    <h2>Uploaded Files</h2>
    <?php
    include ('../config/dbconfig.php');

    // Retrieve the uploaded files from the 'pdfile' table
    $query = "SELECT * FROM pdfile";
    $result = mysqli_query($conn, $query);

    // Display the uploaded files
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $file_id = $row['id'];
            $file_name = $row['name'];
            $file_size = $row['size'];

            echo "<p>$file_name ($file_size bytes) <a href='view_pdf.php?id=$file_id'>View</a></p>";
        }
    } else {
        echo "No files uploaded yet.";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>

<?php
    include('../config/authentication.php');
    include('../includes/header.php');
?>

<div class="container">
    <div class="card shadow">
        <div class="card-body">
            <h1 class="my-4">Links Details</h1>

            <?php
                require_once '../config/dbconfig.php';
                if (isset($_GET['id'])){
                    $webinarID = $_GET['id'];

                    // Prepare the query to fetch webinar details
                    $query = "SELECT * FROM webinars WHERE webinar_id = '$webinarID'";
                    $result = $conn->query($query);

                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        ?>

                        <div class="mb-3">
                            <label for="webinar" class="form-label">Webinar Link: </label>
                            <a href="<?=$row['webinar_link'];?>" target="_blank"><?=$row['webinar_link'];?></a>
                        </div>

                        <div class="mb-3">
                            <label for="registration" class="form-label">Registration Link: </label>
                            <a href="<?=$row['registration_link'];?>" target="_blank"><?=$row['registration_link'];?></a>
                        </div>

                        <div class="mb-3">
                            <label for="link" class="form-label">Assessment link:</label>
                            <a href="<?=$row['assessment_link'];?>" target="_blank"><?=$row['assessment_link'];?></a>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <button type="button" class="btn btn-danger" onclick="window.location.href='webinarlist.php'"> Back </button>
                        </div>

                    <?php
                    } else {
                        $_SESSION['status'] = "Invalid ID";
                        header('Location: dashboard.php');
                        exit();
                    }
                } else {
                    $_SESSION['status'] = "No Record Found";
                    header('Location: dashboard.php');
                    exit();
                }
            ?>
        </div>
    </div>
</div>

<?php
    include('../includes/footer.php');
?>

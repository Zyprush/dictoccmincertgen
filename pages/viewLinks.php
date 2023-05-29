<?php
    include('../config/authentication.php');
    include('../includes/header.php');
?>

<div class="container">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="col-sm-6"> Webinar Details </div>
            <button type="button" class="btn btn-danger" onclick="window.location.href='webinarlist.php'">
                <i class="bi bi-arrow-left"></i> Back
            </button>
        </div>
        <div class="card-body">
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
                            <label for="webinar" class="form-label">Webinar Link:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" value="<?= $row['webinar_link']; ?>" readonly>
                                <button class="btn btn-primary" type="button" onclick="window.open('<?= $row['webinar_link']; ?>', '_blank')">
                                    <i class="bi bi-link-45deg"></i> Open
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="registration" class="form-label">Registration Link:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" value="<?= $row['registration_link']; ?>" readonly>
                                <button class="btn btn-primary" type="button" onclick="window.open('<?= $row['registration_link']; ?>', '_blank')">
                                    <i class="bi bi-link-45deg"></i> Open
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="link" class="form-label">Assessment Link:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" value="<?= $row['assessment_link']; ?>" readonly>
                                <button class="btn btn-primary" type="button" onclick="window.open('<?= $row['assessment_link']; ?>', '_blank')">
                                    <i class="bi bi-link-45deg"></i> Open
                                </button>
                            </div>
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

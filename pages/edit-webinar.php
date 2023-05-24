<?php
    include('../config/authentication.php');
    include('../includes/header.php');
?>

<div class="container">
    <h1 class="my-4">Edit Webinar</h1>
    <h3 class="my-4">Webinar details</h3>

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

            <form action="../config/update-webinar.php" method="POST">

                <input type="hidden" name="key" value="<?=$webinarID;?>">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="webinar_title" name="webinar_title" value="<?=$row['webinar_title'];?>" required>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="webinar_date" name="webinar_date" value="<?=$row['webinar_date'];?>" required>
                </div>

                <div class="mb-3">
                    <label for="link" class="form-label">Meeting link</label>
                    <input type="url" class="form-control" id="webinar_link" name="webinar_link" value="<?=$row['webinar_link'];?>" required>
                </div>

                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <button type="submit" class="btn btn-primary btn-block" name="update_webinar">Update</button>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <button type="button" class="btn btn-danger btn-block" onclick="window.location.href='webinarlist.php'">Cancel</button>
                    </div>
                </div>
            </form>

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

<?php
    include('../includes/footer.php');
?>

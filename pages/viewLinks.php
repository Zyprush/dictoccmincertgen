<?php
    include('../config/authentication.php');
    include('../includes/header.php');
?>

<div class="container">
    <div class="card shadow">
        <div class="card-body">
            <h1 class="my-4">Links Details</h1>

            <?php
                include('../config/dbcon.php');
                if (isset($_GET['id'])){
                    $key_child = $_GET['id'];

                    $ref_table = 'webinars';
                    $getdata = $database->getReference($ref_table)->getChild($key_child)->getValue();

                    if($getdata > 0) {

                    ?>

                        <div class="mb-3">
                            <label for="webinar" class="form-label">Webinar Link: </label>
                            <a href="<?=$getdata['webinar_link'];?>" target="_blank"><?=$getdata['webinar_link'];?></a>
                        </div>

                        <div class="mb-3">
                            <label for="registration" class="form-label">Registration Link: </label>
                            <a href="<?=$getdata['registration_link'];?>" target="_blank"><?=$getdata['registration_link'];?></a>
                        </div>

                        <div class="mb-3">
                            <label for="link" class="form-label">Assessment link:</label>
                            <a href="<?=$getdata['assessment_link'];?>" target="_blank"><?=$getdata['assessment_link'];?></a>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <button type="button" class="btn btn-danger" onclick="window.location.href='webinarlist.php'"> Back </button>
                        </div>

                    <?php

                            } else {
                                $_SESSION['status'] = "Invalid ID";
                                header('location: dashboard.php');
                                exit();
                            }
                        } else {
                            $_SESSION['status'] = "No Record Found";
                            header('location: dashboard.php');
                            exit();
                        }
                    ?>
        </div>
    </div>
</div>

<?php
    include('../includes/footer.php');
?>

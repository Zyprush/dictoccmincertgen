<?php
    include('../config/authentication.php');
    include('../includes/header.php');
?>

<div class="container my-5">
    <div class="row mb-5">
        <div class="col-md-12 text-center">
            Welcome,
        <p class="lead">Here's your dashboard overview.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <i class="bi bi-calendar-date fs-1 mb-3"></i>
                    <h5 class="card-title mb-0">Total Webinars</h5>
                    <p class="card-text text-center display-4 mt-2">
                        <?php
                        include('../config/dbcon.php');
                        $ref_table = 'webinars';
                        $total_count = $database->getReference($ref_table)->getSnapshot()->numChildren();
                        echo $total_count;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <i class="bi bi-people fs-1 mb-3"></i>
                    <h5 class="card-title mb-0">Total Participants</h5>
                    <p class="card-text text-center display-4 mt-2">
                        <?php
                        include('../config/dbcon.php');
                        $ref_table = 'participants';
                        $total_count = 0;
                        $fetchdata = $database->getReference($ref_table)->getValue();

                        if (!empty($fetchdata)) {
                            foreach ($fetchdata as $webinar) {
                                $total_count += count($webinar);
                            }
                        }

                        echo $total_count;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <i class="bi bi-calendar-event fs-1 mb-3"></i>
                    <h5 class="card-title mb-0">Pending Webinars</h5>
                    <p class="card-text text-center display-4 mt-2">Null</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-0">Webinar List</h5>
                    <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Webinar ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Event Date</th>
                            <th scope="col">Participants</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody id="webinar-list-body">
                        <!-- Data fetched from Realtime Database will be added here -->
                        <?php
                            include ('../config/dbcon.php');

                            $ref_table = 'webinars';
                            $fetchdata = $database->getReference($ref_table)->getValue();

                            if($fetchdata > 0) {
                            foreach($fetchdata as $key => $row){
                        ?>
                        <tr>
                            <td><?=$row['webinar_id']?></td>
                            <td><?=$row['webinar_title']?></td>
                            <td><?=$row['webinar_date']?></td>
                        </tr>
                        <?php
                            }
                            } else {
                        ?>
                        <tr>
                            <td colspan="4">
                            No Record Found
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include('../includes/footer.php');
?>

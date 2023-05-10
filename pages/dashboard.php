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
                                <?php
                                    include ('../config/dbcon.php');
                                    $ref_table = 'webinars';
                                    $webinars = $database->getReference($ref_table)->getValue();

                                    if ($webinars) {
                                        foreach ($webinars as $webinar_id => $webinar_data) {
                                            $participants_count = 0;
                                            $ref_table_participants = 'participants/' . $webinar_id;
                                            $participants_data = $database->getReference($ref_table_participants)->getValue();
                                            if ($participants_data) {
                                                $participants_count = count($participants_data);
                                            }
                                             ?>
                                            <tr>
                                                <td><?= $webinar_id ?></td>
                                                <td><?= $webinar_data['webinar_title'] ?></td>
                                                <td><?= $webinar_data['webinar_date'] ?></td>
                                                <td><?= $participants_count ?></td>
                                                <td class="text-danger">Pending</td>
                                            </tr>
                                <?php
                                        }
                                    } else {
                                ?>
                                    <tr>
                                        <td colspan="5">No Record Found</td>
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
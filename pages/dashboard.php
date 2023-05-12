<?php
    include('../config/authentication.php');
    include('../includes/header.php');
?>

<div class="container my-5">
    <div class="row mb-5">
        <div class="col-md-12 text-center">
            <h1>
                Welcome,
            </h1>
            <h3>
                Here's your dashboard overview.
            </h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <h5 class="card-title mb-0">Total Webinars</h5>
                    <p class="card-text text-center display-4 mt-2" id="webinar-count"></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <h5 class="card-title mb-0">Total Participants</h5>
                    <p class="card-text text-center display-4 mt-2" id="participant-count"></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <h5 class="card-title mb-0">Pending Webinars</h5>
                    <p class="card-text text-center display-4 mt-2" id="pending-count"></p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-mb-12">
        <div class="card">
            <div class="card-body">
                <table id="dashboard-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Webinar ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Event Date</th>
                            <th scope="col">Participants</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>  
    </div>
</div>

<?php
    include('../includes/footer.php');
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

<script>
    //console.log("document ready!");
    $(document).ready(function() {
    $('#dashboard-table').DataTable({
        "ajax": "../config/fetch_dashboard.php",
        "columns": [
        { "data": "webinar_id" },
        { "data": "webinar_title" },
        { "data": "webinar_date" },
        { "data": "participants_count" },
        {
            "data": "status",
            "render": function(data, type, row) {
                if (data == 0) {
                    return '<span class="text-danger">Pending</span>';
                } else {
                    return '<span class="text-success">Completed</span>';
                }
            }
        }
        ]
    });
    });
    // Fetch the total webinar count
    fetch('../config/get_total_dashboard.php?type=webinar')
        .then(response => response.text())
        .then(data => document.getElementById('webinar-count').textContent = data)
        .catch(error => console.error(error));

    // Fetch the total participant count
    fetch('../config/get_total_dashboard.php?type=participant')
        .then(response => response.text())
        .then(data => document.getElementById('participant-count').textContent = data)
        .catch(error => console.error(error));

    // Fetch the total pending count
    fetch('../config/get_total_dashboard.php?type=pending')
        .then(response => response.text())
        .then(data => document.getElementById('pending-count').textContent = data)
        .catch(error => console.error(error));
    
</script>

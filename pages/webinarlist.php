<?php
    include('../config/authentication.php');
    include('../includes/header.php');
?>

<?php
    if(isset($_SESSION['status'])){
        echo "<h5 class='alert alert-success'>" . ($_SESSION['status']) . "</h5>";
        unset($_SESSION['status']);
    }
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    Webinar List
                </div>
                <div class="col-sm-6">
                    <div class="float-right">
                        <button id="btn-generate-certificate" class="btn btn-secondary btn-sm disabled">Generate Certificates</button>
                        <button id="btn-edit-webinar" class="btn btn-secondary btn-sm disabled">Edit</button>
                        <button id="btn-delete-webinar" class="btn btn-secondary btn-sm disabled">Delete</button>
                        <button id="btn-view-links" class="btn btn-secondary btn-sm disabled">View Links</button>
                        <a href="addWebinar.php" class="btn btn-primary btn-sm">
                            Add Webinar
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="webinar-table" class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Webinar ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Date</th>
                        <th scope="col">Respondent</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
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
    $(document).ready(function () {
        var table = $('#webinar-table').DataTable({
            "ajax":{
                "url":"../config/fetch_webinars.php",
                "type":"POST"
            },
            "columns": [
                { "data": "id" },
                { "data": "title" },
                { "data": "date" },
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
            ],
            select: {
            style: 'single'
            },
        });

        // Set button state based on row selection
        table.on('select', function (e, dt, type, indexes) {
            var selectedRows = table.rows({ selected: true }).count();
            if (selectedRows === 1) {
                $('#btn-generate-certificate, #btn-edit-webinar, #btn-delete-webinar, #btn-view-links').removeClass('disabled');
            } else {
                $('#btn-generate-certificate, #btn-edit-webinar, #btn-delete-webinar, #btn-view-links').addClass('disabled');
            }
        });

        // Clear button state on deselect
        table.on('deselect', function (e, dt, type, indexes) {
            $('#btn-generate-certificate, #btn-edit-webinar, #btn-delete-webinar, #btn-view-links').addClass('disabled');
        });

        // Add button click handlers
        $('#btn-generate-certificate').on('click', function() {
            var selectedRowData = table.rows({ selected: true }).data()[0];
            var webinarID = selectedRowData.id;
            window.location.href = 'certificates_gen.php?id=' + webinarID;
        });

        $('#btn-edit-webinar').on('click', function() {
            var selectedRowData = table.rows({ selected: true }).data()[0];
            var webinarID = selectedRowData.id;
            window.location.href = 'edit-webinar.php?id=' + webinarID;
        });

        $('#btn-delete-webinar').on('click', function() {
            var selectedRowData = table.rows({ selected: true }).data()[0];
            var webinarID = selectedRowData.id;
            if (confirm('Are you sure you want to delete this webinar?')) {
                $.ajax({
                    url: '../config/delete_webinar.php',
                    method: 'POST',
                    data: {id: webinarID},
                    success: function(data) {
                        table.ajax.reload(null, false).draw(true);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });

        $('#btn-view-links').on('click', function() {
            var selectedRowData = table.rows({ selected: true }).data()[0];
            var webinarID = selectedRowData.id;
            window.location.href = 'viewLinks.php?id=' + webinarID;
        });
    });
</script>

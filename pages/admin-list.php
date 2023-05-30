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
    <div class="card border shadow rounded">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="col-sm-12 col-md-6 font-weight-bold">
                Admin List
            </div>
            <div class="col-sm-6">
                <div class="float-right">
                    <button id="btn-add-whitelisted" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i>
                        Add User
                    </button>
                    <button id="btn-edit-user" class="btn btn-secondary btn-sm disabled">
                        <i class="fas fa-pen"></i>
                    </button>
                    <button id="btn-delete-user" class="btn btn-secondary btn-sm disabled">
                        <i class="fas fa-trash"></i>
                    </button>
                    <button id="btn-promote-user" class="btn btn-secondary btn-sm disabled">
                        <i class="bi bi-trophy"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="adminTable" class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email ID</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<?php
    include('../includes/footer.php');
?>
<!-- Include DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

<script>
$(document).ready(function() {
    $('#adminTable').DataTable({
        ajax: {
            url: '../config/fetch_admins.php',
            dataSrc: ''
        },
        columns: [
            { data: 'name' },
            { data: 'email' }
        ],
            select: {
            style: 'single'
            },
    });
});
</script>


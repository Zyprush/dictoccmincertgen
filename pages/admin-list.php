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
                        <th>Role</th>
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
    var table = $('#adminTable').DataTable({
        ajax: {
            url: '../config/fetch_admins.php',
            dataSrc: ''
        },
        columns: [
            { data: 'name' },
            { data: 'email' },
            {
                data: 'role',
                render: function(data) {
                    if (data === '0') {
                        return 'Normal User';
                    } else if (data === '1') {
                        return 'Admin';
                    } else {
                        return '';
                    }
                }
            }
        ],
        select: {
            style: 'single'
        },
    });

    // Enable/disable and style buttons based on selection
    $('#adminTable tbody').on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            $('#btn-edit-user, #btn-delete-user, #btn-promote-user').addClass('disabled').removeClass('btn-primary');
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            $('#btn-edit-user, #btn-delete-user, #btn-promote-user').removeClass('disabled').addClass('btn-primary');
        }
    });

    // Add User button click event
    $('#btn-add-whitelisted').on('click', function() {
        var userRole = <?php echo json_encode($_SESSION['role']); ?>;

        if (userRole === 0) {
            // Non-admin user, display an error message or take appropriate action
            alert("You don't have permission to add users.");
            return;
        }

        // Show the modal form for adding a user
        // Add your code to show the modal form here
    });

    // Edit User button click event
    $('#btn-edit-user').on('click', function() {
        // Add your logic for editing a user here
    });

    // Delete User button click event
    $('#btn-delete-user').on('click', function() {
        var selectedRowData = table.rows({ selected: true }).data()[0];
        var userEmail = selectedRowData.email;
        var userRole = <?php echo json_encode($_SESSION['role']); ?>;

        if (userRole === 0) {
            // Non-admin user, display an error message or take appropriate action
            alert("You don't have permission to Delete users. Please ask the Admin.");
            return;
        }

        // Show a confirmation dialog before deleting the user
        if (confirm("Are you sure you want to delete this user?")) {
            // Send an AJAX request to delete the user
            $.ajax({
                url: '../config/delete_user.php',
                method: 'POST',
                data: { userEmail: userEmail },
                success: function(response) {
                    // Handle the response from the server
                    if (response.success) {
                        // User deleted successfully
                        alert('User deleted successfully');
                        table.ajax.reload(); // Refresh the table data
                    } else {
                        // Failed to delete user
                        alert('Failed to delete user. Please try again.');
                    }
                },
                error: function() {
                    // Error occurred during the AJAX request
                    alert('An error occurred while deleting the user. Please try again.');
                }
            });
        }
    });

    // Promote User button click event
    $('#btn-promote-user').on('click', function() {
        var selectedRowData = table.rows({ selected: true }).data()[0];
        var userEmail = selectedRowData.email;
        var userRole = <?php echo json_encode($_SESSION['role']); ?>;

        if (userRole === 0) {
            // Non-admin user, display an error message or take appropriate action
            alert("You don't have permission to Promote users. Please ask the Admin.");
            return;
        }

        // Perform the promote operation for the user
        if (confirm("Are you sure you want to promote user with email: " + userEmail + "?")) {
            $.ajax({
                url: '../config/promote_user.php',
                method: 'POST',
                data: { userEmail: userEmail },
                success: function(response) {
                    if (response.success) {
                        // User promoted successfully
                        alert('User promoted successfully');
                        table.ajax.reload(); // Refresh the table data
                    } else {
                        // Failed to promote user
                        alert('Failed to promote user. Please try again.');
                    }
                },
                error: function() {
                    // Error occurred during the AJAX request
                    alert('An error occurred while promoting the user. Please try again.');
                }
            });
        }
    });

});
</script>

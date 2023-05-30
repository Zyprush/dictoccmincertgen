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
    <!-- Modal for Add User -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../config/whitelisted-emails.php" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <!-- Add any other fields or inputs as needed -->
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
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
            { data: 'email' }
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

        // Show the modal form
        $('#addUserModal').modal('show');
    });

    // Edit User button click event
    $('#btn-edit-user').on('click', function() {
        // Add your logic for editing a user here
    });

    // Delete User button click event
    $('#btn-delete-user').on('click', function() {
        // Add your logic for deleting a user here
    });

    // Promote User button click event
    $('#btn-promote-user').on('click', function() {
        // Add your logic for promoting a user here
    });
});
</script>



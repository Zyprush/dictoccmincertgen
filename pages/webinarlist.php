<?php
    include('../config/authentication.php');
    include('../includes/header.php');
?>

<div class="container">
        <?php
            if(isset($_SESSION['status'])){
                echo "<h5 class='alert alert-success'>".($_SESSION['status'])."</h5>";
                unset($_SESSION['status']);
            }
        ?>
  <div class="card border shadow rounded">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="col-sm-12 col-md-6 font-weight-bold">
          Webinar List
        </div>
        <div class="col-sm-6">
          <div class="float-right">
            <button id="btn-view-assessments" class="btn btn-secondary btn-sm disabled">
              View Response
            </button>
            <button id="btn-edit-webinar" class="btn btn-secondary btn-sm disabled">
              <i class="fas fa-pen"></i>
            </button>
            <button id="btn-delete-webinar" class="btn btn-secondary btn-sm disabled">
              <i class="fas fa-trash"></i>
            </button>
            <button id="btn-view-links" class="btn btn-secondary btn-sm disabled">
              <i class="fas fa-eye"></i>
            </button>
            <a href="addWebinar.php" class="btn btn-primary btn-sm">
              <i class="fas fa-plus"></i>
            </a>
          </div>
        </div>
    </div>
    <div class="card-body">
      <table id="webinar-table" class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Webinar ID</th>
            <th scope="col">Title</th>
            <th scope="col">Event Date</th>
            <th scope="col">Responses</th>
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

$(document).ready(function() {
      // Initialize DataTables
      var table = $('#webinar-table').DataTable({
        ajax: {
          url: '../config/fetch_webinars.php',
          dataSrc: ''
        },
        columns: [
          { data: 'webinar_id' },
          { data: 'webinar_title' },
          { data: 'webinar_date' },
          { data: 'assessment_count' },
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
                $('#btn-view-assessments, #btn-edit-webinar, #btn-delete-webinar, #btn-view-links')
                .removeClass('disabled')
                .removeClass('btn-secondary')
                .addClass('btn-primary');
            } 
        });

        // Clear button state on deselect
        table.on('deselect', function (e, dt, type, indexes) {
            $('#btn-view-assessments, #btn-edit-webinar, #btn-delete-webinar, #btn-view-links')
                .addClass('disabled')
                .removeClass('btn-primary')
                .addClass('btn-secondary');
        });

        // Add button click handlers
        $('#btn-view-assessments').on('click', function() {
            var selectedRowData = table.rows({ selected: true }).data()[0];
            var webinarID = selectedRowData.webinar_id;
            window.location.href = 'assessments_view.php?id=' + webinarID;
        });

        $('#btn-edit-webinar').on('click', function() {
            var selectedRowData = table.rows({ selected: true }).data()[0];
            var webinarID = selectedRowData.webinar_id;
            window.location.href = 'edit-webinar.php?id=' + webinarID;
        });

        $('#btn-delete-webinar').on('click', function() {
            var selectedRowData = table.rows({ selected: true }).data()[0];
            var webinarID = selectedRowData.webinar_id;
            if (confirm('Are you sure you want to delete this webinar?')) {
                $.ajax({
                    url: '../config/delete_webinar.php',
                    method: 'POST',
                    data: {id: webinarID},
                    success: function(data) {
                        // Remove the selected row from the table
                        table.row({ selected: true }).remove().draw();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });

        $('#btn-view-links').on('click', function() {
            var selectedRowData = table.rows({ selected: true }).data()[0];
            var webinarID = selectedRowData.webinar_id;
            window.location.href = 'viewLinks.php?id=' + webinarID;
        });
    });
</script>
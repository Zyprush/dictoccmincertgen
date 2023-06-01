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
              <i class="bi bi-view-list"></i>
              View Response
            </button>
            <button id="btn-edit-webinar" class="btn btn-secondary btn-sm disabled">
              <i class="fas fa-pen"></i>
            </button>
            <button id="btn-delete-webinar" class="btn btn-secondary btn-sm disabled">
              <i class="fas fa-trash"></i>
            </button>
            <button id="btn-view-links" class="btn btn-secondary btn-sm disabled">
              <i class="bi bi-link-45deg"></i>
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
      <div class="card-footer">
        <div class="ml-auto">DICT Certificate Generator. <span>&copy;</span>2023</div>
      </div>
  </div>
</div>

<!-- Edit webinar dialog -->
<div class="modal fade" id="editWebinarModal" tabindex="-1" role="dialog" aria-labelledby="editWebinarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editWebinarModalLabel">Edit Webinar Details</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editWebinarForm" action="../config/update-webinar.php" method="POST">
        <div class="modal-body">
          <input type="hidden" name="key" id="webinar_id">
          <div class="form-group">
            <label for="webinar_title"><b>Webinar Title:</b> </label>
            <input type="text" class="form-control" id="webinar_title" name="webinar_title" required>
          </div>
          <div class="form-group">
            <label for="webinar_date"><b> Webinar Date:</b></label>
            <input type="date" class="form-control" id="webinar_date" name="webinar_date" required>
          </div>
          <div class="form-group">
            <label for="webinar_link"><b>Webinar Link:</b> </label>
            <input type="text" class="form-control" id="webinar_link" name="webinar_link" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" name="update_webinar" disabled>Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Viewlinks webinar dialog -->
<div class="modal fade" id="viewLinkModal" tabindex="-1" role="dialog" aria-labelledby="viewLinkModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewLinkModalLabel">Webinar Links Details</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="webinar_links"><b>Webinar Link:</b> </label>
          <div class="input-group">
            <input type="text" class="form-control mr-2" id="webinar_links" name="webinar_links">
            <button class="btn btn-primary" type="button" id="openWebinarLink">
              <i class="bi bi-link-45deg"></i>
            </button>
          </div>
        </div>
        <div class="form-group">
          <label for="registration_link"><b>Assessment Link:</b> </label>
          <div class="input-group">
            <input type="text" class="form-control mr-2" id="assessment_link" name="assessment_link">
            <button class="btn btn-primary" type="button" id="openAssessmentLink">
              <i class="bi bi-link-45deg"></i>
            </button>
          </div>
        </div>
        <div class="form-group">
          <label for="registration_link"><b>Registration Link:</b> </label>
          <div class="input-group">
            <input type="text" class="form-control mr-2" id="registration_link" name="registration_link">
            <button class="btn btn-primary" type="button" id="openRegistrationLink">
              <i class="bi bi-link-45deg"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="modal-footer">
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

        var originalValues = {}; // Object to store the original values

        // Enable or disable the "Save Changes" button
        $('input').on('input', function() {
            var webinarTitle = $('#webinar_title').val();
            var webinarDate = $('#webinar_date').val();
            var webinarLink = $('#webinar_link').val();

            // Check if any changes were made
            if (webinarTitle !== originalValues.title || webinarDate !== originalValues.date || webinarLink !== originalValues.link) {
                $('button[name="update_webinar"]').prop('disabled', false);
            } else {
                $('button[name="update_webinar"]').prop('disabled', true);
            }
        });

        $('#btn-edit-webinar').on('click', function() {
            // Get the selected webinar ID
            var selectedRowData = table.rows({ selected: true }).data()[0];
            var webinarID = selectedRowData.webinar_id;

            // Fetch the webinar details from the server
            $.ajax({
                url: '../config/fetch-webinar-details.php',
                type: 'GET',
                data: { id: webinarID },
                success: function(response) {
                    // Parse the JSON response
                    var webinar = JSON.parse(response);

                    // Extract the webinar details
                    var webinarTitle = webinar.webinar_title;
                    var webinarDate = webinar.webinar_date;
                    var webinarLink = webinar.webinar_link;

                    // Set the original values
                    originalValues.title = webinarTitle;
                    originalValues.date = webinarDate;
                    originalValues.link = webinarLink;

                    // Set the values in the form
                    $('#webinar_id').val(webinarID);
                    $('#webinar_title').val(webinarTitle);
                    $('#webinar_date').val(webinarDate);
                    $('#webinar_link').val(webinarLink);

                    // Show the dialog
                    $('#editWebinarModal').modal('show');
                },
                error: function(xhr, status, error) {
                    // Handle the error response
                    console.log(error);
                }
            });
        });

        $('#btn-delete-webinar').on('click', function() {
            var selectedRowData = table.rows({ selected: true }).data()[0];
            var webinarID = selectedRowData.webinar_id;

            if (confirm('Are you sure you want to delete this webinar?')) {
                $.ajax({
                    url: '../config/delete_webinar.php',
                    method: 'POST',
                    data: { id: webinarID },
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
            // Get the selected webinar ID
            var selectedRowData = table.rows({ selected: true }).data()[0];
            var webinarID = selectedRowData.webinar_id;

            // Fetch the webinar details from the server
            $.ajax({
                url: '../config/fetch-link.php',
                type: 'GET',
                data: { id: webinarID },
                success: function(response) {
                    // Parse the JSON response
                    var webinar = JSON.parse(response);

                    // Extract the webinar details
                    var webinarLink = webinar.webinar_link;
                    var assessmentLink = webinar.assessment_link;
                    var registrationLink = webinar.registration_link;

                    // Set the values in the form
                    $('#webinar_links').val(webinarLink);
                    $('#assessment_link').val(assessmentLink);
                    $('#registration_link').val(registrationLink);
                    

                    // Show the dialog
                    $('#viewLinkModal').modal('show');
                },
                error: function(xhr, status, error) {
                    // Handle the error response
                    console.log(error);
                }
            });
          });
        // JavaScript code for opening links in a new tab
        $(document).ready(function() {
          $('#openWebinarLink').on('click', function() {
            var webinarLink = $('#webinar_links').val();
            window.open(webinarLink, '_blank');
          });

          $('#openAssessmentLink').on('click', function() {
            var assessmentLink = $('#assessment_link').val();
            window.open(assessmentLink, '_blank');
          });

          $('#openRegistrationLink').on('click', function() {
            var registrationLink = $('#registration_link').val();
            window.open(registrationLink, '_blank');
          });
        });

    });
</script>
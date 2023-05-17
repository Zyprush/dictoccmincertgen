<?php
  include('../config/authentication.php');
  include('../includes/header.php');

  $webinar_id = $_GET['id'];
?>

<div class="container">
  <div class="card">
    <div class="card-header">
      Webinar Attendee
      <button class="btn btn-secondary btn-sm float-right" id="generate-certificates-btn" disabled>
        Generate Certificates
        <i class="fas fa-cog"></i>
      </button>
      <button class="btn btn-secondary btn-sm float-right mr-2" id="select-all-btn">
        Select All
      </button>
    </div>
    <div class="card-body">
      <form id="certificates-form" method="POST" action="certificates_gen.php?id=<?= $webinar_id ?>">
        <input type="hidden" id="attendees-input" name="attendees" value="">
      </form>

      <!-- Form for uploading PDF file -->
      <div id="upload-form" style="display: none;">
        <form id="pdf-upload-form" enctype="multipart/form-data">
          <div class="form-group">
            <label for="pdf-file">Upload PDF:</label>
            <input type="file" class="form-control-file" id="pdf-file" name="pdfFile">
          </div>
          <button type="submit" class="btn btn-primary">Save PDF</button>
        </form>
      </div>


      <table class="table table-hover" id="attendees-table">
        <thead>
          <tr>
            <th>Certificate Name</th>
            <th>Certificate Email</th>
          </tr>
        </thead>
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
    var table = $('#attendees-table').DataTable({
      ajax: {
        url: '../config/fetch_assessments.php?id=<?= $webinar_id ?>',
        dataSrc: ''
      },
      select: {
        style: 'multi',
        selector: 'td:not(:first-child)'
      },
      columns: [
        {data: 'certificate_name'},
        {data: 'certificate_email'}
      ],
      order: [[1, 'asc']]
    });

    // Select all button
    $('#select-all-btn').on('click', function() {
      if ($(this).text() === 'Select All') {
        table.rows().select();
        $(this).text('Deselect All');
      } else {
        table.rows().deselect();
        $(this).text('Select All');
      }
    });

    // Enable/disable the Generate Certificates button
    table.on('select deselect', function () {
      var selectedRows = table.rows({ selected: true }).count();
      $('#generate-certificates-btn').prop('disabled', !selectedRows);

      // Update the hidden input field with the selected attendees' data
      var selectedAttendees = table.rows({ selected: true }).data().toArray();
      var attendeesJson = JSON.stringify(selectedAttendees);
      $('#attendees-input').val(attendeesJson);
    });

    // Generate certificates button
    $('#generate-certificates-btn').on('click', function() {
      // Display the PDF upload form
      $('#upload-form').show();
    });

    // Handle PDF file upload
    $('#pdf-upload-form').on('submit', function(e) {
      e.preventDefault();

      var formData = new FormData(this);
      $.ajax({
        url: '../config/upload_pdf.php', // PHP script to handle the PDF upload
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          // Check if the PDF was successfully uploaded
          if (response === 'success') {
            // Proceed with generating certificates
            $('#certificates-form').submit();
          } else {
            alert('Failed to upload the PDF file. Please try again.');
          }
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    });
   }); 
</script>
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
        url: '../config/fetch_assessments.php?id=<?=$webinar_id?>',
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
      table.rows().select();
    });

    // Deselect all button
    $('#deselect-all').on('click', function() {
      table.rows().deselect();
    });

    // Generate certificates button
    $('#generate-certificates-btn').on('click', function() {
      // Get the selected rows data
      var selectedRowsData = table.rows({ selected: true }).data().toArray();
      
      // Create an array of selected attendees' names and email addresses
      var selectedAttendees = [];
      selectedRowsData.forEach(function(rowData) {
        selectedAttendees.push({name: rowData.certificate_name, email: rowData.certificate_email});
      });
      
      // Build the URL for certificates_gen.php with the selected attendees' names and email addresses, and the webinar ID as parameters
      var url = 'certificates_gen.php?id=' + encodeURIComponent('<?php echo $webinar_id; ?>') + '&attendees=' + encodeURIComponent(JSON.stringify(selectedAttendees));
      
      // Navigate to the new URL
      window.location.href = url;
    });


    table.on('select deselect', function () {
      var selectedRows = table.rows({ selected: true }).count();
      $('#generate-certificates-btn').prop('disabled', !selectedRows);
    });
  });
</script>
<?php
    include('../config/authentication.php');
    include('../includes/header.php');
?>

<div class="container">
  <div class="card">
    <div class="card-header">
      Assessment Respondents
    </div>
    <div class="card-body">
      <table id="respondents-list" class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Webinar ID</th>
          <th scope="col">Certificate Name</th>
          <th scope="col">Certificate Email</th>
        </tr>
      </thead>
        <tbody id="webinar-list-body">
          <!-- Data fetched from Realtime Database will be added here -->
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
    $('#respondents-list').DataTable({
      "ajax": "../config/fetch_respondents.php",
      "columns": [
        {"data": "webinar_id"},
        {"data": "certificate_name"},
        {"data": "certificate_email"}
      ]
    });
  });
</script>
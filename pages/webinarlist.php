<?php
    include('../config/authentication.php');
    include('../includes/header.php');
?>

<?php
  if(isset($_SESSION['status'])){
   echo "<h5 class='alert alert-success'>".($_SESSION['status'])."</h5>";
   unset($_SESSION['status']);
  }
?>

<div class="container">
  <div class="card">
    <div class="card-header">
      Webinar List
      <a href="addWebinar.php" class="btn btn-primary btn-sm float-right">
        Add Webinar
      </a>
    </div>
    <div class="card-body">
      <table id="webinar-table" class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Webinar ID</th>
            <th scope="col">Title</th>
            <th scope="col">Date</th>
            <th scope="col">Link</th>
          </tr>
        </thead>
        <tbody>
          <?php
            require_once('../config/dbcon.php');
            $ref_table = 'webinars';
            $fetchdata = $database->getReference($ref_table)->getValue();
            if(is_array($fetchdata) && count($fetchdata) > 0) {
              foreach($fetchdata as $key => $row) {
          ?>
          <tr>
            <td><?= $row['webinar_id'] ?></td>
            <td><?= $row['webinar_title'] ?></td>
            <td><?= $row['webinar_date'] ?></td>
            <td><?= $row['webinar_link'] ?></td>
          </tr>
          <?php
              }
            } else {
          ?>
          <tr>
            <td colspan="4">
              No Record Found
            </td>
          </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php
    include('../includes/footer.php');
?>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready( function () {
    $('#webinar-table').DataTable();
  } );
</script>

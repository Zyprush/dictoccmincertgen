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
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
            require_once('../config/dbcon.php');
            $ref_table = 'webinars';
            $fetchdata = $database->getReference($ref_table)->getValue();
            if(is_array($fetchdata) && count($fetchdata) > 0) {
              foreach($fetchdata as $key => $row) {
                if(isset($row['webinar_id'])) {
                    $id = $row['webinar_id'];
                } else {
                    $id = $key;
                }
                ?>
                <tr>
                    <td><?=$id?></td>
                    <td><?=$row['webinar_title']?></td>
                    <td><?=$row['webinar_date']?></td>
                    <td><?=$row['webinar_link']?></td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a href="edit-webinar.php?id=<?=$key?>" class="dropdown-item"><i class="fas fa-edit fa-lg text-primary"></i></a>
                                <form action="../config/code.php" method="POST">
                                    <button type="submit" name="delete_btn" value="<?=$key?>" class="dropdown-item"><i class="fas fa-trash-alt fa-lg text-danger"></i></button>
                                </form>
                                <a href="<?=$row['webinar_link']?>" class="dropdown-item"><i class="fas fa-external-link-alt fa-lg text-success"></i></a>
                                <a href="#" class="dropdown-item"><i class="fas fa-envelope fa-lg text-info"></i></a>
                            </div>
                        </div>
                    </td>
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

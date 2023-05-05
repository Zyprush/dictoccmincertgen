<?php
    include('authentication.php');
    include('includes/header.php');
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
    <div class="col-md-6 text-right">
      <div>Total Webinars:
        <?php
          include('dbcon.php');
          $ref_table = 'webinars';
          $total_count = $database->getReference($ref_table)->getSnapshot()->numChildren();
          echo $total_count;
        ?>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Date</th>
            <th scope="col">Link</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody id="webinar-list-body">
          <!-- Data fetched from Realtime Database will be added here -->
          <?php
            include ('dbcon.php');

            $ref_table = 'webinars';
            $fetchdata = $database->getReference($ref_table)->getValue();

            if($fetchdata > 0) {
              foreach($fetchdata as $key => $row){
          ?>
          <tr>
            <td><?=$row['webinar_title']?></td>
            <td><?=$row['webinar_date']?></td>
            <td><?=$row['webinar_link']?></td>
            <td>
              <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
              </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a href="edit-webinar.php?id=<?=$key;?>" class="dropdown-item">
                    Edit <i class="fas fa-edit fa-lg text-primary"></i>
                  </a>
                  <form action="code.php" method="POST">
                    <button type="submit" name="delete_btn" value="<?=$key;?>" class="dropdown-item">
                      Delete <i class="fas fa-trash-alt fa-lg text-danger"></i>
                    </button>
                  </form>
                  <button class="dropdown-item">
                    View Link <i class="fas fa-external-link-alt fa-lg text-success"></i>
                  </button>
                  <button class="dropdown-item">
                    Send Email <i class="fas fa-envelope fa-lg text-info"></i>
                  </button>
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
<script>
$(document).ready(function(){
  $(".dropdown-toggle").on("click", function(){
    $(this).next(".dropdown-menu").toggle();
  });
});
</script>
<?php
    include('includes/footer.php');
?>

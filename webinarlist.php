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
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
            <th scope="col">External Link</th>
            <th scope="col">Send Email</th>
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
              <a href="edit-webinar.php?id=<?=$key;?>" class="btn btn-primary btn-sm">
                Edit <i class="fas fa-edit fa-lg text-white"></i>
              </a>
            </td>
            <td>
              <form action="code.php" method="POST">
                <button type="submit" name="delete_btn" value="<?=$key;?>" class="btn btn-danger btn-sm">
                  Delete <i class="fas fa-trash-alt fa-lg text-white"></i>
                </button>
              </form>
            </td>
            <td>
              <button class="btn btn-success btn-sm">
                Link <i class="fas fa-external-link-alt fa-lg text-white"></i>
              </button>
            </td>
            <td>
              <button class="btn btn-info btn-sm">
                Send <i class="fas fa-envelope fa-lg text-white"></i>
              </button>
            </td>
          </tr>
          <?php
              }
            } else {
          ?>
          <tr>
            <td colspan="7">
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
    include('includes/footer.php');
?>
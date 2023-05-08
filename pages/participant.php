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
      Participant Management
    </div>
    <div class="card-body">
      <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Webinar ID</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Student ID</th>
          <th scope="col">School</th>
          <th scope="col">Organization</th>
          <th scope="col">Program</th>
          <th scope="col">Position</th>
        </tr>
      </thead>
        <tbody id="webinar-list-body">
          <!-- Data fetched from Realtime Database will be added here -->
          <?php
            include ('../config/dbcon.php');
            $ref_table = 'participants';
            $fetchdata = $database->getReference($ref_table)->getValue();

            if(!empty($fetchdata)) {
                foreach($fetchdata as $webinar_id => $webinar){
                    foreach($webinar as $registration_id => $registration) {
            ?>
            <tr>
              <td><?=$webinar_id?></td>
              <td><?=$registration['name']?></td>
              <td><?=$registration['email']?></td>
              <td><?=$registration['student_id']?></td>
              <td><?=$registration['school']?></td>
              <td><?=$registration['organization']?></td>
              <td><?=$registration['program']?></td>
              <td><?=$registration['position']?></td>
            </tr>
            <?php
                    }
                }
            } else {
          ?>
          <tr>
            <td colspan="8">
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

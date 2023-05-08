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

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mx-auto shadow">
                <div class="card-header">
                    <h4>
                        Admin List
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include('../config/dbcon.php');
                                $users = $auth->listUsers();

                                foreach ($users as $user) {
                            ?>
                            <tr>
                                <td><?=$user->displayName?></td>
                                <td><?=$user->email?></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>  

<?php
    include('../includes/footer.php');
?>
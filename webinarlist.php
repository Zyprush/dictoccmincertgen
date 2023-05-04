<?php
    session_start();
    include('includes/header.php');
?>

<div class="card">
  <div class="card-header">
    Webinar List
  </div>
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Date</th>
            <th scope="col">Link</th>
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
                    <th><?=$row['webinar_title']?></th>
                    <th><?=$row['webinar_date']?></th>
                    <th><?=$row['webinar_link']?></th>
                </tr>
                <?php
            }
        } else {
            ?>
                <tr>
                    <td colspan="3">
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


<?php
    include('includes/footer.php');
?>
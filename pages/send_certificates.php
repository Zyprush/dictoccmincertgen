<?php
  include('../config/authentication.php');
  include('../includes/header.php');

  $webinar_id = $_GET['id'];
?>

<div class="container">
  <div class="card">
    <div class="card-header">
      Webinar Attendee
      <button id="send-certificate-btn" class="btn btn-primary btn-sm float-right">
        SEND Certificates
      </button>
    </div>
    <div class="card-body">
      <table id="webinar-table" class="table table-hover">
        <thead>
          <tr>
            <th scope="col"><input type="checkbox" id="select-all-checkbox"></th>
            <th scope="col">Certificate Name</th>
            <th scope="col">Certificate Email</th>
          </tr>
        </thead>
        <tbody>
          <?php
            require_once('../config/dbcon.php');
            $ref_table_assessments = 'assessments/' . $webinar_id;
            $fetchdata = $database->getReference($ref_table_assessments)->getValue();

            if(is_array($fetchdata) && count($fetchdata) > 0) {
              foreach($fetchdata as $key => $row) {
                ?>
                <tr class="table-row">
                    <td><input type="checkbox" class="select-checkbox" value="<?=$key?>"></td>
                    <td><?=$row['certificate_name']?></td>
                    <td><?=$row['certificate_email']?></td>
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
</div>

<script>
  // Select All checkbox
  const selectAllCheckbox = document.querySelector('#select-all-checkbox');
  const selectCheckboxes = document.querySelectorAll('.select-checkbox');

  selectAllCheckbox.addEventListener('click', () => {
    selectCheckboxes.forEach(checkbox => checkbox.checked = selectAllCheckbox.checked);
  });

  // Send Certificates button
  const sendCertificateBtn = document.querySelector('#send-certificate-btn');
  const selectedRows = [];

  sendCertificateBtn.addEventListener('click', () => {
    selectCheckboxes.forEach(checkbox => {
      if (checkbox.checked) {
        selectedRows.push(checkbox.value);
      }
    });

    if (selectedRows.length === 0) {
      alert('Please select at least one row to send certificates.');
      return;
    }

    // Do something with selected rows here
    console.log(selectedRows);
  });
</script>

<?php
  include('../includes/footer.php');
?>

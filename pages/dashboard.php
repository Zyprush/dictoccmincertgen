<?php
    include('../config/authentication.php');
    include('../includes/header.php');

?>
<style>
    #webinar-count {
    font-family: Arial, sans-serif; 
    font-weight: bold;
    padding: 0;
    margin-left: 0;
    }
    #participant-count {
    font-family: Arial, sans-serif; 
    font-weight: bold;
    }
    #pending-count {
    font-family: Arial, sans-serif; 
    font-weight: bold;
    }
    #icon-background-webinars {
    background-color: #cfe8ff;
    border-radius: 10px;
    height: 100%;
    width: 45%;
    margin-top: 15px;
    color: #134991;
    }
    #icon-background-participant {
    background-color: #fff2c6;
    border-radius: 10px;
    height: 100%;
    width: 45%;
    margin-top: 15px;
    color: #ffd450;
    }
    #icon-background-pending {
    background-color: #ffe0d3;
    border-radius: 10px;
    height: 100%;
    width: 45%;
    margin-top: 15px;
    color: #e52025
    }
    .badge-pending {
    background-color: #e53f31;
    border-radius: 20px;
    width: 100px;
    color: #fff;
    padding: 4px 10px;
    }

    .badge-completed {
    background-color: #379e54;
    border-radius: 20px;
    width: 100px;
    color: #fff;
    padding: 4px 10px;
    }

</style>
<div class="container my-1">
        <?php
            if(isset($_SESSION['status'])){
                echo "<h5 class='alert alert-success'>".($_SESSION['status'])."</h5>";
                unset($_SESSION['status']);
            }
        ?>

    <div class="row mb-2">
        <div class="col-md-12" >
            <h1>
                <?php echo ($role == 1) ? "Welcome, Admin $name!" : "Welcome, $name!"; ?>
            </h1>
            <h4>
                Explore the power and control at your fingertips. Manage, analyze, and optimize with ease.
            </h4>
        </div>
    </div>


    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card h-100 border shadow" style="border-radius: 20px;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <h5 class="card-title mb-0">Total Webinars</h5>
                    <div class="d-flex align-items-center" id="icon-background-webinars">
                        <i class="fa fa-calendar-check fa-3x ml-4 mr-2" aria-hidden="true" ></i>
                        <p class="card-text text-center display-4 mt-1" id="webinar-count"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100 border shadow" style="border-radius: 20px;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <h5 class="card-title mb-0">Total Participants</h5>    
                    <div class="d-flex align-items-center" id="icon-background-participant">
                        <i class="fas fa-users fa-3x ml-4 mr-2" aria-hidden="true" ></i>
                        <p class="card-text text-center display-4 mt-1" id="participant-count" ></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100 border shadow" style="border-radius: 20px;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <h5 class="card-title mb-0">Pending Webinars</h5>
                    <div class="d-flex align-items-center" id="icon-background-pending">
                        <i class="fas fa-clock fa-3x ml-4 mr-2" ></i>
                        <p class="card-text text-center display-4 mt-1" id="pending-count" ></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-mb-12">
        <div class="card border shadow" style="border-radius: 20px;">
            <div class="card-body">
                <table id="dashboard-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Webinar ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Event Date</th>
                            <th scope="col">Registered</th>
                            <th scope="col">Respondent</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
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
    var table = $('#dashboard-table').DataTable({
        ajax: {
            url: '../config/fetch_dashboard.php',
            dataSrc: 'data' // Specify the key for the data array in the JSON response
        },
        columns: [
            { data: 'webinar_id' },
            { data: 'webinar_title' },
            { data: 'webinar_date' },
            { data: 'participants_count' },
            { data: 'assessments_count' },
            {
                data: 'status',
                render: function(data, type, row) {
                    if (data == 0) {
                        return '<span class="status-badge badge-pending">Pending</span>';
                    } else {
                        return '<span class="status-badge badge-completed">Completed</span>';
                    }
                }
            }
        ],
            select: {
            style: 'single'
            },
    });
});



    // Fetch the total webinar count
    fetch('../config/get_total_dashboard.php?type=webinar')
        .then(response => response.text())
        .then(data => document.getElementById('webinar-count').textContent = data)
        .catch(error => console.error(error));

    // Fetch the total participant count
    fetch('../config/get_total_dashboard.php?type=participant')
        .then(response => response.text())
        .then(data => document.getElementById('participant-count').textContent = data)
        .catch(error => console.error(error));

    // Fetch the total pending count
    fetch('../config/get_total_dashboard.php?type=pending')
        .then(response => response.text())
        .then(data => document.getElementById('pending-count').textContent = data)
        .catch(error => console.error(error));
    
</script>
  

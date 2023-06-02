<?php
  include("../includes/header.php");  

  $webinar_id = $_GET['id'];
?>
<link rel="stylesheet" href="../assets/css/chart.css">

<div class="container mt-3 px-5">
  <div class="row">
    <div class="col-12">
      <div class="card shadow">
        <div class="card-header custom-card-header">
          <h2 class="text-center chart-heading mt-2"> <strong> Course Evaluation </strong> </h2>
        </div>
        <div class="card-body">
          <div class="row px-3">
            <div class="col-lg-4 col-md-6">
              <div class="chart-card">
                <h2 class="chart-heading">RELEVANCE OF <br> THE TRAINING</h2>
                <canvas id="relevantChart" class="my-chart"></canvas>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="chart-card">
                <h2 class="chart-heading">INFORMATION / SKILLS ACQUIRED</h2>
                <canvas id="informationChart" class="my-chart"></canvas>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="chart-card">
                <h2 class="chart-heading">INSTRUCTIONAL <br> DESIGN</h2>
                <canvas id="instructionalDesignChart" class="my-chart"></canvas>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="chart-card">
                <h2 class="chart-heading">CLASS <br> INTERACTION</h2>
                <canvas id="classInteractionChart" class="my-chart"></canvas>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="chart-card">
                <h2 class="chart-heading">SENSITIVITY AND <br> ASSISTANCE</h2>
                <canvas id="staffSensitivityChart" class="my-chart"></canvas>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="chart-card">
                <h2 class="chart-heading">COURSE <br> GENERAL EVALUATION</h2>
                <canvas id="overallRatingChart" class="my-chart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('../includes/footer.php'); ?>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="../assets/js/chart.js"></script>
</body>
</html>

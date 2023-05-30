<?php
  // Determine the current page
  $currentPage = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="../pages/dashboard.php">
      <img src="../assets/img/logo.png" width="70" height="70" class="d-inline-block align-top" alt="Logo">
      <span class="ml-2">DICT Certification</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item <?php echo $currentPage === 'dashboard.php' ? 'active' : ''; ?>">
          <a class="nav-link" href="../pages/dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?php echo $currentPage === 'webinarlist.php' || $currentPage === 'addWebinar.php' ? 'active' : ''; ?>" href="#" id="webinarManagementDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Webinar Management</a>
          <div class="dropdown-menu" aria-labelledby="webinarManagementDropdown">
            <a class="dropdown-item" href="../pages/addWebinar.php">Add Webinar</a>
            <a class="dropdown-item" href="../pages/webinarlist.php">Webinar List</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?php echo $currentPage === 'participant.php' || $currentPage === 'respondent.php' ? 'active' : ''; ?>" href="#" id="participantManagementDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Participant Management</a>
          <div class="dropdown-menu" aria-labelledby="participantManagementDropdown">
            <a class="dropdown-item" href="../pages/participant.php">Registered</a>
            <a class="dropdown-item" href="../pages/respondent.php">Respondent</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?php echo $currentPage === 'admin-list.php' || $currentPage === '#' ? 'active' : ''; ?>" href="#" id="profileManagementDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-person-circle"></i>
            Profile
          </a>
          <div class="dropdown-menu" aria-labelledby="participantManagementDropdown">
            <a class="dropdown-item" href="#">Edit profile</a>
            <a class="dropdown-item" href="../pages/admin-list.php">Admin List</a>
            <a class="dropdown-item text-danger" href="../config/logout.php">Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>

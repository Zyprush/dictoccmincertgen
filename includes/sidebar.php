<?php
  // Determine the current page
  $currentPage = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar">
  <div class="logo_details">
    <img src="../assets/img/logo.png" alt="Logo" class="icon" style="height: 50px;">
    <div class="logo_name">DICT Gertgen</div>
    <i class="bx bx-menu" id="btn"></i>
  </div>
  <ul class="nav-list">
    <li id="create-btn">
      <a href="../pages/addWebinar.php">
        <i class="bx bx-plus"></i>
        <span class="link_name">Create</span>
      </a>
      <span class="tooltip">Add Webinar</span>
    </li>

    <li <?php echo ($currentPage === 'dashboard.php') ? 'class="active"' : ''; ?>>
      <a href="../pages/dashboard.php">
        <i class="bx bx-grid-alt"></i>
        <span class="link_name">Dashboard</span>
      </a>
      <span class="tooltip">Dashboard</span>
    </li>
    <li <?php echo ($currentPage === 'webinarlist.php') ? 'class="active"' : ''; ?>>
      <a href="../pages/webinarlist.php">
        <i class="bx bx-calendar"></i>
        <span class="link_name">Webinar List</span>
      </a>
      <span class="tooltip">Webinar List</span>
    </li>
    <li <?php echo ($currentPage === 'participant.php') ? 'class="active"' : ''; ?>>
      <a href="../pages/participant.php">
        <i class="bx bx-user-check"></i>
        <span class="link_name">Registered List</span>
      </a>
      <span class="tooltip">Registered List</span>
    </li>
    <li <?php echo ($currentPage === 'respondent.php') ? 'class="active"' : ''; ?>>
      <a href="../pages/respondent.php">
        <i class="bx bx-bar-chart"></i>
        <span class="link_name">Respondents List</span>
      </a>
      <span class="tooltip">Respondents List</span>
    </li>
    <li <?php echo ($currentPage === 'admin-list.php') ? 'class="active"' : ''; ?>>
      <a href="../pages/admin-list.php">
        <i class="bx bx-user"></i>
        <span class="link_name">Account</span>
      </a>
      <span class="tooltip">Account</span>
    </li>

    <li class="profile">
      <div class="profile_details">
        <i class="bi bi-person-circle"></i>
        <div class="profile_content">
          <div class="name">
            <?php echo $name; ?>
          </div>
          <div class="designation">
            <?php echo ($role == 1) ? "Admin" : "User"; ?>
          </div>
        </div>
      </div>
      <i class="bx bx-log-out" id="log_out"></i>
    </li>
  </ul>
</div>


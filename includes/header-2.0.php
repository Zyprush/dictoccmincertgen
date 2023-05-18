<?php
  // Determine the current page
  $currentPage = basename($_SERVER['PHP_SELF']);

  // Set the default title
  $pageTitle = "DICT Certification";

  // Update the title based on the current page
  if ($currentPage === 'assessment_form.php') {
    $pageTitle = "Assessment | DICT Certification";
  } elseif ($currentPage === 'registration_form.php') {
    $pageTitle = "Register | DICT Certification";
  } elseif ($currentPage === 'signin.php') {
    $pageTitle = "Sign In | DICT Certification";
  } elseif ($currentPage === 'signup.php') {
    $pageTitle = "Sign Up | DICT Certification";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    <title><?php echo $pageTitle; ?></title>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark mx-auto">
    <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="../pages/signin.php ">
      <img src="../assets/img/logo.png" width="70" height="70" class="d-inline-block align-top" alt="Logo">
      <span class="ml-2">DICT Certification</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item <?php echo $currentPage === 'contact.php' ? 'active' : ''; ?>">
          <a class="nav-link" href="../pages/contact.php">Contact Us<i class="fas fa-phone mr-2 ml-2"></i> </a>
        </li>
        <li class="nav-item <?php echo $currentPage === 'about.php' ? 'active' : ''; ?>">
          <a class="nav-link" href="../pages/about.php">About Us<i class="far fa-question-circle mr-2 ml-2"></i> </a>
        </li>
      </ul>   
    </div>
    </div>
</nav>
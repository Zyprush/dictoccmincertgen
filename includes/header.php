<?php
  // Determine the current page
  $currentPage = basename($_SERVER['PHP_SELF']);

  // Set the default title
  $pageTitle = "DICT Certification";

  // Update the title based on the current page
  if ($currentPage === 'dashboard.php') {
    $pageTitle = "Home | DICT Certification";
  } elseif ($currentPage === 'webinarlist.php') {
    $pageTitle = "Webinar List | DICT Certification";
  } elseif ($currentPage === 'addWebinar.php') {
    $pageTitle = "Add webinar | DICT Certification";
  } elseif ($currentPage === 'participant.php') {
    $pageTitle = "Registered | DICT Certification";
  } elseif ($currentPage === 'respondent.php') {
    $pageTitle = "Respondents | DICT Certification";
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    
    <!-- datatables.net -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

  
    <style>
      body{
        background-color: #EFEFEF;
      }
    </style>

    <title><?php echo $pageTitle; ?></title>

  </head>
  <body>
    <?php include('navbar.php'); ?>

    <div class="py-4">


<?php
    session_start();
    //include('includes/header.php');
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
    <title>Sign up</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mx-auto">
    <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="logo.png" width="70" height="70" class="d-inline-block align-top" alt="Logo">
        <span class="ml-2">DICT Cert Gen</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a class="nav-link" href="#">Contact Us<i class="fas fa-phone mr-2 ml-2"></i> </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">About Us<i class="far fa-question-circle mr-2 ml-2"></i> </a>
    </li>
    </ul>   
    </div>
</nav>
<div class="container my-5">
    <div class="card mx-auto shadow" style="max-width: 400px;">
        <?php
            if(isset($_SESSION['status'])){
                echo "<h5 class='alert alert-success'>".($_SESSION['status'])."</h5>";
                unset($_SESSION['status']);
            }
        ?>
        <div class="card-header">
            <h1 class="text-center">Sign Up</h1>
        </div>
        <div class="card-body">
            <form action="code.php" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="fname" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="signup_btn">Sign Up</button>
            </form>
        </div>
        <div class="card-footer">
            <p class="text-center">Already have an account? <a href="signin.php">Sign in</a></p>
        </div>
    </div>
</div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

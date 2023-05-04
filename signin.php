<?php
    session_start();
    include('includes/header.php');
?>

<div class="container mt-5">
    <div class="card mx-auto shadow">
        <?php
            if(isset($_SESSION['status'])){
                echo "<h5 class='alert alert-success'>".($_SESSION['status'])."</h5>";
                unset($_SESSION['status']);
            }
        ?>
        <div class="card-header">
            <h1 class="text-center">Sign In</h1>
        </div>
        <div class="card-body">
            <form action="logincode.php" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="signin_btn">Sign In</button>
            </form>
        </div>
        <div class="card-footer">
            <p class="text-center">Don't have an account? <a href="signup.php">Sign Up</a></p>
        </div>
    </div>
</div>

<?php
    include('includes/footer.php');
?>

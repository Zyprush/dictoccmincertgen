<?php
    session_start();
    include('../includes/header-2.0.php');
    if (isset($_SESSION['logged_in'])) {
        // Redirect to another page (e.g., dashboard)
        header('Location: dashboard.php');
        exit();
    }
?>

<div class="container my-5">
    <div class="card mx-auto shadow" style="max-width: 400px;">
        <div class="card-header">
            <?php
                if(isset($_SESSION['status'])){
                    if(!empty($_SESSION['status'])){
                        echo "<h4 class='text-center mt-1 text-danger'>".($_SESSION['status'])."</h4>";
                        unset($_SESSION['status']);
                    } else {
                        echo "<h4 class='text-center mt-1'>Sign-in form</h4>";
                    }
                } else {
                    echo "<h4 class='text-center mt-1'>Sign-in form</h4>";
                }
            ?>
        </div>
        
        <div class="card-body">
            <form action="../config/dblogin.php" method="POST">
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                        <input type="email" class="form-control ml-1" id="email" name="email" placeholder="Email address" required>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" class="form-control ml-1" id="password" name="password" placeholder="Password" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    LOGIN
                </button>
            </form>
        </div>
        <div class="card-footer">
            <p class="text-center m-0">Don't have an account? <a href="signup.php">Sign Up</a></p>
        </div>
    </div>
</div>

<?php
    include ('../includes/footer.php');
?>

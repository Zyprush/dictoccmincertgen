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
                        echo "<h4 class='text-center mt-1'>Register form</h4>";
                    }
                } else {
                    echo "<h4 class='text-center mt-1'>Register form</h4>";
                }
            ?>
        </div>
        <div class="card-body">
            <form action="../config/dbsignup.php" method="POST">
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input type="text" class="form-control ml-1" id="name" name="name" placeholder="Name" required>
                    </div>
                </div>
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
                <button type="submit" class="btn btn-primary btn-block" name="signup_btn">Sign Up</button>
            </form>
        </div>
        <div class="card-footer">
            <p class="text-center m-0">Already have an account? <a href="signin.php">Sign in</a></p>
        </div>
    </div>
</div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

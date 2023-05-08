<?php
    include('config/authentication.php');
    include('includes/header.php');
    
    // Redirect to dashboard if user is already logged in
    if(isset($_SESSION['user_id'])) {
        header("Location: pages/dashboard.php");
        exit();
    }
?>

<?php
    include('includes/footer.php');
?>

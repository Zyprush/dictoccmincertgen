<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/config/authentication.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php');
    
    // Redirect to dashboard if user is already logged in
    if(isset($_SESSION['user_id'])) {
        header("Location: pages/dashboard.php");
        exit();
    } else {
        header("Location: pages/signin.php");
        exit();
    }
?>

<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php');
?>

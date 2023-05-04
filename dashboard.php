<?php
    session_start();
    include('includes/header.php');
?>

    <?php
        if(isset($_SESSION['status'])){
            echo "<h5 class='alert alert-success'>".($_SESSION['status'])."</h5>";
            unset($_SESSION['status']);
        }
    ?>

<?php
    include('includes/footer.php');
?>
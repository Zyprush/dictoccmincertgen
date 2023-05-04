<?php
session_start();

unset($_SESSION['veryfied_user_id']);
unset($_SESSION['idTokenString']);

$_SESSION['status'] = "Logged out successfully!";
header('location: signin.php');
exit();

?>
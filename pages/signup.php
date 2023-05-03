<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

use PHPSupabase\Service;
use PHPSupabase\Auth\Auth;

$supabaseUrl = 'https://dytzsnjuklknhqkzwihp.supabase.co';
$supabaseKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImR5dHpzbmp1a2xrbmhxa3p3aWhwIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODMwODMwMzgsImV4cCI6MTk5ODY1OTAzOH0.mjlP2MxqEBTlUJ5juRyPoG87vbkVgMwdMIIQZROjFw8';

$service = new Service($supabaseKey, $supabaseUrl);
$auth = $service->createAuth();

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $user = $auth->createUserWithEmailAndPassword($email, $password);
        $_SESSION['loggedin'] = true;
        $_SESSION['user'] = $user;
        header('Location: dashboard.php');
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
</head>
<body>
    <h1>Sign Up</h1>

    <?php if (isset($error)): ?>
        <p><?php echo $error ?></p>
    <?php endif; ?>

    <form method="post">
        <label>
            Name:
            <input type="text" name="name">
        </label>
        <br>
        <label>
            Email:
            <input type="email" name="email">
        </label>
        <br>
        <label>
            Password:
            <input type="password" name="password">
        </label>
        <br>
        <button type="submit" name="signup">Sign Up</button>
    </form>

    <p>Already have an account? <a href="login.php">Login</a></p>
</body>
</html>

<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

use PHPSupabase\Service;
use PHPSupabase\Auth\Auth;

$supabaseUrl = 'https://dytzsnjuklknhqkzwihp.supabase.co';
$supabaseKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImR5dHpzbmp1a2xrbmhxa3p3aWhwIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODMwODMwMzgsImV4cCI6MTk5ODY1OTAzOH0.mjlP2MxqEBTlUJ5juRyPoG87vbkVgMwdMIIQZROjFw8';

$service = new Service($supabaseKey, $supabaseUrl);
$auth = $service->createAuth();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $auth->signInWithEmailAndPassword($email, $password);
        $data = $auth->data();

        if(isset($data->access_token)){
            $_SESSION['loggedin'] = true;
            $_SESSION['user'] = $data->user;
            header('Location: dashboard.php');
            exit;
        }
    } catch (Exception $e) {
        $error = $auth->getError();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <?php if (isset($error)): ?>
        <p><?php echo $error ?></p>
    <?php endif; ?>

    <form method="post">
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
        <button type="submit" name="login">Login</button>
    </form>

    <p>Don't have an account yet? <a href="signup.php">Sign up here</a>.</p>
</body>
</html>

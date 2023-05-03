<?php
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // TODO: validate username and password

    // simulate database query to check if user exists
    if ($username === 'admin' && $password === 'admin') {
        // set session variable and redirect to dashboard
        $_SESSION['loggedin'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password';
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
            Username:
            <input type="text" name="username">
        </label>
        <br>
        <label>
            Password:
            <input type="password" name="password">
        </label>
        <br>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>

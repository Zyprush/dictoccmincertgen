<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <nav>
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="pages/about.php">About</a></li>
			<li><a href="pages/contact.php">Contact</a></li>
			<?php if (isset($_SESSION['user'])): ?>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li><a href="logout.php">Logout</a></li>
			<?php else: ?>
				<li><a href="pages/login.php">Login</a></li>
			<?php endif; ?>
		</ul>
	</nav>
</body>
</html>
<?php session_start();
$username = $_SESSION['username'];
unset($_SESSION['username']);
unset($_SESSION['msg']);
unset($_SESSION['level']);
session_destroy();
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Forms Test Entry Page</title>
    <link href="style.css" rel="stylesheet">
</head>

<body>
<h1>Logged out</h1>
<p>Goodbye <?php echo $username; ?>.</p>
<nav>
    <a href="index.php">Index</a>
    <a href="login.php">Login</a>
</nav>
</body></html>

<?php session_start();
error_reporting(E_ALL);
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
<h1>Registration</h1>

<?php
// print message from session, if one exists
if (isset($_SESSION['msg'])) {
    echo "<p style='color:red'>".$_SESSION['msg']."</p>";
}
// Only display the login form if the user is not logged in
if (!isset($_SESSION['username'])) {
?>
    <form id="login" name="register" method="post" action="dbprocess.php">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <input type="submit" name="submit" value="Register">
    </form>
<?php } ?>

<nav><a href="index.php">Index</a> <?php if (isset($_SESSION['username'])) echo '<a href="logout.php">Logout</a>';?></nav>

</body>
</html>
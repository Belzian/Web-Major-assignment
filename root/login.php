<?php session_start();
error_reporting(E_ALL);
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
<h1>Login Page</h1>

<?php
// print message from session, if one exists
if (isset($_SESSION['msg'])) {
    echo "<p style='color:red'>".$_SESSION['msg']."</p>";
    $_SESSION['msg'] = null;
}
// Only display the login form if the user is not logged in
if (!isset($_SESSION['username'])) {
    ?>
    <form id="login" name="login" method="post" action="authenticate.php">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <br>
        <input type="submit" name="submit" value="Login">
    </form>
<?php } ?>


<nav>
    <a href="index.php">Index</a>
    <?php if(isset($_SESSION['username'])){
    echo '<a href="logout.php">Logout</a>';}else{
       echo '<a href="register.php">Register</a>';
    }?>
</nav>

</body>
</html>

<header>
        <h1><a href="index.php">Townsville Community Music Centre</a></h1>

        <?php if(isset($_SESSION['username'])){
    echo '<a href="logout.php" class="sign" id="logout">Logout</a>';
    echo '<label for="logout" class="sign">'.$_SESSION["username"].': </label>';}
else{
    echo '<a href="login.php" class="sign">&nbsp; Sign in</a>';
    echo '<a href="register.php" class="sign">Register&nbsp;|</a>';
}?>
</header>
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="eventsView.php">Events</a></li>
        <li><a href="viewArtist.php">Artists</a></li>
        <li><a href="noticeBoard.php">News</a></li>
        <li><a href="about.html">About us</a></li>
        <li><a href="#">Contact us</a></li>
    </ul>
</nav>

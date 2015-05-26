<?php
include("dbconnect.php");
session_start();
error_reporting(E_ALL);
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Current Notices</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<body>

<div id="content">
    <?php
    include("template.php");
    ?>

    <article class="artist">
        <b><a href="addNotice.php">Add new Notice</a></b>
    </article>
    <h2>Current Notices</h2>
    <?php
    $sql = "SELECT * FROM notices ORDER BY date ASC";

    foreach ($dbh->query($sql) as $row) {
        ?>
        <?php
        echo '<article class="artist">';

        echo "<li><a href='notice.php?id=". $row['id']."'><b>Notice: </b>".$row['notice']."<b> Summary: </b>".$row['summary']."<b> Date: </b>".$row['date']."<br></a></li>";

        echo '</article>';
        ?>
        <br>
        <?php
    }

    $dbh = null;
    ?>
</div>
</body>
</html>
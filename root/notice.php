<?php
include("dbconnect.php");
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Notice Details</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
<div id="content">
    <?php
    include("template.php");
    ?>
    <h2>Notice Details</h2>
    <?php

    $ID = $_GET['id'];
    $sql = "SELECT * FROM notices WHERE id = $ID";

    foreach ($dbh->query($sql) as $row) {
        $notice = $row['notice'];
        $info = $row['info'];
        $date = $row['date'];

        echo "<h4>Notice: $notice</h4>
    <br><h4>Information: </h4>$info
    <br><h4>Date: $date</h4>";
    }


    echo '<br><b><a href="noticeBoard.php">Return</a></b>';
    $dbh = null;

    ?>
</div>
</body>
</html>




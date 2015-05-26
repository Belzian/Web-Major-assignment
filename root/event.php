<?php
include("dbconnect.php");
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Event Details</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
<div id="content">
    <?php
    include("template.php");
    ?>
<h2>Event Details</h2>
<?php

    $ID = $_GET['id'];
    $sql = "SELECT * FROM events WHERE id = $ID";



foreach ($dbh->query($sql) as $row) {

    echo "Event: ".$row['event']."
    <br>Information: ".$row['info']."
    <br>Date: ".$row['date']. "
    <a href='muso.php?variable=" .$row["artist"]."'>
    <br>Artist: ".$row["artist"]." - click for artist info</a><br>";
}


echo '<br><b><a href="index.php">Home</a></b>';
$dbh = null;

?>
</div>
</body>
</html>



